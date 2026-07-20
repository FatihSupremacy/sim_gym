<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_member', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('tanggal_kadaluwarsa');
        });

        // Data sebelum fitur status dianggap sudah aktif agar perilaku lama tetap terjaga.
        DB::table('tb_member')->update(['status' => 'aktif']);
    }

    public function down(): void
    {
        Schema::table('tb_member', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
