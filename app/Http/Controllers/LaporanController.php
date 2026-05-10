<?php

namespace App\Http\Controllers;

use App\Models\DetailTerapi;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private function formatChartDateLabel($tanggal): string
    {
        $hariIndo = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $date = \Carbon\Carbon::parse($tanggal);

        return $hariIndo[$date->dayOfWeek] . ' ' . $date->format('d/m');
    }

    public function index()
    {
        return view('pages.laporan.index');
    }

    public function filter(Request $request)
    {
        $request->validate([
            'kode_pasien'   => 'required|string',
            'tanggal_start' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_start',
        ]);

        $pasien = User::where('kode_pasien', $request->kode_pasien)
            ->where('role', 'pasien')
            ->first();

        if (!$pasien) {
            return back()
                ->withInput()
                ->withErrors(['kode_pasien' => 'Kode pasien tidak ditemukan.']);
        }

        $terapiData = DetailTerapi::where('user_id', $pasien->id)
            ->whereBetween('tanggal_terapi', [
                $request->tanggal_start,
                $request->tanggal_akhir,
            ])
            ->orderBy('tanggal_terapi')
            ->get();

        $grouped = $terapiData->groupBy('tanggal_terapi');

        $chartLabels = [];
        $chartDurasi = [];
        $chartRpm    = [];

        foreach ($grouped as $tanggal => $rows) {
            $chartLabels[] = $this->formatChartDateLabel($tanggal);
            $chartDurasi[] = round($rows->avg('durasi'), 0);
            $chartRpm[]    = round($rows->avg('rpm'), 0);
        }

        return view('pages.laporan.index', compact(
            'pasien',
            'chartLabels',
            'chartDurasi',
            'chartRpm',
        ))->with([
            'kode_pasien'   => $request->kode_pasien,
            'tanggal_start' => $request->tanggal_start,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);
    }

    public function download(Request $request)
    {
        $pasien = User::where('kode_pasien', $request->kode_pasien)
            ->where('role', 'pasien')
            ->firstOrFail();

        $terapiData = DetailTerapi::where('user_id', $pasien->id)
            ->whereBetween('tanggal_terapi', [
                $request->tanggal_start,
                $request->tanggal_akhir,
            ])
            ->orderBy('tanggal_terapi')
            ->get();

        $data = [
            'pasien'           => $pasien,
            'tanggal_start'    => $request->tanggal_start,
            'tanggal_akhir'    => $request->tanggal_akhir,
            'chart_durasi_img' => $request->chart_durasi_img,
            'chart_rpm_img'   => $request->chart_rpm_img,
            'terapiData'       => $terapiData,
        ];

        $pdf = Pdf::loadView('pages.laporan.pdf', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-terapi-' . $pasien->nama_lengkap . '.pdf');
    }



    public function laporan_guest()
    {
        return view('pages.laporan.laporan-guest');
    }

    private function getLaporanData($request)
    {
        $pasien = User::where('kode_pasien', $request->kode_pasien)
            ->where('role', 'pasien')
            ->first();

        if (!$pasien) {
            return ['error' => 'Kode pasien tidak ditemukan.'];
        }

        $terapiData = DetailTerapi::where('user_id', $pasien->id)
            ->whereBetween('tanggal_terapi', [
                $request->tanggal_start,
                $request->tanggal_akhir,
            ])
            ->orderBy('tanggal_terapi')
            ->get();

        $grouped = $terapiData->groupBy('tanggal_terapi');

        $chartLabels = [];
        $chartDurasi = [];
        $chartRpm    = [];

        foreach ($grouped as $tanggal => $rows) {
            $chartLabels[] = $this->formatChartDateLabel($tanggal);
            $chartDurasi[] = round($rows->avg('durasi'), 0);
            $chartRpm[]    = round($rows->avg('rpm'), 0);
        }

        return compact('pasien', 'chartLabels', 'chartDurasi', 'chartRpm');
    }

    public function filter_guest(Request $request)
    {
        $request->validate([
            'kode_pasien'   => 'required|string',
            'tanggal_start' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_start',
        ]);

        $data = $this->getLaporanData($request);

        if (isset($data['error'])) {
            return back()->withInput()->withErrors(['kode_pasien' => $data['error']]);
        }

        return view('pages.laporan.laporan-guest', $data)->with([
            'kode_pasien'   => $request->kode_pasien,
            'tanggal_start' => $request->tanggal_start,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);
    }
}
