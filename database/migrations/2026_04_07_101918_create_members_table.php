<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //syntax untuk membuat tabel member
        Schema::create('tb_member', function (Blueprint $table) {
            $table->id();
            $table->string('kode_member')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->foreignId('paket_id')
                ->constrained('tb_paket')
                ->restrictOnDelete();
            $table->date('tanggal_daftar');
            $table->date('tanggal_kadaluwarsa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_member');
    }
};
