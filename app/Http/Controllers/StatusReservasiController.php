<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\Payment;  // Pastikan model Payment di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusReservasiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data reservasi berdasarkan user yang login
        $user = Auth::user();
        $rooms = Room::all();
        $reservations = Reservation::with('room')
            ->where('id_user', $user->id_user)
            ->get();

        // Tentukan bagian yang akan ditampilkan, default adalah pengajuan
        $section = $request->query('section', 'pengajuan'); // Menggunakan query string untuk menentukan bagian

        $payments = Payment::with('reservation.user', 'reservation.room')
            ->whereHas('reservation', function ($query) use ($user) {
                $query->where('id_user', $user->id_user);
            })->get();


        // Kembalikan view dengan data sesuai bagian
        return view('status-reservasi.index', compact('reservations', 'section', 'payments', 'rooms'));
    }
}
