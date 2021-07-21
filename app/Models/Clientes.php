<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Clientes extends Model
{
    use Encryptable;
    
    protected $fillable = ['nombre', 'dni', 'fechaNac', 'email', 'direccion'];
    
    protected $encryptable = ['nombre', 'dni', 'email', 'direccion'];
}
