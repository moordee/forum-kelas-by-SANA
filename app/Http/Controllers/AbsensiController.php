<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = DB::table('tb_absensi')->orderBy('no_absen', 'asc')->get();
        $items = $absensi;
        $q = null;

        return view('presensi', ['absensi' => $absensi, 'items' => $items, 'q' => $q]);
    }
}
