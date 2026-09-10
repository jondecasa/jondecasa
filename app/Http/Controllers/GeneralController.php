<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;

class GeneralController extends Controller
{
    public static function ValidarDNI($dni){
        $dni = strtoupper($dni);
        
        for($i = 0; $i < 9; $i++){
            $num[$i] = substr($dni, $i, 1);
        }
        
        //Si no cumple ningún formato, directamente error
        if (!preg_match('/^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$/', $dni) &&
        !preg_match('/^[T]{1}[A-Z0-9]{8}$/', $dni) &&
        !preg_match('/^[0-9]{8}[A-Z]{1}$/', $dni)){
            return false;
        }

        //NIFs
        if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $dni)){
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($dni, 0, 8) % 23, 1)){
                return true;
            }else{
                return false;
            }
        }
        //CIF
        $suma = $num[2] + $num[4] + $num[6];
        for ($i = 1; $i < 8; $i += 2){
            $suma += substr((2 * $num[$i]),0,1) + (int)substr((2 * $num[$i]),1,1);
        }
        $n = 10 - substr($suma, strlen($suma) - 1, 1);

        //NIFs especiales
        if (preg_match('/^[KLM]{1}/', $dni)){
            if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($dni, 1, 8) % 23, 1)){
                return true;
            }else{
                return false;
            }
        }

        //CIFs
        if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $dni)){
            if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)){
                return true;
            }else{
                return false;
            }
        }

        //NIEs
        if (preg_match('/^[XYZ]{1}/', $dni)){
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $dni), 0, 8) % 23, 1)){
                return true;
            }else{
                return false;
            }
        }

        //Si no se ha validado aun, no es valido
        return false;

    }
    
    public static function registrarLog($texto){
        try {
            $registro = new Logs();
            $registro->texto = (string) $texto;
            $registro->save();
        } catch (\Throwable $e) {
            // Nunca dejar que el registro en BD enmascare el error original.
            \Illuminate\Support\Facades\Log::error('No se pudo registrar el log en BD: '.$e->getMessage());
        }
    }
}
