<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Facturas extends Model
{
    public function cliente(){
        return $this->belongsTo(Clientes::class, 'clientes_id', 'id');
    }
    
    public function detalle(){
        return $this->hasMany(FacturasDetalle::class);
    }
}
