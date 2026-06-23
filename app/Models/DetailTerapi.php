<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTerapi extends Model
{
    protected $table = 'detail_terapis';
    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'tanggal_terapi',
        'berat_badan',
        'diagnosa',
        'metode',
        'rpm',
        'durasi',
        'vas',
        'rom',
        'status',
    ];

    /**
     * Relasi ke user (pasien)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
