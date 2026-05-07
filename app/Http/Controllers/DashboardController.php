<?php

namespace App\Http\Controllers;

use App\Models\DetailTerapi;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pasien
        $totalPasien = User::where('role', 'pasien')->count();

        // Total terapi
        $totalTerapi = DetailTerapi::count();

        // Rata-rata durasi (ignore null otomatis)
        $avgDurasi = DetailTerapi::avg('durasi');

        // Rata-rata rpm
        $avgRpm = DetailTerapi::avg('rpm');

        // Pasien terakhir
        $lastPasien = User::where('role', 'pasien')
            ->latest()
            ->first();

        // ── Data 7 hari terakhir untuk grafik ──────────────────────────────

        // Ambil rata-rata durasi & rpm per hari selama 7 hari terakhir
        $terapiPerHari = DetailTerapi::selectRaw('
                tanggal_terapi,
                AVG(durasi) as avg_durasi,
                AVG(rpm)    as avg_rpm
            ')
            ->whereBetween('tanggal_terapi', [
                Carbon::today()->subDays(6)->toDateString(),
                Carbon::today()->toDateString(),
            ])
            ->groupBy('tanggal_terapi')
            ->orderBy('tanggal_terapi')
            ->get()
            ->keyBy('tanggal_terapi'); // key by tanggal supaya mudah di-lookup

        // Bangun array 7 hari berurutan (isi 0 kalau tidak ada data)
        $chartLabels  = [];
        $chartDurasi  = [];
        $chartRpm     = [];

        $hariIndo = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal   = Carbon::today()->subDays($i);
            $keyDate   = $tanggal->toDateString(); // format: 2025-05-01
            $dayName   = $hariIndo[$tanggal->dayOfWeek];
            $label     = $dayName . ' ' . $tanggal->format('d/m');

            $chartLabels[] = $label;
            $chartDurasi[] = isset($terapiPerHari[$keyDate])
                ? round($terapiPerHari[$keyDate]->avg_durasi, 0)
                : 0;
            $chartRpm[]    = isset($terapiPerHari[$keyDate])
                ? round($terapiPerHari[$keyDate]->avg_rpm, 0)
                : 0;
        }

        return view('pages.dashboard', compact(
            'totalPasien',
            'totalTerapi',
            'avgDurasi',
            'avgRpm',
            'lastPasien',
            'chartLabels',
            'chartDurasi',
            'chartRpm',
        ));
    }
}
