<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengingatTerapi extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal_terapi_selanjutnya',
        'status',
    ];

    protected $casts = [
        'tanggal_terapi_selanjutnya' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
