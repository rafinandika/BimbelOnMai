<?php

namespace App\Http\Controllers;

use App\Models\Mandiri;
use App\Models\Mapel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;

class MandiriController extends Controller
{
    /**
     * Menampilkan daftar mata pelajaran (Menu Utama)
     */
    public function index()
    {
        $mandiris = Mandiri::all();
        return view('mandiri.materi', compact('mandiris'));
    }

    /**
     * Import Soal dari Excel (FIX GAMBAR HILANG)
     */
    public function import(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Ambil header baris pertama, bersihkan spasi, dan jadikan huruf kecil
        // Contoh header Excel: "Soal", "A", "B", "C", "D", "Kunci"
        $header = array_map(fn($h) => strtolower(trim($h)), $rows[0]);
        unset($rows[0]); // Hapus baris header dari data

        // DAFTAR TAG YANG DIIZINKAN (Agar gambar <img> tidak terhapus)
        $allowed_tags = '<img><p><br><b><i><u><strong><em><span><div><ul><ol><li><table><tr><td><th><tbody><thead>'; 

        foreach ($rows as $row) {
            // Skip baris kosong atau tidak lengkap
            if (count($row) < count($header)) continue;

            // Gabungkan header dengan data baris ini
            // Gunakan array_slice untuk menghindari error jika jumlah kolom data > header
            $data = array_combine($header, array_slice($row, 0, count($header)));

            // Simpan ke database (Relasi ke tabel Mapel/Soal)
            // Pastikan Anda memiliki Model 'Mapel' yang terhubung ke tabel soal
            Mapel::create([
                'mandiri_id' => $id, // ID Mapel Induk
                'pertanyaan' => strip_tags($data['soal'] ?? '', $allowed_tags),
                'a'          => strip_tags($data['a'] ?? '', $allowed_tags),
                'b'          => strip_tags($data['b'] ?? '', $allowed_tags),
                'c'          => strip_tags($data['c'] ?? '', $allowed_tags),
                'd'          => strip_tags($data['d'] ?? '', $allowed_tags),
                'kunci_jawaban' => strtoupper($data['kunci'] ?? $data['jawaban'] ?? $data['key'] ?? null),
            ]);
        }

        return redirect()->route('mandiri.show', $id)
            ->with('success', 'Soal berhasil diimport!');
    }

    /**
     * Form Tambah Mapel
     */
    public function create()
    {
        return view('mandiri.create');
    }

    /**
     * Simpan Mapel Baru
     */
    public function store(Request $request)
    {
       $request->validate([
            'nama_mapel' => 'required|string|max:100',
        ]);

        Mandiri::create([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return redirect()->back()
            ->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }

    /**
     * Menampilkan Detail Mapel & Daftar Soal (FIX ARGUMENT ERROR)
     */
    public function show($id)
    {
        // Menggunakan $id (bukan Model Binding) agar lebih fleksibel & aman
        $mandiri = Mandiri::with('mapels')->findOrFail($id);
        
        return view('mandiri.show', compact('mandiri'));
    }

    /**
     * Form Edit (Kosongkan jika tidak dipakai)
     */
    public function edit(Mandiri $mandiri)
    {
        //
    }

    /**
     * Update Data
     */
    public function update(Request $request, Mandiri $mandiri)
    {
        //
    }

    /**
     * Hapus Mapel beserta Soalnya
     */
    public function destroy($id)
    {
        $mandiri = Mandiri::findOrFail($id);
        $mandiri->delete();
        
        return redirect()->route('mandiri.materi')
            ->with('success', 'Mata Pelajaran dan semua soalnya berhasil dihapus');
    }
}