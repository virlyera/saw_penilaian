<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi jika email atau password kosong
        if (empty($request->email) || empty($request->password)) {
            return back()->withErrors([
                'email' => 'Email dan password harus diisi.',
            ]);
        }
        // Validasi jika email kosong
        if (empty($request->email)) {
            return back()->withErrors([
                'email' => 'Email harus diisi.',
            ]);
        }

        // Validasi jika password kosong
        if (empty($request->password)) {
            return back()->withErrors([
                'password' => 'Password harus diisi.',
            ]);
        }

        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {

            // $request->session()->regenerate();
            $user = Auth::user(); // Ambil informasi pengguna setelah berhasil login

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai. Mohon di cek kembali',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:4',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
