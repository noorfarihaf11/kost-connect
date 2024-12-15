<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (Gate::allows('admin') || Gate::allows('owner')) {
            $reservations = Reservation::with(['room', 'user'])->get();
        } else {
            $reservations = Reservation::with(['room', 'user'])->where('id_user', $user->id_user)->get();
        }

        $rooms = Room::all();
        $users = User::all();

        $owner = DB::table('owners')->where('id_user', $user->id_user)->first();

        if ($owner) {
            $id_owner = $owner->id_owner;

            $totalReservasi = Reservation::join('rooms', 'reservations.id_room', '=', 'rooms.id_room')
                ->join('boarding_houses', 'rooms.id_house', '=', 'boarding_houses.id_house')
                ->where('boarding_houses.id_owner', $id_owner)
                ->where('reservations.reservation_status', 1)
                ->count();

            $reservations = Reservation::with(['room', 'user'])
                ->join('rooms', 'reservations.id_room', '=', 'rooms.id_room')
                ->where('rooms.id_house', $owner->id_owner)  
                ->get();
        } else {
           
            $totalReservasi = 0;
        }

        return view('dashboard.reservation', compact('rooms', 'users', 'reservations', 'totalReservasi'));
    }



    public function submitReservation(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_room' => 'required|integer',
            'reservation_date' => 'required|date',
            'phone_number' => 'required|string',
            'notes' => 'required|string',
        ]);

        $payment_due_date = \Carbon\Carbon::parse($request->reservation_date)->addDay();

        Reservation::create([
            'id_room' => $request->id_room,
            'reservation_date' => $request->reservation_date,
            'notes' => $request->notes,
            'phone_number' => $request->phone_number,
            'id_user' => Auth::id(),  // Pastikan yang login dapat membuat reservasi
        ]);

        return response()->json(['message' => 'Reservasi berhasil!'], 200);
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $reservations = Reservation::findOrFail($id);
    //         $reservations->update($request->all());

    //         if ($request->reservation_status == 2) {

    //             $reservation_date = $reservations->reservation_date;
    //             $payment_due_date = \Carbon\Carbon::parse($reservation_date)->addDay();

    //             Payment::create([
    //                 'id_reservation' => $reservations->id_reservation,
    //                 'payment_method' => 'bank_transfer', // Contoh default metode pembayaran
    //                 'payment_status' => 'pending',     // Status default pembayaran
    //                 'total_amount' => $reservations->room->price_per_month, // Total harga dari reservasi
    //                 'payment_due_date' => $payment_due_date,
    //                 'payment_type' => 'first_payment',
    //             ]);
    //         }

    //         if ($request->ajax()) {
    //             return response()->json(['success' => true, 'message' => 'Reservation updated successfully!']);
    //         }

    //         return redirect('reservation')->with('success', 'Reservation updated successfully!');
    //     } catch (\Exception $e) {
    //         if ($request->ajax()) {
    //             return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
    //         }

    //         return redirect('reservation')->with('error', 'Update failed: ' . $e->getMessage());
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         // Validasi input
    //         $request->validate([
    //             'reservation_status' => 'required|in:0,2', // Hanya menerima 0 (ditolak) atau 2 (diterima)
    //         ]);

    //         $reservations = Reservation::findOrFail($id);
    //         $reservations->update($request->only('reservation_status'));

    //         // Jika status "diterima", tambahkan data pembayaran
    //         if ($request->reservation_status == 2) {

    public function update(Request $request, $id)
    {
        try {
            $reservations = Reservation::findOrFail($id);
            $reservations->update($request->all());

            if ($request->reservation_status == 2) {

                $reservation_date = $reservations->reservation_date;
                $payment_due_date = \Carbon\Carbon::parse($reservation_date)->addDay();

                Payment::create([
                    'id_reservation' => $reservations->id_reservation,
                    'payment_method' => 'bank_transfer', // Default metode pembayaran
                    'payment_status' => 'pending',       // Default status pembayaran
                    'total_amount' => $reservations->room->price_per_month,
                    'payment_method' => 'bank_transfer', // Contoh default metode pembayaran
                    'payment_status' => 'pending',     // Status default pembayaran
                    'total_amount' => $reservations->room->price_per_month, // Total harga dari reservasi
                    'payment_due_date' => $payment_due_date,
                    'payment_type' => 'first_payment',
                ]);
            }

            // Respon JSON untuk AJAX
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
