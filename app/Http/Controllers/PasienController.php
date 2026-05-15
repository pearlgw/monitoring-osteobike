<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'pasien');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($q2) use ($q) {
                $q2->where('nama_lengkap', 'like', "%$q%")
                    ->orWhere('kode_pasien', 'like', "%$q%");
            });
        }

        $totalPasien = User::where('role', 'pasien')->count();
        $pasiens = $query->latest()->paginate(10)->withQueryString();

        return view('pages.pasien.index', compact('pasiens', 'totalPasien'));
    }

    public function create()
    {
        return view('pages.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'email'        => 'nullable|email|unique:users,email',
            'password'     => 'nullable|string|min:6',
            'umur'         => 'nullable|integer|min:1|max:120',
            'alamat'       => 'nullable|string',
            'jenis_kelamin'=> 'nullable|in:Pria,Wanita',
        ]);

        $kode = $this->generateKodePasien($request->nama_lengkap);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'umur'         => $request->umur,
            'alamat'       => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'role'         => 'pasien',
            'kode_pasien'  => $kode,
            'password'     => $request->filled('password')
                ? bcrypt($request->password)
                : bcrypt('osteobike123'),
        ]);

        return redirect()->route('pasien.index')
            ->with('success', 'Pasien berhasil ditambahkan.');
    }

    private function generateKodePasien(string $namaLengkap): string
    {
        $lastNumber = User::where('role', 'pasien')
            ->whereNotNull('kode_pasien')
            ->get()
            ->map(function ($item) {
                preg_match('/(\d+)$/', $item->kode_pasien, $matches);

                return isset($matches[1]) ? (int) $matches[1] : 0;
            })
            ->max();

        return $this->getInisialNama($namaLengkap) . str_pad(($lastNumber ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    }

    private function getInisialNama(string $namaLengkap): string
    {
        $namaParts = preg_split('/\s+/', trim($namaLengkap));
        $namaParts = array_values(array_filter($namaParts));

        if (count($namaParts) >= 2) {
            return strtoupper(substr($namaParts[0], 0, 1) . substr($namaParts[1], 0, 1));
        }

        return strtoupper(substr($namaParts[0] ?? 'PX', 0, 2));
    }

    public function edit(User $pasien)
    {
        return view('pages.pasien.edit', compact('pasien'));
    }

    // ✅ Nama parameter $pasien harus cocok dengan {pasien} di route
    public function update(Request $request, User $pasien)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'email'        => 'nullable|email|unique:users,email,' . $pasien->id,
            'password'     => 'nullable|string|min:6',
            'umur'         => 'nullable|integer|min:1|max:120',
            'alamat'       => 'nullable|string',
            'jenis_kelamin'=> 'nullable|in:Pria,Wanita',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'umur'         => $request->umur,
            'alamat'       => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $pasien->update($data);

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    // ✅ Nama parameter $pasien harus cocok dengan {pasien} di route
    public function destroy(User $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasien.index')
            ->with('success', 'Pasien berhasil dihapus.');
    }
}
