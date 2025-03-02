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
    public function store(Request $request, $roomId)
    {
        $user = Auth::user();

        $idCustomer = $user?->reservations->first()?->customer?->id_customer;

        if (!$idCustomer) {
            return redirect()->back()->withErrors(['error' => 'Akun Anda tidak memiliki ID customer yang valid.']);
        }

        $room = Room::findOrFail($roomId);

        $existingReview = RoomReview::where('id_room', $roomId)
            ->where('id_customer', $idCustomer)
            ->first();

        if ($existingReview) {
            return redirect()->back()->withErrors(['error' => 'Anda sudah memberikan review untuk kamar ini.']);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        try {
            RoomReview::create([
                'id_room' => $room->id_room,
                'id_customer' => $idCustomer,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }        

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }
}
