<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'tb_laporan_harian';

    protected $fillable = [
        'user_id',
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

    /**
     * Relasi ke tabel users (admin yang membuat laporan).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ambil semua data absen pada tanggal laporan ini.
     * Relasi via kolom tanggal (bukan FK).
     */
    public function absens()
    {
        return Absen::whereDate('checkin_time', $this->tanggal);
    }

    /**
     * Hitung total member yang hadir pada tanggal laporan ini.
     */
    public function totalAbsen(): int
    {
        return $this->absens()->count();
    }

    /**
     * Hitung member absen tipe bulanan pada tanggal laporan ini.
     */
    public function totalAbsenBulanan(): int
    {
        return $this->absens()->where('tipe', 'bulanan')->count();
    }

    /**
     * Hitung member absen tipe harian pada tanggal laporan ini.
     */
    public function totalAbsenHarian(): int
    {
        return $this->absens()->where('tipe', 'harian')->count();
    }

    /**
     * Ambil semua member baru yang mendaftar pada tanggal laporan ini.
     * Relasi via kolom tanggal (bukan FK).
     */
    public function memberBaru()
    {
        return Member::whereDate('tanggal_daftar', $this->tanggal);
    }

    /**
     * Hitung member baru yang mendaftar pada tanggal laporan ini.
     */
    public function totalMemberBaru(): int
    {
        return $this->memberBaru()->count();
    }
}
