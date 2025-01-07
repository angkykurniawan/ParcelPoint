<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_paket_id',
        'recipient_phone',
        'message',
        'status', // Status pengiriman
    ];

    public function suratPaket()
    {
        return $this->belongsTo(SuratPaket::class, 'surat_paket_id');
    }
}
