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
use Illuminate\Support\Facades\Log;

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
                ->orderBy('reservations.id_reservation') 
                ->get();
        } else {

            $totalReservasi = 0;
        }

        return view('dashboard.reservation', compact('rooms', 'users', 'reservations', 'totalReservasi'));
    }

    public function submitReservation(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_room' => 'required|integer',
                'reservation_date' => 'required|date',
                'phone_number' => 'required|string|regex:/^[0-9]{10,15}$/', // Validasi nomor telepon (opsional)
                'notes' => 'nullable|string', // Notes opsional
            ]);

            $hasActiveReservation = Reservation::where('id_user', Auth::id())
                ->where('reservation_status', 1) // Status 1: aktif
                ->exists();

            if ($hasActiveReservation) {
                return response()->json([
                    'message' => 'Kamu sudah memiliki reservasi aktif.',
                ], 400);
            }

            Reservation::create([
                'id_room' => $validated['id_room'],
                'reservation_date' => $validated['reservation_date'],
                'notes' => $validated['notes'],
                'phone_number' => $validated['phone_number'],
                'id_user' => Auth::id(),
                'reservation_status' => 1, // Status aktif
            ]);

            return response()->json([
                'message' => 'Reservasi berhasil! 
                Silakan cek reservation_status kamu di Status Reservasi.',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in submitReservation: ', [
                'user_id' => Auth::id(),
                'input' => $request->all(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

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
                    'payment_method' => 'midtrans',
                    'payment_status' => 'pending',
                    'total_amount' => $reservations->room->price_per_month,
                    'payment_method' => 'midtrans',
                    'payment_status' => 'pending',
                    'total_amount' => $reservations->room->price_per_month,
                    'payment_due_date' => $payment_due_date,
                    'payment_type' => 'first_payment',
                ]);

                $room = $reservations->room;
                if ($room->available_rooms > 0) {
                    $room->available_rooms -= 1;
                    $room->save();
                }
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
