<?php

namespace App\Http\Controllers;

use App\Models\PengingatTerapi;
use App\Models\User;
use Illuminate\Http\Request;

class PengingatTerapiController extends Controller
{
    public function index(Request $request)
    {
        $query = PengingatTerapi::with('user')
            ->whereHas('user', function ($q) use ($request) {
                if ($request->filled('search')) {
                    $q->where('nama_lengkap', 'like', '%' . $request->search . '%');
                }
            });

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengingats = $query->latest()->paginate(10)->withQueryString();
        $total = PengingatTerapi::count();

        return view('pages.pengingat-terapi.index', compact('pengingats', 'total'));
    }

    public function create()
    {
        $users = User::where('role', 'pasien')->orderBy('created_at', 'desc')->get();
        return view('pages.pengingat-terapi.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'                    => 'required|exists:users,id',
            'tanggal_terapi_selanjutnya' => 'required|date',
        ]);

        PengingatTerapi::create($request->only('user_id', 'tanggal_terapi_selanjutnya'));

        return redirect()->route('pengingat-terapi.index')
            ->with('success', 'Pengingat terapi berhasil ditambahkan.');
    }

    public function show(PengingatTerapi $pengingatTerapi)
    {
        $pengingatTerapi->load('user');
        return response()->json($pengingatTerapi);
    }

    public function edit(PengingatTerapi $pengingatTerapi)
    {
        $users = User::where('role', 'pasien')->orderBy('created_at', 'desc')->get();
        return view('pages.pengingat-terapi.edit', compact('pengingatTerapi', 'users'));
    }

    public function update(Request $request, PengingatTerapi $pengingatTerapi)
    {
        $request->validate([
            'user_id'                    => 'required|exists:users,id',
            'tanggal_terapi_selanjutnya' => 'required|date',
        ]);

        $pengingatTerapi->update($request->only('user_id', 'tanggal_terapi_selanjutnya'));

        return redirect()->route('pengingat-terapi.index')
            ->with('success', 'Pengingat terapi berhasil diperbarui.');
    }

    public function destroy(PengingatTerapi $pengingatTerapi)
    {
        $pengingatTerapi->delete();
        return redirect()->route('pengingat-terapi.index')
            ->with('success', 'Pengingat terapi berhasil dihapus.');
    }
}
