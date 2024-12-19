<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomReview;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RoomReviewController extends Controller
{
    // public function index()
    // {
    //     $rooms = Room::all(); // Ambil semua data kamar
    //     return view('status-reservasi.index', compact('rooms'));
    // }

    public function stopKos(Request $request)
    {
        // Ambil data customer berdasarkan id_customer
        $customer = Customer::find($request->id_customer);

        // Ubah status customer menjadi 'inactive'
        $customer->customer_status = 'inactive';
        $customer->save();

        // Setelah update status, arahkan ke halaman yang sesuai
        return redirect()->route('rooms.index')->with('success', 'Anda berhasil berhenti kos!');
    }


    public function store(Request $request, $roomId)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Anda perlu login untuk memberikan review.');
        }

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Validasi kamar
        $room = Room::findOrFail($roomId); // Menggunakan findOrFail untuk menghindari if ($room) check

        // Validasi review ganda
        $existingReview = RoomReview::where('id_room', $roomId)
            ->where('id_customer', $user->id)
            ->first();

        if ($existingReview) {
            return redirect()->back()->withErrors(['error' => 'Anda sudah memberikan review untuk kamar ini.']);
        }

        // Validasi input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        // Simpan review
        RoomReview::create([
            'id_room' => $room->id,
            'id_customer' => $user->id, // Menggunakan id dari Auth::user()
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }
}