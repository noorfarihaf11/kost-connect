<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Carbon\Carbon;
use App\Helpers\MidtransConfig;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        if (Gate::allows('admin') || Gate::allows('owner')) {
            $payments = Payment::with(['reservation.user'])->get();
        } else {
            $payments = Payment::with(['reservation.user'])
                ->whereHas('reservation', function ($query) use ($user) {
                    $query->where('id_user', $user->id_user); // Filter berdasarkan id_user di tabel reservation
                })
                ->get();
        }

        $rooms = Room::all();
        $reservations = Reservation::where('id_user', $user->id_user)->get();

        return view('dashboard.payment', compact('rooms', 'payments', 'reservations'));
    }

    public function initiatePayment(Request $request)
    {
        $validatedData = $request->validate([
            'id_payment' => 'required', // Menggunakan id_payment sebagai parameter
            'total_amount' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'room' => 'required|string',
        ]);
    
        try {
            $id_payment = $validatedData['id_payment']; // Mengambil id_payment dari request
            $totalAmount = $validatedData['total_amount'];
            $name = $validatedData['name'];
            $email = $validatedData['email'];
            $phone = $validatedData['phone'];
            $room = $validatedData['room'];
    
            MidtransConfig::set();
    
            // Mencari data pembayaran berdasarkan id_payment
            $payment = Payment::where('id_payment', $id_payment)->first();
    
            if (!$payment) {
                return response()->json(['success' => false, 'message' => 'Payment not found.']);
            }
    
            $orderId = $id_payment . '-' . now()->format('Ymd-His') . '-' . Str::random(6);
    
            $transactionDetails = [
                'order_id' => $orderId,
                'gross_amount' => $totalAmount, // Total jumlah pembayaran
            ];
    
            $itemDetails = [
                [
                    'id' => $orderId,
                    'price' => $totalAmount,
                    'quantity' => 1,
                    'name' => $room, // Ganti sesuai nama item yang sesuai
                ],
            ];
    
            $customerDetails = [
                'first_name' => $name,
                'email' => $email,
                'phone' => $phone,
            ];
    
            $transactionData = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
            ];
            $snapToken = Snap::getSnapToken($transactionData);
    
            // Update atau insert data pembayaran dengan id_payment
            DB::table('payments')->updateOrInsert(
                ['id_payment' => $id_payment],
                [
                    'order_id' => $orderId,
                    'snap_token' => $snapToken,
                ]
            );
    
            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    

    public function handleNotification(Request $request)
    {
        $data = $request->all();

        Log::info('Received Midtrans notification', $data);

        try {
            if ($data['transaction_status'] == 'settlement') {
                $payment = Payment::where('order_id', $data['order_id'])->first();

                if ($payment) {
                    $payment->payment_status = 'paid';
                    $payment->save();

                    $this->createCustomer($payment);
                    $this->monthlyPayment($payment);

                    Log::info('Transaction settled, payment updated', ['id_reservation' => $data['order_id'], 'status_payment' => $payment->status_payment]);
                } else {
                    Log::warning('Payment not found', ['order_id' => $data['order_id']]);
                }
            } elseif ($data['transaction_status'] == 'pending') {
                Log::info('Transaction pending', ['order_id' => $data['order_id']]);
            } else {
                Log::info('Unhandled transaction status', ['status' => $data['transaction_status']]);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error handling Midtrans notification', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function createCustomer($payment)
    {
        $reservation = Reservation::where('id_reservation', $payment->id_reservation)->first();

        if ($reservation) {
            $existingCustomer = Customer::where('id_reservation', $payment->id_reservation)->first();

            if (!$existingCustomer) {
                $customer = new Customer();
                $customer->id_reservation = $reservation->id_reservation;
                $customer->name = $reservation->user->name;
                $customer->email = $reservation->user->email;
                $customer->phone_number = $reservation->phone_number;
                $customer->start_date = $payment->updated_at;
                $customer->end_date = null;
                $customer->monthly_cost = $payment->total_amount;
                $customer->customer_status = 'active';
                $customer->save();
            }
        }
    }

    private function monthlyPayment($payment)
    {
        // Ambil data reservasi berdasarkan id_reservation
        $reservation = Reservation::where('id_reservation', $payment->id_reservation)->first();
    
        if (!$reservation) {
            Log::warning('Reservation not found for monthly payment', [
                'id_reservation' => $payment->id_reservation,
            ]);
            return; // Keluar jika reservasi tidak ditemukan
        }
    
        // Hitung tanggal invoice berikutnya berdasarkan payment_due_date
        $nextInvoiceDate = \Carbon\Carbon::parse($payment->payment_due_date)->addMonth();
        $currentMonth = $nextInvoiceDate->format('Ym');
        $orderId = $payment->id_reservation . '-' . $currentMonth;
    
        // Cek apakah invoice untuk periode tersebut sudah ada
        $existingInvoice = Payment::where('id_reservation', $payment->id_reservation)
            ->where('payment_period', $nextInvoiceDate->format('Y-m-d'))
            ->first();
    
        if ($existingInvoice) {
            Log::warning('Invoice already exists for the given period', [
                'id_reservation' => $payment->id_reservation,
                'payment_period' => $nextInvoiceDate->format('Y-m-d'),
            ]);
            return; // Keluar jika invoice sudah ada
        }
    
        // Buat invoice baru
        $monthlypayment = new Payment();
        $monthlypayment->id_reservation = $payment->id_reservation;
        $monthlypayment->payment_method = 'midtrans';
        $monthlypayment->payment_status = 'pending';
        $monthlypayment->payment_period = $nextInvoiceDate->format('Y-m-d'); // Gunakan tanggal berdasarkan payment_due_date
        $monthlypayment->payment_due_date = $nextInvoiceDate->format('Y-m-d');
        $monthlypayment->total_amount = $payment->total_amount;
        $monthlypayment->payment_type = 'monthly_payment';
        $monthlypayment->created_at = now();
        $monthlypayment->updated_at = now();
        $monthlypayment->save();
    
        // Log keberhasilan pembuatan invoice
        Log::info('Next month invoice created successfully', [
            'id_reservation' => $monthlypayment->id_reservation,
            'payment_due_date' => $monthlypayment->payment_due_date,
            'payment_period' => $monthlypayment->payment_period,
            'total_amount' => $monthlypayment->total_amount,
            'order_id' => $orderId,
        ]);
    }    
}    


    // public function confirmPayment(Request $request, $id)
    // {
    //     try {
    //         $payment = Payment::findOrFail($id);
    //         $reservation = $payment->reservation;

    //         if ($payment->payment_status !== 'paid') {
    //             $payment->payment_status = 'paid';
    //             $payment->save();
    //         }

    //         if ($payment->payment_status === 'paid') {
    //             $existingPayments = Payment::where('id_reservation', $reservation->id_reservation)->get();

    //             if ($existingPayments->count() == 1 && $payment->payment_type === 'first_payment') {
    //                 $payment->payment_type = 'first_payment';
    //             } else {
    //                 $payment->payment_type = 'monthly_payment';
    //             }

    //             $payment->save();

    //             if ($payment->payment_type === 'first_payment') {
    //                 $next_payment_date = \Carbon\Carbon::parse($payment->payment_due_date)->addMonth();

    //                 Payment::create([
    //                     'id_reservation' => $reservation->id_reservation,
    //                     'payment_method' => 'bank_transfer',
    //                     'payment_status' => 'pending',
    //                     'total_amount' => $reservation->room->price_per_month,
    //                     'payment_due_date' => $next_payment_date,
    //                     'payment_type' => 'monthly_payment',
    //                 ]);
    //             } else {

    //                 $next_payment_date = \Carbon\Carbon::parse($payment->payment_due_date)->addMonth();
    //                 Payment::create([
    //                     'id_reservation' => $reservation->id_reservation,
    //                     'payment_method' => 'bank_transfer',
    //                     'payment_status' => 'pending',
    //                     'total_amount' => $reservation->room->price_per_month,
    //                     'payment_due_date' => $next_payment_date,
    //                     'payment_type' => 'monthly_payment',
    //                 ]);
    //             }
    //         }

    //         $existingCustomer = Customer::where('id_reservation', $payment->id_reservation)->first();

    //         if (!$existingCustomer) {
    //             $customer = new Customer();
    //             $customer->id_reservation = $reservation->id_reservation;
    //             $customer->name = $reservation->user->name;
    //             $customer->email = $reservation->user->email;
    //             $customer->phone_number = $reservation->phone_number;
    //             $customer->start_date = $payment->updated_at;
    //             $customer->end_date = null;
    //             $customer->customer_status = 'active';
    //             $customer->save();
    //         }

    //         return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dikonfirmasi!']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    //     }
    // }
