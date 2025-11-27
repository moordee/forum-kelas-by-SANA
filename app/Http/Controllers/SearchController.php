<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Kas;
use App\Models\Pengeluaran;

class SearchController extends Controller
{
    public function cariNamaPresensi(Request $request)
    {
        $q = $request->query('q'); // GET parameter

        // Base query
        $query = Absensi::query();

        if ($q) {
            // simple, safe LIKE search across two columns
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_lengkap', 'like', "%{$q}%");
            });
        }
        $items = $query->orderBy('tanggal', 'desc')->get();
        $absensi = Absensi::orderBy('tanggal', 'desc')->get();

        return view('presensi', [
            'absensi' => $absensi,
            'items' => $items,
            'q' => $q
        ]);
    }

    public function cariNamaKas(Request $request)
    {
        $q = $request->query('q'); // GET parameter

        // Base query
        $query = Kas::query();

        if ($q) {
            // simple, safe LIKE search across two columns
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_lengkap', 'like', "%{$q}%");
            });
        }

        $items = $query->orderBy('tanggal_bayar', 'desc')->get();

        $kas_data = Kas::orderBy('tanggal_bayar', 'desc')->get();

        return view('kas', [
            'kas_data' => $kas_data,
            'items' => $items,
            'q' => $q
        ]);
    }

    public function cariNamaLaporan(Request $request)
    {
        $q = $request->query('q'); // GET parameter

        // Base query
        $query = Kas::query();

        if ($q) {
            // simple, safe LIKE search across two columns
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_lengkap', 'like', "%{$q}%");
            });
        }

        $items = $query->orderBy('tanggal_bayar', 'desc')->get();

        $totalKas = Kas::sum('jumlah_bayar');
        $totalTunggakan = Kas::sum('jumlah_tunggakan');
        $totalExpenses = Pengeluaran::sum('jumlah');
        $penunggak = Kas::all();

        return view('laporan', [
            'totalKas' => $totalKas,
            'totalTunggakan' => $totalTunggakan,
            'totalExpenses' => $totalExpenses,
            'penunggak' => $penunggak,
            'items' => $items,
            'q' => $q
        ]);
    }
}
