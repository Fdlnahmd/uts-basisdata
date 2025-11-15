<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('no_kunjungan')->unique();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan');
            $table->text('keluhan');
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('biaya_pemeriksaan', 12, 2)->default(0);
            $table->decimal('biaya_tindakan', 12, 2)->default(0);
            $table->decimal('total_biaya', 12, 2)->default(0);
            $table->enum('status', ['Menunggu', 'Diperiksa', 'Selesai', 'Batal'])->default('Menunggu');
            $table->timestamps();
        });
    } 
};