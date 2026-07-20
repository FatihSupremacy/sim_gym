<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranMember extends Model
{
    protected $table = 'tb_pendaftaran';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'no_hp',
        'email',
        'alamat',
        'paket_id',
        'status_pendaftaran',
        'catatan',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
