<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paket;

class Member extends Model
{
    protected $table = 'tb_member';

    protected $fillable = [
        'kode_member',
        'nama',
        'jenis_kelamin',
        'no_hp',
        'email',
        'alamat',
        'foto',
        'paket_id',
        'tanggal_daftar',
        'tanggal_kadaluwarsa',
        'status',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'tanggal_kadaluwarsa' => 'date',
    ];


    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
        // tambahkan foreign key & local key agar eksplisit
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'member_id');
    }

    // Pending mengikuti nilai database; kadaluwarsa dihitung untuk membership yang sudah aktif.
    public function getStatusAttribute(?string $value): string
    {
        if ($value !== 'aktif') {
            return $value ?? 'pending';
        }

        return $this->tanggal_kadaluwarsa
            && now()->gt($this->tanggal_kadaluwarsa->copy()->endOfDay())
                ? 'kadaluwarsa'
                : 'aktif';
    }
    public function absen()
    {
        return $this->hasMany(Absen::class, 'member_id');
    }

    /**
     * Relasi ke tabel jembatan tb_user_member.
     */
    public function userMember()
    {
        return $this->hasOne(UserMember::class, 'member_id');
    }

    /**
     * Akses langsung ke akun user melalui tb_user_member.
     * Jika null → member ini daftarnya offline (tanpa akun).
     * Contoh: $member->user?->email
     */
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            UserMember::class,
            'member_id', // FK di tb_user_member → tb_member
            'id',        // PK di users
            'id',        // PK di tb_member
            'user_id'    // FK di tb_user_member → users
        );
    }
}
