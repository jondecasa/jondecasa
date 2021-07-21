<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

use Auth;
use App\Rules\Dni;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $registros = Clientes::get();
        
            return view("clientes.index", compact('registros'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            return view("clientes.create");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
            $valido = $request->validate([
                'nombre' => 'required',
                'dni' => ['required', 'min:9', 'max:9', new Dni($request->dni)],
                'fechaNac' => 'required|date',
                'email' => 'required|email|unique:clientes,email',
                'direccion' => 'required|min:10',
            ], [], [
                'fechaNac' => 'Fecha de Nacimiento',
                'direccion' => 'Dirección',
            ]);

            Clientes::create($valido);
            
            return redirect()->route("clientes.index")
                    ->with("success", "Insertado correctamente");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $cliente)
    {
        
            return view("clientes.edit", compact("cliente"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $cliente)
    {
        
        
            $valido = $request->validate([
                'nombre' => 'required',
                'dni' => ['required', 'min:9', 'max:9', new Dni($request->dni)],
                'fechaNac' => 'required|date',
                'email' => 'required|email|unique:clientes,email,'.$cliente->id,
                'direccion' => 'required|min:10',
            ], [], [
                'fechaNac' => 'Fecha de Nacimiento',
                'direccion' => 'Dirección',
            ]);
            
            $cliente->update($valido);
            

            return redirect()->route("clientes.index")
                    ->with("success", "Actualizado correctamente");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            Clientes::where("id", $id)->delete();
            return redirect()->route("clientes.index")
                    ->with("success", "Borrado correctamente");
        
    }
    
}
