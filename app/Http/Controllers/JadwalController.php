<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function today()
    {
        // Set Carbon to Indonesian
        Carbon::setLocale('id');

        // Get today's day in Indonesian (capitalized)
        $today = ucfirst(Carbon::now()->isoFormat('dddd'));

        // Retrieve schedule based on 'hari' field
        $schedule = Jadwal::where('hari', $today)
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('beranda', compact('schedule', 'today'));
    }
}
