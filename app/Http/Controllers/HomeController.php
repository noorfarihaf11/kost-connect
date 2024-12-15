<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function rooms()
    {
        $rooms = Room::all();
        return view('home.kost', compact('rooms'));
    }

}
