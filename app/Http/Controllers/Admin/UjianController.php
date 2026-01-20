<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // Tidak perlu Auth lagi karena tidak simpan user_id

class UjianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        
        $query = Ujian::latest();

        if ($search) {
            $query->where('nama_ujian', 'like', "%{$search}%")
                  ->orWhere('mapel', 'like', "%{$search}%");
        }

        $ujians = $query->paginate(10)->withQueryString();

        return view('admin.ujian.index', compact('ujians'));
    }

    public function create()
    {
        return view('admin.ujian.create');
    }

    public function store(Request $request)
    {
        // Validasi disesuaikan (Hapus durasi)
        $request->validate([
            'nama_ujian'    => 'required|string|max:255',
            'mapel'         => 'required|string|max:255',
            'kelas'         => 'required|string|max:50',
            'waktu_mulai'   => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        // Simpan data (Hapus user_id, durasi, token)
        Ujian::create([
            'nama_ujian'    => $request->nama_ujian,
            'mapel'         => $request->mapel,
            'kelas'         => $request->kelas,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'acak_soal'     => 0, // Default nilai sesuai struktur DB
            'acak_jawaban'  => 0,
            'tampilkan_hasil'=> 0,
        ]);

        return redirect()->route('admin.ujian.index')->with('success', 'Ujian berhasil dibuat.');
    }

    public function show($id)
    {
        // Hapus relasi user di sini juga jika ada
        $ujian = Ujian::with('soals')->findOrFail($id);
        return view('admin.ujian.show', compact('ujian'));
    }

    public function edit($id)
    {
        $ujian = Ujian::findOrFail($id);
        return view('admin.ujian.edit', compact('ujian'));
    }

    public function update(Request $request, $id)
    {
        $ujian = Ujian::findOrFail($id);

        $request->validate([
            'nama_ujian'    => 'required|string|max:255',
            'mapel'         => 'required|string|max:255',
            'kelas'         => 'required|string|max:50',
            'waktu_mulai'   => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        // Update data (Hapus durasi)
        $ujian->update([
            'nama_ujian'    => $request->nama_ujian,
            'mapel'         => $request->mapel,
            'kelas'         => $request->kelas,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('admin.ujian.index')->with('success', 'Data ujian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ujian = Ujian::findOrFail($id);
        $ujian->delete();

        return redirect()->route('admin.ujian.index')->with('success', 'Ujian berhasil dihapus.');
    }
}