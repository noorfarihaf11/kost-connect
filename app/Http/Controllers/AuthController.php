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
        return view('dashboard.register', ['role' => 'user']);
    }

    public function register(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|min:5|max:60',
                'email' => 'required|email|unique:users,email|max:200',
                'password' => 'required|min:5',
                'no_tlp' => 'nullable|numeric|digits_between:10,13',
            ]);
            
            $validatedData['id_role'] = 3;
            $validatedData['password'] = bcrypt($validatedData['password']);
    
            User::create($validatedData);
    
            return redirect('/login')->with('success', 'Registration Successful! Please Login');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    public function showRegisterPemilik()
    {
        return view('dashboard.register', ['role' => 'pemilik']);
    }

    public function registerPemilik(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:60',
            'email' => 'required|email|unique:users,email|max:200',
            'password' => 'required|min:5',
            'no_tlp' => 'required|numeric|digits_between:10,13',
        ]);

        $validatedData['id_role'] = 2; 
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login sebagai pemilik kos.');
    }

    public function login()
    {
        return view('dashboard.login');
    }

    public function showLoginOptions()
    {
        return view('home.masuk');
    }

    public function showRegisterForm(Request $request)
    {
        $role = $request->query('role');

        // Validasi role
        if (!in_array($role, ['pemilik', 'pencari'])) {
            return redirect()->back()->withErrors(['error' => 'Role tidak valid.']);
        }

        // Tampilkan view register dengan role yang dipilih
        return view('dashboard.register', compact('role'));
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
