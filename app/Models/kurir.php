<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kurir extends Model
{
    /** @use HasFactory<\Database\Factories\KurirFactory> */
    use HasFactory;
    protected $guarded;

    //Relasi ke suratPaket
    public function suratPaket(): HasMany
    {
        return $this->hasMany(SuratPaket::class, 'kurir_id');
    }
}
