<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ujian;
use App\Models\Hasil;
use App\Models\Jawaban;

class TryoutController extends Controller
{
    public function index()
    {
        $ujian = Ujian::all();
        $now = now();

        foreach ($ujian as $item) {
            $item->bisa_dikerjakan =
                $item->waktu_mulai &&
                $item->waktu_selesai &&
                $now->between($item->waktu_mulai, $item->waktu_selesai);
        }

        return view('tryout.tryout', compact('ujian'));
    }

    public function show(Ujian $ujian)
    {
        return view('tryout.show', compact('ujian'));
    }

    public function kerjakan(Ujian $ujian, $index = 0)
    {
        // Cek hasil menggunakan kolom 'selesai' (tinyint)
        $hasil = Hasil::where('user_id', Auth::id())
            ->where('ujian_id', $ujian->id)
            ->first();

        // Jika selesai == 1, maka redirect
        if ($hasil && $hasil->selesai == 1) {
            return redirect()->route('tryout.hasil', $ujian->id)
                ->with('warning', 'Anda sudah menyelesaikan ujian ini.');
        }

        $soal_list = $ujian->soals()->get();

        if ($soal_list->isEmpty()) {
            return redirect()->route('tryout.tryout')
                ->with('error', 'Soal untuk ujian ini belum tersedia.');
        }

        if (!isset($soal_list[$index])) {
            return redirect()->route('tryout.kerjakan', ['ujian' => $ujian->id, 'index' => 0]);
        }

        $soal = $soal_list[$index];

        $jawaban_user = Jawaban::where('user_id', Auth::id())
            ->where('ujian_id', $ujian->id)
            ->where('soal_id', $soal->id)
            ->first();

        $jawaban_all = Jawaban::where('user_id', Auth::id())
            ->where('ujian_id', $ujian->id)
            ->pluck('jawaban', 'soal_id');

        return view('tryout.kerjakan', compact(
            'ujian',
            'soal_list',
            'soal',
            'index',
            'jawaban_user',
            'jawaban_all'
        ));
    }

    public function akhiri(Ujian $ujian)
    {
        $total_soal = $ujian->soals()->count();
        $jawaban_benar = 0;

        $jawabans = Jawaban::where('user_id', Auth::id())
            ->where('ujian_id', $ujian->id)
            ->get();

        foreach ($jawabans as $jawab) {
            if ($jawab->soal && $jawab->jawaban == $jawab->soal->kunci_jawaban) {
                $jawaban_benar++;
            }
        }

        $skor = ($total_soal > 0) ? ($jawaban_benar / $total_soal) * 100 : 0;

        // Gunakan updateOrCreate agar aman
        Hasil::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'ujian_id' => $ujian->id,
            ],
            [
                'skor' => $skor,       // SESUAI DB: 'skor'
                'selesai' => 1,        // SESUAI DB: 1 (Tinyint True)
                // peringatan tidak diupdate disini agar history pelanggaran tidak hilang
            ]
        );

        return redirect()->route('tryout.hasil', $ujian->id);
    }

    public function pelanggaran(Request $request)
    {
        $ujian_id = $request->input('ujian_id');
        $user_id = Auth::id();

        // 1. Cari Data Hasil secara Manual
        $hasil = Hasil::where('user_id', $user_id)
                      ->where('ujian_id', $ujian_id)
                      ->first();

        // 2. Jika Belum Ada, Buat Baru
        if (!$hasil) {
            $hasil = new Hasil();
            $hasil->user_id = $user_id;
            $hasil->ujian_id = $ujian_id;
            $hasil->skor = 0;          // SESUAI DB
            $hasil->peringatan = 0;    // KOLOM BARU
            $hasil->selesai = 0;       // FALSE
            $hasil->save();
        }

        // 3. Jika Sudah Selesai, Return selesai
        if ($hasil->selesai == 1) {
            return response()->json(['status' => 'selesai']);
        }

        // 4. Tambah Peringatan
        $hasil->peringatan += 1;

        // 5. Cek Batas Pelanggaran (>= 3)
        if ($hasil->peringatan >= 3) {
            
            // Hitung Skor Akhir
            $ujian = Ujian::find($ujian_id);
            if ($ujian) {
                $total_soal = $ujian->soals()->count();
                $jawaban_benar = 0;
                
                $jawabans = Jawaban::where('user_id', $user_id)
                    ->where('ujian_id', $ujian_id)
                    ->get();

                foreach ($jawabans as $jawab) {
                    if ($jawab->soal && $jawab->jawaban == $jawab->soal->kunci_jawaban) {
                        $jawaban_benar++;
                    }
                }
                
                $skor = ($total_soal > 0) ? ($jawaban_benar / $total_soal) * 100 : 0;
                $hasil->skor = $skor; // Simpan ke kolom 'skor'
            }

            $hasil->selesai = 1; // Set Selesai = True
            $hasil->save();

            return response()->json(['status' => 'selesai']);
        }

        // Simpan Peringatan
        $hasil->save();

        return response()->json([
            'status' => 'peringatan',
            'peringatan' => $hasil->peringatan
        ]);
    }
}