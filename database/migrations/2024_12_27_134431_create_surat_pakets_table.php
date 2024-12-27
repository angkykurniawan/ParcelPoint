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
            $table->string('Nama Pemilik'); //Nanti Relasi
            $table->string('Jenis');
            $table->string('nomorHP');
            $table->string('Resi');
            $table->string('Berat');
            $table->string('WaktuJemput');
            $table->string('Penjemput'); //ISI DENGAN YBS, TEMAN, KELUARGA, DLL
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
