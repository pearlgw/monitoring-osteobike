<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTerapiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        $pasienIds = [2, 3, 4, 5];

        foreach ($pasienIds as $userId) {

            $usedDates = []; // simpan tanggal yang sudah dipakai

            for ($i = 1; $i <= 3; $i++) {

                do {
                    $date = now()->subDays(rand(1, 10))->format('Y-m-d');
                } while (in_array($date, $usedDates));

                $usedDates[] = $date;

                $detailTerapi = [
                    'user_id' => $userId,
                    'tanggal_terapi' => $date,
                    'berat_badan' => rand(50, 80),
                    'diagnosa' => 'Terapi ke-' . $i . ' pasien #' . $userId,
                    'metode' => rand(0, 1) ? 'Aktif' : 'Pasif',
                    'rpm' => rand(30, 55),
                    'durasi' => rand(3, 30),
                    'status' => 'sudah',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (config('app.activate_rom')) {
                    $detailTerapi['rom'] = rand(70, 110);
                }

                $data[] = $detailTerapi;
            }
        }

        DB::table('detail_terapis')->insert($data);
    }
}
