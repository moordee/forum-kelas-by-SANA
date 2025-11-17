<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = DB::table('tb_absensi')->get();
        return view('presensi', ['absensi' => $absensi]);
    }
}
