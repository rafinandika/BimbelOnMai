<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ujian;
use App\Models\Soal;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data statistik untuk dashboard
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalUjian = Ujian::count();
        $totalSoal = Soal::count();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalUjian', 'totalSoal'));
    }
}