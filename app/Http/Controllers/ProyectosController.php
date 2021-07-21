<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Proyectos;

use Auth;
use App\Rules\Dni;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = Proyectos::with("cliente")->get();
        return view("proyectos.index", compact('registros'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Clientes::get();
        return view("proyectos.create", compact("clientes"));
        
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
            'clientes_id' => 'required|exists:clientes,id',
            'proyecto' => 'required',
            'observaciones' => '',
            'alta' => 'nullable|date',
            'cierre' => 'nullable|date',
            'coste' => 'nullable',
        ]);

        Proyectos::create($valido);

        return redirect()->route("proyectos.index")
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
    public function edit(Proyectos $proyecto)
    {
        $clientes = Clientes::get();
        return view("proyectos.edit", compact("clientes", "proyecto"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyectos $proyecto)
    {
        $valido = $request->validate([
            'clientes_id' => 'required|exists:clientes,id',
            'proyecto' => 'required',
            'observaciones' => '',
            'alta' => 'nullable|date',
            'cierre' => 'nullable|date',
            'coste' => 'nullable',
        ]);

        $proyecto->update($valido);


        return redirect()->route("proyectos.index")
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
            return redirect()->route("proyectos.index")
                    ->with("success", "Borrado correctamente");
        
    }
    
}
