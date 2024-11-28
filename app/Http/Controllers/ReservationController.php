<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        if ($user->id_role == 1) {
            $reservations = Reservation::with(['room', 'user'])->get();
        } else {
            $reservations = Reservation::with(['room', 'user'])->where('id_user', $user->id_user)->get();
        }

        // Ambil data room dan user untuk kebutuhan lainnya
        $rooms = Room::all();
        $users = User::all();

        return view('dashboard.reservation', compact('rooms', 'users', 'reservations'));
    }
    public function submitReservation(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_room' => 'required|integer',
            'reservation_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Buat data reservasi
        Reservation::create([
            'id_room' => $request->id_room,
            'reservation_date' => $request->reservation_date,
            'notes' => $request->notes,
            'id_user' => Auth::id(),  // Pastikan yang login dapat membuat reservasi
        ]);

        return response()->json(['message' => 'Reservasi berhasil!'], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $reservations = Reservation::findOrFail($id);
            $reservations->update($request->all());

            if ($request->reservation_status == 2) {
                Payment::create([
                    'id_reservation' => $reservations->id_reservation,
                    'payment_method' => 'bank_transfer', // Contoh default metode pembayaran
                    'payment_status' => 'pending',     // Status default pembayaran
                    'total_amount' => $reservations->room->price_per_month, // Total harga dari reservasi
                ]);
            }

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Reservation updated successfully!']);
            }

            return redirect('reservation')->with('success', 'Reservation updated successfully!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
            }

            return redirect('reservation')->with('error', 'Update failed: ' . $e->getMessage());
        }
    }
}
