<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 1. Cek Role ADMIN
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            // 2. Cek Role GURU
            elseif ($user->role === 'guru') {
                return redirect()->route('dashboard');
            }

            // 3. Default: SISWA
            return redirect()->route('tryout.index');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function daftar()
    {
        return view('daftar');
    }

    public function daftarProses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa', // Default pendaftaran umum tetap 'siswa'
        ]);

        Auth::login($user);

        return redirect()->route('tryout.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
    
    public function akunguru()
    {
        $guru = User::where('role', 'guru')->get();
        return view('dashboard.akun-guru', compact('guru'));
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('akun-guru')
            ->with('success', 'Akun guru berhasil ditambahkan.');
    }
}