<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Controllers\GeneralController;

class Dni implements Rule
{
    private $dni;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($dni)
    {
        $this->dni = $dni;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $valido = GeneralController::ValidarDNI($this->dni);
        
        if($valido){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El formato del DNI/CIF/NIE no es válido.';
    }
}
