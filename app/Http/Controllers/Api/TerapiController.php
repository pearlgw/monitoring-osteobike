<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTerapi;
use Illuminate\Http\Request;

class TerapiController extends Controller
{
    public function updateHasil(Request $request)
    {
        $rules = [
            'rpm'  => 'required|integer',
            'durasi' => 'required|integer',
        ];

        if (config('app.activate_rom')) {
            $rules['rom'] = 'required|integer';
        }

        $request->validate($rules);

        $terapi = DetailTerapi::where('status', 'belum')->first();

        if (!$terapi) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada sesi terapi yang aktif.',
            ], 404);
        }

        $data = [
            'rpm'    => $request->rpm,
            'durasi' => $request->durasi,
            'status' => 'sudah',
        ];

        if (config('app.activate_rom')) {
            $data['rom'] = $request->rom;
        }

        $terapi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data terapi berhasil dikirim.',
        ]);
    }
}
