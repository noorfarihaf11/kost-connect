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
use Illuminate\Support\Facades\Http;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Helpers\MidtransConfig;
use Illuminate\Support\Facades\Log;


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
            'id_reservation' => 'required',
            'total_amount' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'room' => 'required|string',
        ]);

        try {
            $id_reservation = $validatedData['id_reservation'];
            $totalAmount = $validatedData['total_amount'];
            $name = $validatedData['name'];
            $email = $validatedData['email'];
            $phone = $validatedData['phone'];
            $room = $validatedData['room'];

            MidtransConfig::set();

            $transactionDetails = [
                'order_id' => $id_reservation,
                'gross_amount' => $totalAmount, // Total jumlah pembayaran
            ];

            // Tentukan item details
            $itemDetails = [
                [
                    'id' => $id_reservation,
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

            DB::table('payments')
                ->where('id_reservation', $id_reservation)
                ->update(['snap_token' => $snapToken]);

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
                $payment = Payment::where('id_reservation', $data['order_id'])->first();

                if ($payment) {
                    $payment->payment_status = 'paid';
                    $payment->save();

                    Log::info('Transaction settled, payment updated', ['id_reservation' => $data['order_id'], 'status_payment' => $payment->status_payment]);
                } else {
                    Log::warning('Payment not found', ['order_id' => $data['order_id']]);
                }
            } elseif ($data['transaction_status'] == 'pending') {
            } else {
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error handling Midtrans notification', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    // public function uploadProof(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'proof_of_payment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //     ]);

    //     try {
    //         $payment = Payment::findOrFail($id);

    //         if ($request->hasFile('proof_of_payment')) {
    //             $file = $request->file('proof_of_payment');
    //             $filePath = $file->store('payments', 'public');
    //             $payment->payment_status = 'waiting_for_confirmation';
    //             $payment->proof_of_payment = basename($filePath);
    //             $payment->save();
    //         }

    //         return response()->json(['success' => true, 'message' => 'Bukti pembayaran berhasil diunggah!']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    //     }
    // }

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
}
