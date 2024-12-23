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

    // public function show($roomId)
    // {
    //     $room = Room::with('reviews.customer')->findOrFail($roomId);
    //     return view('room.show', compact('room'));
    // }

    // public function store(Request $request, $roomId)
    // {
    //     $customer = Customer::find($request->id_customer); 

    //     if (!$customer) {
    //         return redirect()->back()->withErrors(['error' => 'Customer tidak ditemukan.']);
    //     }

    //     $validated = $request->validate([
    //         'id_customer' => 'required|exists:customers,id_customer', // Pastikan id_customer ada
    //         'rating' => 'required|integer|min:1|max:5',
    //         'review' => 'nullable|string|max:255',
    //     ]);

    //     // Temukan room berdasarkan roomId
    //     $room = Room::findOrFail($roomId);

    //     // Cek apakah customer sudah memberikan review untuk kamar ini
    //     $existingReview = RoomReview::where('id_room', $roomId)
    //         ->where('id_customer', $customer->id_customer)
    //         ->first();

    //     if ($existingReview) {
    //         return redirect()->back()->withErrors(['error' => 'Anda sudah memberikan review untuk kamar ini.']);
    //     }

    //     // Simpan review baru
    //     RoomReview::create([
    //         'id_room' => $room->id_room,
    //         'id_customer' => $customer->id_customer,
    //         'rating' => $request->rating,
    //         'review' => $request->review,
    //     ]);

    //     return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    // }

    // public function show($roomId)
    // {
    //     $room = Room::with('reviews.customer')->findOrFail($roomId);
    //     return view('room.show', compact('room'));
    // }

    public function show($roomId)
    {
        $room = Room::with('reviews.customer')->findOrFail($roomId);
        return view('room.show', compact('room'));
    }

    public function store(Request $request, $roomId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Anda perlu login untuk memberikan review.');
        }

        $user = Auth::user();

        $room = Room::findOrFail($roomId); 

        $existingReview = RoomReview::where('id_room', $roomId) // Gunakan 'room_id' jika ini nama kolomnya
            ->where('id_customer', $user->id)
            ->first();


        if ($existingReview) {
            return redirect()->back()->withErrors(['error' => 'Anda sudah memberikan review untuk kamar ini.']);
        }

        // $bestReviews = $room->reviews()
        //     ->selectRaw('*, max(rating) as max_rating')
        //     ->groupBy('id_customer')
        //     ->get();

        // Validasi input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        RoomReview::create([
            'id_room' => $room->id_room, // Sesuaikan dengan migrasi
            'id_customer' => $user->id_user,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }
}