<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jadwal;
use App\Models\Absensi;
use Carbon\Carbon;

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

        // Set Carbon to Indonesian
        Carbon::setLocale('id');

        // Get today's day in Indonesian (capitalized)
        $today = ucfirst(Carbon::now()->isoFormat('dddd'));

        // Retrieve schedule based on 'hari' field
        $schedule = Jadwal::where('hari', $today)
            ->orderBy('jam_mulai', 'asc')
            ->get();


        return view('beranda', [
            'absensi' => $absensi,
            'totalHadir' => $totalHadir,
            'totalAlfa' => $totalAlfa,
            'totalSakit' => $totalSakit,
            'totalIzin' => $totalIzin,
            'totalDispen' => $totalDispen,
            'schedule' => $schedule,
            'today' => $today
        ]);
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
