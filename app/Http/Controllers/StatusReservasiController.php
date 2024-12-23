<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\RoomReview;
use App\Models\Payment;  // Pastikan model Payment di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusReservasiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();
    
        // Ambil data kamar
        $rooms = Room::all();
    
        // Ambil data reservasi berdasarkan user yang login
        $reservations = Reservation::with('room')
            ->where('id_user', $user->id_user)
            ->get();
    
        // Ambil data review berdasarkan ID customer dari user
        $idCustomer = $user?->reservations->first()?->customer?->id_customer;
    
        // Ambil daftar kamar yang sudah direview oleh customer
        $existingReviews = RoomReview::where('id_customer', $idCustomer)
            ->pluck('id_room')
            ->toArray();
    
        // Tentukan bagian yang akan ditampilkan, default adalah pengajuan
        $section = $request->query('section', 'pengajuan'); // Menggunakan query string untuk menentukan bagian
    
        // Ambil data pembayaran
        $payments = Payment::with('reservation.user', 'reservation.room')
            ->whereHas('reservation', function ($query) use ($user) {
                $query->where('id_user', $user->id_user);
            })->get();
    
        // Kembalikan view dengan data sesuai bagian
        return view('status-reservasi.index', compact('reservations', 'section', 'payments', 'rooms', 'existingReviews'));
    }    
}
