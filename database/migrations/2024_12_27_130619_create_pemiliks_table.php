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
        Schema::create('pemiliks', function (Blueprint $table) {
            $table->id();
            $table->string('NomorInduk');
            $table->string('Nama');
            $table->string('Umur');
            $table->string('Pekerjaan');
            $table->string('Whatsapp');
            $table->string('Email');
            $table->string('Foto');
            $table->string('Jalan');
            $table->string('Kecamatan');
            $table->string('KabupatenKota');
            $table->string('Provinsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemiliks');
    }
};
