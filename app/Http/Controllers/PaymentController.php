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

    public function uploadProof(Request $request, $id)
    {
        $validatedData = $request->validate([
            'proof_of_payment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $payment = Payment::findOrFail($id);

            if ($request->hasFile('proof_of_payment')) {
                $file = $request->file('proof_of_payment');
                $filePath = $file->store('payments', 'public');
                $payment->payment_status = 'waiting_for_confirmation';
                $payment->proof_of_payment = basename($filePath);
                $payment->save();
            }

            return response()->json(['success' => true, 'message' => 'Bukti pembayaran berhasil diunggah!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function confirmPayment(Request $request, $id)
{
    try {
        $payment = Payment::findOrFail($id);
        $reservation = $payment->reservation;

        // Konfirmasi pembayaran hanya jika statusnya belum 'paid'
        if ($payment->payment_status !== 'paid') {
            $payment->payment_status = 'paid';
            $payment->save();
        }

        if ($payment->payment_status === 'paid') {
            // Cek apakah ini pembayaran pertama atau pembayaran bulanannya
            $existingPayments = Payment::where('id_reservation', $reservation->id_reservation)->get();

            // Pembayaran pertama
            if ($existingPayments->count() == 1 && $payment->payment_type === 'first_payment') {
                $payment->payment_type = 'first_payment'; // Tipe pembayaran pertama
            } else {
                // Pembayaran bulan berikutnya
                $payment->payment_type = 'monthly_payment';
            }

            $payment->save();

            // Buat tagihan bulan berikutnya setelah pembayaran pertama selesai
            if ($payment->payment_type === 'first_payment') {
                $next_payment_date = \Carbon\Carbon::parse($payment->payment_due_date)->addMonth();

                Payment::create([
                    'id_reservation' => $reservation->id_reservation,
                    'payment_method' => 'bank_transfer',
                    'payment_status' => 'pending',
                    'total_amount' => $reservation->room->price_per_month,
                    'payment_due_date' => $next_payment_date,
                    'payment_type' => 'monthly_payment',  // Pembayaran bulan berikutnya
                ]);
            } else {
                // Pembayaran bulan berikutnya
                $next_payment_date = \Carbon\Carbon::parse($payment->payment_due_date)->addMonth();
                Payment::create([
                    'id_reservation' => $reservation->id_reservation,
                    'payment_method' => 'bank_transfer',
                    'payment_status' => 'pending',
                    'total_amount' => $reservation->room->price_per_month,
                    'payment_due_date' => $next_payment_date,
                    'payment_type' => 'monthly_payment',  // Pembayaran bulan berikutnya
                ]);
            }
        }

            // Menangani pembuatan customer jika belum ada
            $existingCustomer = Customer::where('id_reservation', $payment->id_reservation)->first();

            if (!$existingCustomer) {
                $customer = new Customer();
                $customer->id_reservation = $reservation->id_reservation;
                $customer->name = $reservation->user->name;
                $customer->email = $reservation->user->email;
                $customer->phone_number = $reservation->phone_number;
                $customer->start_date = $payment->updated_at; // Tanggal mulai saat pembayaran pertama dikonfirmasi
                $customer->end_date = null;
                $customer->customer_status = 'active'; // Status pelanggan aktif
                $customer->save();
            }

            return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dikonfirmasi!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}
