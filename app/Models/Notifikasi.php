<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'tb_notifikasi';

    protected $fillable = [
        'member_id',
        'tipe_notifikasi',
        'tanggal_kadaluwarsa',
        'channel',
        'status',
        'response',
        'sent_at',
    ];

    protected $casts = [
        'tanggal_kadaluwarsa' => 'date',
        'sent_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
