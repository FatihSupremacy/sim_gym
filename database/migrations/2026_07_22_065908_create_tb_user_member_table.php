<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini adalah jembatan penghubung antara sistem autentikasi (users)
     * dan sistem keanggotaan (tb_member).
     *
     * - Jika member terdaftar ONLINE (via landing page), maka akan ada record
     *   di tabel ini yang menghubungkan user_id dengan member_id.
     * - Jika member terdaftar OFFLINE (diinput admin), maka TIDAK ada record
     *   di tabel ini — tb_member tetap ada tanpa pasangan di sini.
     *
     * Cara membedakan:
     *   LEFT JOIN tb_user_member → user_id IS NOT NULL = online
     *                            → user_id IS NULL     = offline
     */
    public function up(): void
    {
        Schema::create('tb_user_member', function (Blueprint $table) {
            $table->id();

            // Satu akun hanya bisa terhubung ke satu data member
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Satu data member hanya bisa terhubung ke satu akun
            $table->foreignId('member_id')
                ->unique()
                ->constrained('tb_member')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_user_member');
    }
};
