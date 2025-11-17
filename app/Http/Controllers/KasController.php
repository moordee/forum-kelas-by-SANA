<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kas;
use App\Models\Pengeluaran;

class KasController extends Controller
{
    public function show_kas() {
        $kas_data = Kas::all();
        return view('kas', ['kas_data' => $kas_data]);
    }

    public function show_pengeluaran() {
        $totalExpenses = Pengeluaran::sum('jumlah');
        return view('laporan', ['totalExpenses' => $totalExpenses]);
    }

    public function show_penunggak() {
        $penunggak = DB::table('tb_kas')->get();
        return view('laporan', ['penunggak' => $penunggak]);
    }

    public function total_kas() {
        $totalKas = Kas::sum('jumlah_bayar');
        return view('laporan', ['totalKas' => $totalKas]);
    }

    public function total_tunggakan() {
        $totalTunggakan = Kas::sum('jumlah_tunggakan');
        return view('laporan', ['totalTunggakan' => $totalTunggakan]);
    }

    public function show_laporan() {
        $totalKas = Kas::sum('jumlah_bayar');
        $totalTunggakan = Kas::sum('jumlah_tunggakan');
        $totalExpenses = Pengeluaran::sum('jumlah');
        $penunggak = DB::table('tb_kas')->get();

        return view('laporan', [
            'totalKas' => $totalKas,
            'totalTunggakan' => $totalTunggakan,
            'totalExpenses' => $totalExpenses,
            'penunggak' => $penunggak
        ]);
    }
}
