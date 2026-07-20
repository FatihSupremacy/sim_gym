<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp', 20);
            $table->string('email');
            $table->text('alamat');
            $table->foreignId('paket_id')
                ->constrained('tb_paket')
                ->restrictOnDelete();
            $table->enum('status_pendaftaran', ['pending', 'dikonfirmasi', 'ditolak'])
                ->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['status_pendaftaran', 'created_at']);
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pendaftaran');
    }
};
