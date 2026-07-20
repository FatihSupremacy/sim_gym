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
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('tb_member')->cascadeOnDelete();
            $table->foreignId('paket_id')->constrained('tb_paket')->cascadeOnDelete();
            $table->unsignedBigInteger('nominal');
            $table->enum('metode', ['manual', 'midtrans'])->default('manual');
            $table->enum('status', ['pending', 'berhasil', 'ditolak'])->default('pending');
            $table->string('bukti')->nullable();
            $table->string('id_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pembayaran');
    }
};
