<?php

namespace App\Http\Controllers;



use App\Models\City;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
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

    public function indextambahroom()
{
    $user = Auth::user();
    $rooms = Room::with('roomImages')->where('id_owner', $user->id_user)->get();
    $cities = City::all();
    return view('dashboard.roomowner', compact('cities', 'user', 'rooms'));
}


    public function tambahroom(Request $req)
    {
        $room = new Room;

        $iduser = Auth::id();

        $room->id_city = $req->post('id_city');
        $room->name_room = $req->post('name_room');
        $room->room_type = $req->post('room_type');
        $room->price_per_month = $req->post('price_per_month');
        $room->square_feet = $req->post('square_feet');
        $room->available_rooms = $req->post('available_rooms');
        $room->description = $req->post('description');
        $room->id_owner = $iduser;
        $room->address = $req->post('address');
        $room->is_available = $req->post('is_available');


    // Save the room details into the database
    $req->validate([
        "room_image"=>'required|mimes:jpg,png,pdf|max:2048'
    ]);
    $room->save();

    // Check if there is a file uploaded for room image
    $file_name = null;

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $file_name = $image->store('room_images', 'public');

            // Menyimpan data gambar ke tabel room_images
            $roomImage = new RoomImage;
            $roomImage->id_room = $room->id_room;  // Menyimpan id_room yang baru saja disimpan
            $roomImage->image = $file_name;    // Menyimpan path gambar
            $roomImage->save();
        }

        // Update the room in the database with the image path
        $room->save();

        // $owner = Owner::where('user_id', Auth::id())->first();
        // if ($owner && $owner->status === 'inactive') {
        //     $owner->update(['status' => 'active']);
        // }

        return redirect('/rooms');
    }


    public function update(Request $request, $id)
{
    $room = Room::findOrFail($id);
    $room->update($request->all());
    return response()->json(['success' => true]);
}

public function destroy($id)
{
    $room = Room::findOrFail($id);
    $room->delete();
    return response()->json(['success' => true]);
}
}

