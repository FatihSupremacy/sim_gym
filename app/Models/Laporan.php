<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'tb_laporan_harian';

    protected $fillable = [
        'tanggal',
        'jam_operasional',
        'petugas',
        'pendapatan',
        'penjualan_produk',
        'kondisi_alat',
        'operasional',
        'keluhan',
        'insiden',
        'tindak_lanjut'
    ];
}
