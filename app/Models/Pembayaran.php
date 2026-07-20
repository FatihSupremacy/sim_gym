<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'tb_pembayaran';

    protected $fillable = [
        'member_id',
        'paket_id',
        'nominal',
        'metode',
        'metode_detail',
        'status',
        'bukti',
        'id_transaksi'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
