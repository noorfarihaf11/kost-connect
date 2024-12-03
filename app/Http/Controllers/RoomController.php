<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {   
        $rooms = Room::all();
        $cities = City::all();
        $user = Auth::user();
        return view('dashboard.rooms', compact('rooms', 'cities', 'user'));
    }

    public function store(Request $req)
{
    // Create a new room instance
    $room = new Room;

    // Assign the room details from the form request to the room model
    $room->id_city = $req->post('id_city');
    $room->name_room = $req->post('name_room');
    $room->room_type = $req->post('room_type');
    $room->price_per_month = $req->post('price_per_month');
    $room->square_feet = $req->post('square_feet');
    $room->available_rooms = $req->post('available_rooms');
    $room->description = $req->post('description');
    $room->address = $req->post('address');

    // Save the room details into the database
    $room->save();

    // Check if there is a file uploaded for room image
    if ($req->hasFile('room_image')) {
        // Get the uploaded file
        $file = $req->file('room_image');
        
        // Create a unique filename for the image
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Store the file in the 'room_images' folder within 'public' disk
        $path = $file->storeAs('room_images', $filename, 'public');
        
        // Save the path of the image in the room model
        $room->image_path = $path;
        
        // Update the room in the database with the image path
        $room->save();
    }

    // Redirect back to the rooms page (or wherever you want)
    return redirect('/rooms');
}


   // Di dalam RoomController.php
    public function destroy($id)
    {
        try {
            // Coba hapus data berdasarkan ID
            $room = Room::findOrFail($id);  // Temukan room berdasarkan ID
            $room->delete();  // Hapus data room
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

// Di dalam RoomController.php
    public function update(Request $request, $id)
    {
        try {
            // Cari kamar berdasarkan ID
            $room = Room::findOrFail($id);
            
            // Update data kamar
            $room->update($request->all());

            if ($request->ajax()) {
                // Respons JSON jika permintaan datang dari AJAX
                return response()->json(['success' => true, 'message' => 'Room updated successfully!']);
            }

            // Jika bukan AJAX, redirect dengan pesan sukses
            return redirect('rooms')->with('success', 'Room updated successfully!');
        } catch (\Exception $e) {
            // Tangani error dan kembalikan respons JSON atau redirect
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
            }

            return redirect('rooms')->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

}