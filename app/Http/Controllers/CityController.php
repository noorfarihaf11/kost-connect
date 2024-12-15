<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('dashboard.cities', compact('cities'));
    }

    public function store(Request $req)
    {
        $city = new City;

        $city->name_city = $req->post('name_city');
        $city->slug = $req->post('slug');

        $city->save();

        return redirect('/cities');
    }

    public function update(Request $request, $id)
    {
        try {
            $city = City::findOrFail($id);
            $city->update($request->all());
    
            if ($request->ajax()) {
                // Kembalikan respons JSON jika permintaan datang dari AJAX
                return response()->json(['success' => true, 'message' => 'City updated successfully!']);
            }
    
            // Jika bukan AJAX, lakukan redirect dengan pesan sukses
            return redirect('cities')->with('success', 'City updated successfully!');
        } catch (\Exception $e) {
            // Tangani error dan kembalikan respons JSON atau redirect
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Update failed: ' . $e->getMessage()]);
            }
    
            return redirect('cities')->with('error', 'Update failed: ' . $e->getMessage());
        }
    }    

    public function destroy($id)
    {
        $city = City::find($id);

        if ($city) {
            $city->delete();
            return response()->json(['success' => true]);
        }

        Log::error('City not found: ' . $id);
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
    
}
