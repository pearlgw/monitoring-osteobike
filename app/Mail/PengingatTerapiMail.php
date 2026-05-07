<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class PengingatTerapiMail extends Mailable
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this
            ->subject('Pengingat Jadwal Terapi')
            ->view('emails.pengingat-terapi');
    }
}
