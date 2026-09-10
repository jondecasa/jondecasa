<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NfcRutas extends Model
{
    protected $table = 'nfc_rutas';

    protected $fillable = ['titulo', 'url', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function visitas()
    {
        return $this->hasMany(NfcRutaVisitas::class, 'nfc_ruta_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ruta) {
            do {
                $codigo = Str::upper(Str::random(20));
            } while (static::where('codigo', $codigo)->exists());

            $ruta->codigo = $codigo;
        });
    }
}
