<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\City;
use App\Models\BoardingHouse;
use Illuminate\Support\Facades\Auth;

class BoardingHouseController extends Controller
{
    public function index()
    {
        $owner = Owner::where('id_user', Auth::id())->first();

        if ($owner) {
            $houses = BoardingHouse::where('id_owner', $owner->id_owner)->get();
            $owners = collect([$owner]); // 
        } else {
            $owners = Owner::all(); //
            $houses = BoardingHouse::all(); // 
        }

        $cities = City::all();

        return view('dashboard.boardinghouse', compact('owners', 'houses', 'cities'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $owner = Owner::where('id_user', Auth::id())->first();

        $house = new BoardingHouse();
        $house->id_owner = $owner->id_owner;
        $house->id_city = $request->post('id_city');
        $house->name = $request->post('name');
        $house->address = $request->post('address');
        $house->gender_type = $request->post('gender_type');

        if ($request->hasFile('image')) {
            $fileName = $request->file('image')->store('house_images', 'public');
            $house->image = $fileName;

            $owner->owner_status = 'active'; // Mengubah status menjadi active
            $owner->save();
        }

        $house->save();

        return redirect()->back()->with('success', 'Data rumah berhasil disimpan!');
    }
}
