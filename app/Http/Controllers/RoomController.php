<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {   
        $rooms = Room::all();
        $cities = City::all();
        $user = Auth::user();
        $data = RoomImage::all();
        return view('dashboard.rooms', compact('rooms', 'cities', 'user', 'data'));
    }

    public function store(Request $req)
{
    // Create a new room instance
    $room = new Room;
    $room_image = new RoomImage;
    $file_path = public_path('uploads');
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
    $req->validate([
        "room_image"=>'required|mimes:jpg,png,pdf|max:2048'
    ]); 
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
        $room_image->image = $path;

        
        // Update the room in the database with the image path
        $room->save();

        return redirect('/rooms');
    }
}

}
