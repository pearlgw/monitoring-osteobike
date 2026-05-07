<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\PengingatTerapiMail;
use App\Models\PengingatTerapi;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class KirimPengingatTerapi extends Command
{
    protected $signature = 'pengingat:kirim-terapi';

    protected $description = 'Mengirim email pengingat terapi';

    public function handle()
    {
        $now = Carbon::now();

        $data = PengingatTerapi::with('user')
            ->where('status', 'belum')
            ->where('tanggal_terapi_selanjutnya', '<=', $now)
            ->get();

        foreach ($data as $item) {

            if (!$item->user || !$item->user->email) {
                continue;
            }

            Mail::to($item->user->email)
                ->send(new PengingatTerapiMail($item->user));

            $item->update([
                'status' => 'sudah'
            ]);

            $this->info("Email terkirim ke {$item->user->email}");
        }

        return Command::SUCCESS;
    }
}
