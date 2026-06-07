<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemilik extends Model
{
    /** @use HasFactory<\Database\Factories\PemilikFactory> */
    use HasFactory;
    protected $guarded;


    // Relasi ke suratPaket
    public function suratPaket(): HasMany
    {
        return $this->hasMany(SuratPaket::class, 'pemilik_id');
    }
}
