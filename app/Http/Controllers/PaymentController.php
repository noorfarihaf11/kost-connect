<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        if ($user->id_role == 1) {
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
            $payment->payment_status = 'paid';
            $payment->save();

            $reservation = $payment->reservation; // Ambil data reservasi terkait pembayaran

            $customer = new Customer();
            $customer->id_payment = $payment->id_payment;
            $customer->name = $reservation->user->name; // Sesuaikan dengan field yang ada di model reservation
            $customer->email = $reservation->user->email; // Sesuaikan dengan field yang ada di model user
            $customer->phone_number = $reservation->phone_number;
            $customer->start_date = $payment->updated_at;
            $customer->end_date = null;
            $customer->customer_status = 'active'; // Status customer yang aktif
            $customer->save();

            return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dikonfirmasi!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}
