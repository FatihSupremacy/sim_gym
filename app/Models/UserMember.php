<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMember extends Model
{
    protected $table = 'tb_user_member';

    protected $fillable = [
        'user_id',
        'member_id',
    ];

    /**
     * Akun user yang terhubung ke record ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Data member yang terhubung ke record ini.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
