<?php

use Illuminate\Support\Facades\Route;

// Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MandiriController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\UjianController as AdminUjianController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('home'); })->name('home');
Route::get('/soal', [HomeController::class, 'index'])->name('index.soal');

// Halaman Statis (Opsional, jika tidak ada controller)
Route::get('/belajar', function () { return view('belajar'); })->name('belajar');

// Mandiri (Public View)
Route::resource('home', HomeController::class);
Route::get('/mandiri/{mandiri}', [HomeController::class, 'show'])->name('index.show');
Route::get('/mandiri/{mandiri}/lihat-soal', [HomeController::class, 'lihat'])->name('index.lihat-soal');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

// Login & Register Views
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');

// Auth Processes
Route::post('/login', [AuthController::class, 'loginProses'])->name('loginProses');
Route::post('/daftar', [AuthController::class, 'daftarProses'])->name('daftarProses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ROLE: GURU (Administrator Ujian)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->group(function () {

    // Dashboard Guru
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Akun Guru
    Route::get('/dashboard/akun-guru', [AuthController::class, 'akunguru'])->name('akun-guru');
    Route::post('/dashboard/akun-guru', [AuthController::class, 'storeGuru'])->name('storeguru');

    // 1. MANAJEMEN MANDIRI (BANK SOAL / LATIHAN)
    Route::get('/mandiri', [MandiriController::class, 'index'])->name('mandiri.materi'); 
    Route::resource('mandiri', MandiriController::class)->except(['index']);
    
    // Import Soal Latihan
    Route::post('/mandiri/latihan/import', [MandiriController::class, 'import']);

    // Mapel (Soal-soal Latihan Mandiri)
    Route::get('/mandiri/{mandiri}/mapel/create', [MapelController::class, 'create'])->name('mandiri.mapel');
    Route::post('/mandiri/{mandiri}/mapel', [MapelController::class, 'store'])->name('mapel.store');
    
    Route::get('/mandiri/{mandiri}/mapel/{mapel}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
    Route::put('/mandiri/{mandiri}/mapel/{mapel}', [MapelController::class, 'update'])->name('mapel.update');
    Route::delete('/mandiri/{mandiri}/mapel/{mapel}', [MapelController::class, 'destroy'])->name('mapel.destroy');
    
    Route::post('/mandiri/{mandiri}/mapel/import', [MapelController::class, 'importExcel'])->name('mapel.import');


    // 2. MANAJEMEN UJIAN (TRYOUT / EXAM)
    Route::resource('ujian', UjianController::class);
    Route::post('/ujian/{ujian}/toggle', [UjianController::class, 'toggle'])->name('ujian.toggle');

    // Soal Ujian
    Route::get('ujian/{ujian}/soal/create', [SoalController::class, 'create'])->name('soal.create');
    Route::post('/ujian/{ujian}/soal', [SoalController::class, 'store'])->name('soal.store');
    
    Route::get('/ujian/{ujian}/soal/{soal}/edit', [SoalController::class, 'edit'])->name('soal.edit');
    Route::put('/ujian/{ujian}/soal/{soal}', [SoalController::class, 'update'])->name('soal.update');
    Route::delete('/ujian/{ujian}/soal/{soal}', [SoalController::class, 'destroy'])->name('soal.destroy');

    // Import & Upload untuk Soal Ujian
    Route::post('/ujian/{ujian}/soal/import-excel', [SoalController::class, 'importExcel'])->name('soal.import.excel');
    Route::post('soal/upload', [SoalController::class, 'upload'])->name('soal.upload'); 
});


/*
|--------------------------------------------------------------------------
| ROLE: SISWA (Peserta Ujian)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/tryout', [TryoutController::class, 'index'])->name('tryout.index');
    Route::get('/tryout/{ujian}', [TryoutController::class, 'show'])->name('tryout.show');
    Route::middleware(['nocache', 'cek.ujian.selesai'])->group(function () {
        Route::get('/tryout/{ujian}/kerjakan/{index?}', [TryoutController::class, 'kerjakan'])->name('tryout.kerjakan');
        Route::post('/tryout/jawab', [JawabanController::class, 'jawab'])->name('tryout.jawab');
        Route::post('/ujian/pelanggaran', [TryoutController::class, 'pelanggaran'])->name('ujian.pelanggaran');
        Route::post('/ujian/keluar', [TryoutController::class, 'keluar'])->name('ujian.keluar');
    });

    // Akhiri Ujian
    Route::post('/tryout/{ujian}/selesai', [JawabanController::class, 'selesai'])->name('tryout.selesai');

    // Lihat Hasil Ujian
    Route::get('/tryout/{ujian}/hasil', [HasilController::class, 'hasil'])->name('tryout.hasil');

    // Reset Ujian (Opsional / Debugging)
    Route::get('/tryout/{ujian}/reset', [TryoutController::class, 'reset'])->name('tryout.reset');

});

/*
|--------------------------------------------------------------------------
| ROLE: ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/guru', GuruController::class)->names('guru');
    Route::resource('admin/siswa', SiswaController::class)->names('siswa');
    Route::resource('admin/ujian', AdminUjianController::class)->names('admin.ujian');
});