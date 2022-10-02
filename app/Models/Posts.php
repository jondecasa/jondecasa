<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'slug', 'metaSeo', 'resumen', 'contenido', 'visible', 'fechaPublicacion', 'header_id'];

    public function header(){
        return $this->belongsTo(Headers::class);
    }

    public function formatearFechaMeta($fecha){
        if(isset($fecha) && !empty($fecha)){
            $partes = explode(" ", $fecha);
            return implode("T",$partes)."+00:00";
        }
        return $fecha;
    }

    public function getMetaPublicadoAttribute(){
        return $this->formatearFechaMeta($this->fechaPublicacion);
    }

    public function getMetaModificadoAttribute(){
        return $this->formatearFechaMeta($this->updated_at);
    }
}
