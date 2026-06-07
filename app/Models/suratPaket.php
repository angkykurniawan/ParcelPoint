<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class suratPaket extends Model
{
    /** @use HasFactory<\Database\Factories\SuratPaketFactory> */
    use HasFactory;
    protected $guarded;

    //Relasi ke Pemiliks
    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id')->withDefault([
            'Nama' => 'Tidak Diketahui', // Nilai default jika pemilik tidak ditemukan
        ]);
    }

    //Relasi ke Kurirs
    public function kurir(): BelongsTo
    {
        return $this->belongsTo(kurir::class, 'kurir_id')->withDefault([
            'Ekspedisi' => 'Tidak Diketahui', // Nilai default jika pemilik tidak ditemukan
        ]);
    }

    //Relasi ke Ruangs
    public function ruang(): BelongsTo
    {
        return $this->belongsTo(ruang::class, 'ruang_id')->withDefault([
            'Nama' => 'Pos Security', // Nilai default jika pemilik tidak ditemukan
        ]);
    }
}
