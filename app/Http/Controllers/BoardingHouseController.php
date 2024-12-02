<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\BoardingHouse;

class BoardingHouseController extends Controller
{
    public function index()
    {
        $owners = Owner::all();
        $houses = BoardingHouse::all();

        return view('dashboard.boardinghouse', compact('owners','houses'));
    }
}
