<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NfcRutaVisitas extends Model
{
    protected $table = 'nfc_ruta_visitas';

    protected $fillable = [
        'nfc_ruta_id',
        'ip_address',
        'user_agent',
        'referer',
        'accept_language',
        'request_headers',
    ];

    protected $casts = [
        'request_headers' => 'array',
    ];

    public function ruta()
    {
        return $this->belongsTo(NfcRutas::class, 'nfc_ruta_id');
    }
}
