<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tb_paket', function (Blueprint $table) {

            // tambah field baru
            $table->integer('durasi')->nullable()->after('nama_paket');
            $table->enum('tipe_durasi', ['hari', 'bulan'])->nullable()->after('durasi');
        });

        // pindahkan data lama ke struktur baru
        DB::statement("
            UPDATE tb_paket 
            SET durasi = durasi_hari, tipe_durasi = 'hari'
            WHERE durasi_hari IS NOT NULL
        ");

        DB::statement("
            UPDATE tb_paket 
            SET durasi = durasi_bulan, tipe_durasi = 'bulan'
            WHERE durasi_bulan IS NOT NULL
        ");

        Schema::table('tb_paket', function (Blueprint $table) {

            // hapus field lama
            $table->dropColumn(['durasi_hari', 'durasi_bulan']);
        });
    }

    public function down(): void
    {
        Schema::table('tb_paket', function (Blueprint $table) {

            $table->integer('durasi_hari')->nullable();
            $table->integer('durasi_bulan')->nullable();
        });

        Schema::table('tb_paket', function (Blueprint $table) {

            $table->dropColumn(['durasi', 'tipe_durasi']);
        });
    }
};
