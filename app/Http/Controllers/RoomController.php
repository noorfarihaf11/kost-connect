<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\City;
use App\Models\Reservation;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $owner = Owner::where('id_user', Auth::id())->first();

        if ($owner) {
            $houses = BoardingHouse::where('id_owner', $owner->id_owner)->get();
            $rooms = Room::whereIn('id_house', $houses->pluck('id_house'))->get();
            $totalReservasi = Reservation::join('rooms', 'reservations.id_room', '=', 'rooms.id_room')
                ->join('boarding_houses', 'rooms.id_house', '=', 'boarding_houses.id_house')
                ->where('boarding_houses.id_owner', $owner->id_owner)
                ->where('reservations.reservation_status', 1)
                ->count();

            $owners = collect([$owner]);
        } else {
            $owners = Owner::all();
            $houses = BoardingHouse::all();
            $rooms = Room::all(); 
            $totalReservasi = 0; 
        }

        $cities = City::all();

        return view('dashboard.rooms', compact('owners', 'houses', 'rooms', 'cities', 'totalReservasi'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'id_house' => 'required|exists:boarding_houses,id_house',
            'price_per_month' => 'required|numeric',
            'square_feet' => 'required|numeric',
            'available_rooms' => 'required|integer|min:0',
            'is_available' => 'required',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new Room instance and set its attributes
        $room = new Room();
        $room->id_house = $request->post('id_house');  // Corrected from $$request to $request
        $room->name = $request->post('name');
        $room->description = $request->post('description');
        $room->price_per_month = $request->post('price_per_month');
        $room->square_feet = $request->post('square_feet');
        $room->is_available = $request->post('is_available');
        $room->available_rooms = $request->post('available_rooms');

        // Handle the image upload if it's present
        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->store('room_images', 'public');
            $room->image = $fileName;
        }

        // Save the new room data
        $room->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data kamar berhasil disimpan!');
    }
    public function update(Request $request, $id)
    {
        try {
            $rooms = Room::findOrFail($id);
            $rooms->update($request->all());

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
