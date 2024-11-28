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
        $room = new Room;

        $room->id_city = $req->post('id_city');
        $room->name_room = $req->post('name_room');
        $room->room_type = $req->post('room_type');
        $room->price_per_month = $req->post('price_per_month');
        $room->square_feet = $req->post('square_feet');
        $room->available_rooms = $req->post('available_rooms');
        $room->description = $req->post('description');
        $room->address = $req->post('address');

        $room->save();

        return redirect('/rooms');
    }
}
