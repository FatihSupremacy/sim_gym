<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'tb_absen';

    protected $fillable = [
        'member_id',
        'tipe',
        'checkin_time'
    ];

    // Relasi ke Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
