<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
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
    public function update(Request $request, $id)
    {
        // Validasi file
        $validatedData = $request->validate([
            'proof_of_payment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        try {
            $payment = Payment::findOrFail($id);
    
            // Jika ada file yang diunggah
            if ($request->hasFile('proof_of_payment')) {
                $file = $request->file('proof_of_payment');
                $filePath = $file->store('payments', 'public'); // Simpan file di direktori public/payments
    
                $payment->proof_of_payment = basename($filePath);
                $payment->save(); // Simpan perubahan ke database
            }
    
            // Jika permintaan melalui AJAX
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Bukti Pembayaran Terkirim!']);
            }
    
            // Jika permintaan melalui form biasa
            return redirect('payment')->with('success', 'Bukti Pembayaran Terkirim!');
        } catch (\Exception $e) {
            // Jika terjadi error
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
            }
    
            return redirect('payment')->with('error', 'Update failed: ' . $e->getMessage());
        }
    }
}    