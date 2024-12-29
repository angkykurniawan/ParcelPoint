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
        Schema::create('surat_pakets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_id')->constrained('pemiliks'); // Relasi ke tabel pemiliks
            $table->foreignId('kurir_id'); // Relasi ke tabel kurirs
            $table->foreignId('ruang_id')->constrained('ruangs'); // Relasi ke tabel pemiliks
            $table->enum('Jenis', ['Surat', 'Paket']);
            $table->string('Foto')->nullable();
            $table->string('NoHP');
            $table->string('Resi');
            $table->string('Berat')->nullable();
            $table->dateTime('WaktuJemput')->nullable();
            $table->enum('Penjemput', ['YBS', 'Teman', 'Keluarga'])->nullable();
            $table->string('FotoST')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pakets');
    }
};
