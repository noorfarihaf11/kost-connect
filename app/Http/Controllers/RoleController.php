<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles', compact('roles'));
    }

    public function store(Request $req)
    {
        $roles = new Role;

        $roles->name_role = $req->post('name_role');

        $roles->save();

        return redirect('/roles');
    }

    public function update(Request $request, $id)
    {
        try {
            $roles = Role::findOrFail($id);
            $roles->update($request->all());
    
            if ($request->ajax()) {
                // Kembalikan respons JSON jika permintaan datang dari AJAX
                return response()->json(['success' => true, 'message' => 'Role updated successfully!']);
            }
    
            // Jika bukan AJAX, lakukan redirect dengan pesan sukses
            return redirect('cities')->with('success', 'Role updated successfully!');
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
        $roles = Role::find($id);

        if ($roles) {
            $roles->delete();
            return response()->json(['success' => true]);
        }

        Log::error('Role not found: ' . $id);
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
}
