<?php

namespace App\Http\Controllers;

use App\Models\home;
use App\Models\Mandiri;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mandiri = Mandiri::all();
        return view('index.soal', compact('mandiri'));
    }


    public function lihat(Mandiri $mandiri)
    {
        $mapel = $mandiri->mapels()->orderBy('id')->get();

        if ($mapel->isEmpty()) {
            return redirect()->back()->with('error', 'Mapel ini belum memiliki soal.');
        }

        return view('index.lihat-soal', compact('mandiri', 'mapel'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(home $home)
    {
        return view('home.show', compact('home'));
    }

    public function edit(home $home)
    {
        //
    }

    public function update(Request $request, home $home)
    {
        //
    }

    public function destroy(home $home)
    {
        //
    }
}