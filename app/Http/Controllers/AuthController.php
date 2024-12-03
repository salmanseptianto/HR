<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan halaman login hanya dapat diakses oleh tamu
        $this->middleware('guest')->except('logout');

        // Middleware untuk halaman yang memerlukan login
        $this->middleware('auth')->except(['index', 'dologin', 'logout']);
    }

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            $user = Auth::user();

            // Redirect sesuai role jika pengguna sudah login
            if ($user->role == 'admin') {
                return redirect('/admin');
            } elseif ($user->role == 'mm') {
                return redirect('/manager-marketing');
            } elseif ($user->role == 'marketing') {
                return redirect('/marketing');
            }

            // Jika role tidak dikenal, redirect ke halaman default
            return redirect('/login');
        }

        // Jika belum login, tampilkan halaman login
        return view('auth.login');
    }

    public function dologin(Request $request)
    {
        // Validasi input login (email dan password)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah kredensial cocok
        if (Auth::attempt($credentials)) {
            // Autentikasi sukses, set session login
            $request->session()->regenerate();

            // Akses user yang baru saja login
            $user = Auth::user();

            // Cek role user dan redirect sesuai dengan role-nya
            if ($user->role == 'admin') {
                return redirect('/admin');
            } elseif ($user->role == 'mm') {
                return redirect('/manager-marketing');
            } elseif ($user->role == 'marketing') {
                return redirect('/marketing');
            }

            // Jika role tidak dikenal, redirect ke halaman default
            return redirect('/login');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
