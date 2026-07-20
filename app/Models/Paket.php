<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'tb_paket';

    protected $fillable = [
        'nama_paket',
        'durasi',
        'tipe_durasi',
        'harga',
        'deskripsi'
    ];

    // TAMBAHKAN relasi ke member
    public function members()
    {
        return $this->hasMany(Member::class, 'paket_id', 'id');
    }
}
