<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'role',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel jembatan tb_user_member.
     * Satu user hanya punya satu data member.
     */
    public function userMember()
    {
        return $this->hasOne(UserMember::class, 'user_id');
    }

    /**
     * Akses langsung ke data member melalui tb_user_member.
     * Contoh: $user->member->nama
     */
    public function member()
    {
        return $this->hasOneThrough(
            Member::class,
            UserMember::class,
            'user_id',   // FK di tb_user_member → users
            'id',        // FK di tb_member (primary key)
            'id',        // PK di users
            'member_id'  // FK di tb_user_member → tb_member
        );
    }
}
