<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jadwal;
use App\Models\Absensi;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        $absensi = Absensi::all();
        $totalHadir = Absensi::where('isHadir', 'H')->count();
        $totalAlfa = Absensi::where('isHadir', 'T')->count();
        $totalSakit = Absensi::where('isHadir', 'S')->count();
        $totalIzin = Absensi::where('isHadir', 'I')->count();
        $totalDispen = Absensi::where('isHadir', 'D')->count();
        return view('beranda', ['jadwal' => $jadwal,
        'absensi' => $absensi,
        'totalHadir' => $totalHadir,
        'totalAlfa' => $totalAlfa,
        'totalSakit' => $totalSakit,
        'totalIzin' => $totalIzin,
        'totalDispen' => $totalDispen]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
