<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('dashboard.register');
    }

    public function register(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|min:5|max:60',
                'email' => 'required|email|unique:users,email|max:200',
                'password' => 'required|min:5',
            ]);
    
            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['id_role'] = 1;
    
            User::create($validatedData);
    
            return redirect('/login')->with('success', 'Registration Successful! Please Login');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    public function login()
    {
        return view('dashboard.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }
        return back()->with('loginError', 'Login Failed!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
