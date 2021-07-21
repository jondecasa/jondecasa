<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Proyectos extends Model
{
    public $timestamps = false;
    public $fillable = ["clientes_id", "proyecto", "observaciones", "alta", "cierre", "costeHora"];
    
    public function cliente(){
        return $this->belongsTo(Clientes::class, "clientes_id", "id");
    }
}
