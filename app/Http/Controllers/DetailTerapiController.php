<?php

namespace App\Http\Controllers;

use App\Models\DetailTerapi;
use App\Models\User;
use Illuminate\Http\Request;

class DetailTerapiController extends Controller
{
    public function index(Request $request)
    {
        $query = DetailTerapi::with('user');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->whereHas('user', fn($u) => $u->where('nama_lengkap', 'like', "%$q%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('metode')) {
            $query->where('metode', $request->metode);
        }

        $terapies = $query->latest()->paginate(10)->withQueryString();

        return view('pages.terapi.index', compact('terapies'));
    }

    public function create()
    {
        $pasiens = User::where('role', 'pasien')->orderBy('created_at', 'desc')->get();
        return view('pages.terapi.create', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $rules = [
            'user_id'        => 'required|exists:users,id',
            'tanggal_terapi' => 'required|date',
            'berat_badan'    => 'required|integer|min:1',
            'diagnosa'       => 'required|string',
            'metode'         => 'required|in:Pasif,Aktif',
            'rpm'            => 'nullable|integer|min:0',
            'durasi'         => 'nullable|integer|min:0',
        ];

        $fields = [
            'user_id',
            'tanggal_terapi',
            'berat_badan',
            'diagnosa',
            'metode',
            'rpm',
            'durasi',
        ];

        if (config('app.activate_rom')) {
            $rules['rom'] = 'nullable|string|max:50';
            $fields[] = 'rom';
        }

        $request->validate($rules);

        DetailTerapi::create($request->only($fields));

        return redirect()->route('terapi.index')
            ->with('success', 'Sesi terapi berhasil ditambahkan.');
    }

    public function edit(DetailTerapi $terapi)
    {
        $pasiens = User::where('role', 'pasien')->orderBy('nama_lengkap')->get();
        return view('pages.terapi.edit', compact('terapi', 'pasiens'));
    }

    public function update(Request $request, DetailTerapi $terapi)
    {
        $rules = [
            'user_id'        => 'required|exists:users,id',
            'tanggal_terapi' => 'required|date',
            'berat_badan'    => 'required|integer|min:1',
            'diagnosa'       => 'required|string',
            'metode'         => 'required|in:Pasif,Aktif',
            'status'         => 'required|in:belum,sudah',
            'rpm'            => 'nullable|integer|min:0',
            'durasi'         => 'nullable|integer|min:0',
        ];

        $fields = [
            'user_id',
            'tanggal_terapi',
            'berat_badan',
            'diagnosa',
            'metode',
            'status',
            'rpm',
            'durasi',
        ];

        if (config('app.activate_rom')) {
            $rules['rom'] = 'nullable|string|max:50';
            $fields[] = 'rom';
        }

        $request->validate($rules);

        $terapi->update($request->only($fields));

        return redirect()->route('terapi.index')
            ->with('success', 'Data terapi berhasil diperbarui.');
    }

    public function destroy(DetailTerapi $terapi)
    {
        $terapi->delete();

        return redirect()->route('terapi.index')
            ->with('success', 'Data terapi berhasil dihapus.');
    }
}
