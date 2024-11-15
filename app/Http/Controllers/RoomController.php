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
}
