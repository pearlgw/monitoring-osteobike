<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTerapi;
use Illuminate\Http\Request;

class TerapiController extends Controller
{
    public function updateHasil(Request $request)
    {
        $request->validate([
            'rpm'  => 'required|integer',
            'rom'  => 'required|integer',
            'durasi' => 'required|integer',
        ]);

        $terapi = DetailTerapi::where('status', 'belum')->first();

        if (!$terapi) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada sesi terapi yang aktif.',
            ], 404);
        }

        $terapi->update([
            'rpm'    => $request->rpm,
            'rom'    => $request->rom,
            'durasi' => $request->durasi,
            'status' => 'sudah',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data terapi berhasil dikirim.',
        ]);
    }
}
