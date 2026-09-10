<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Rules\Dni;
use DB;
use Auth;
use Hash;
use App\Notifications\Ejemplo;
use App\Mail\demo;
use Illuminate\Support\Facades\Mail;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $usuario = Auth::user();
//        $usuario->notify(new Ejemplo());
//        $objDemo = new \stdClass();
//        $objDemo->demo_one = 'Demo One Value';
//        $objDemo->demo_two = 'Demo Two Value';
//        $objDemo->sender = 'SenderUserName';
//        $objDemo->receiver = 'ReceiverUserName';
// 
//        Mail::to("jndcs15@gmail.com")->send(new demo($objDemo));
//        
        $cliente = Clientes::firstOrNew(["users_id" => Auth::user()->id]);

        return view("perfil.index", compact("cliente"));
    }
    
    public function actualizarPass(Request $request){
        if(Hash::check($request->old, auth()->user()->password)){
            if($request->password == $request->password_confirmation){
                Auth::user()->update(['password'=> Hash::make($request->password)]);
                
                return redirect()->back()
                    ->with("success", "Contraseña cambiada correctamente.");
            }else{
                return redirect()->back()
                    ->withErrors("Las nuevas contraseñas no coinciden.");
            }
        }else{
            return redirect()->back()
                    ->withErrors("La contraseña anterior no coincide.");
        }
        
    }
    
    public function actualizarInfo(Request $request){
        $cliente = Clientes::firstOrNew(["users_id" => Auth::user()->id]);

        $valido = $request->validate([
                'nombre' => 'required',
                'dni' => ['nullable', 'min:9', 'max:9', new Dni($request->dni)],
                'fechaNac' => 'nullable|date',
                'direccion' => 'required|min:10',
            ], [], [
                'fechaNac' => 'Fecha de Nacimiento',
                'direccion' => 'Dirección',
            ]);

        $cliente->fill($valido)->save();

        return redirect()->route("perfil")
                    ->with("success", "Actualizado correctamente");
    }
    
    
}
