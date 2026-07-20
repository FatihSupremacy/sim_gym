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
        Schema::create('tb_laporan_harian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->string('jam_operasional')->nullable();
            $table->string('petugas')->nullable();
            $table->integer('pendapatan')->nullable();
            $table->integer('penjualan_produk')->nullable();
            $table->text('kondisi_alat')->nullable();
            $table->text('kebersihan')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('insiden')->nullable();
            $table->text('tindak_lanjut')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_laporan_harian');
    }
};
