<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contacto;


class MailController extends Controller
{
    public function contacto(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $email = Mail::to(config("jon.mail"))->send(new Contacto($request->all()));
        
        return redirect()->route('landing', ["#contact"])->with("success", "Mensaje enviado correctamente");
    }
}
