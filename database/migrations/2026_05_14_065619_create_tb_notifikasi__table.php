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
        Schema::create('tb_notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('tb_member')->cascadeOnDelete();
            $table->string('tipe_notifikasi'); // h_minus_2
            $table->date('tanggal_kadaluwarsa');
            $table->string('channel')->default('whatsapp');
            $table->string('status'); // sent / failed
            $table->text('response')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->unique(['member_id', 'tipe_notifikasi', 'tanggal_kadaluwarsa'], 'uniq_member_h2_notif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_notifikasi');
    }
};
