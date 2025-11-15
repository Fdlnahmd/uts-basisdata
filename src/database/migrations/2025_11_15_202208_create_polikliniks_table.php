<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polikliniks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rumah_sakit_id')->constrained('rumah_sakits')->cascadeOnDelete();
            $table->string('kode_poliklinik', 20)->unique();
            $table->string('nama_poliklinik');
            $table->string('lantai')->nullable();
            $table->string('gedung')->nullable();
            $table->enum('status', ['aktif','nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polikliniks');
    }
};