<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facturas;
use App\Models\FacturasDetalle;
use App\Models\TipoFacturas;
use App\Models\Clientes;
use App\Models\Proyectos;
use App\Models\FormaPagos;
use App\Models\Monedas;
use DB;
use PDF;
use Carbon\Carbon;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $registros = Facturas::get();

        return view("facturas.index", compact('registros'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ultimaFactura = Facturas::selectRaw("CONCAT(DATE_FORMAT(CURDATE(),'%Y%m'), lpad(COUNT(*)+1, 5, '0')) AS num")
                ->whereRaw("MONTH(fecha) = MONTH(CURDATE()) AND YEAR(fecha) = YEAR(CURDATE())")
                ->first();
        
        $tipos = TipoFacturas::get();
        $clientes = Clientes::get();
        $pagos = FormaPagos::get();
        $monedas = Monedas::get();
        $proyectos = Proyectos::get();
        
        return view("facturas.create", compact("ultimaFactura", "tipos", "clientes", "pagos", "monedas", "proyectos"));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        DB::beginTransaction();
        
        try{
            $factura = new Facturas();
            $factura->numFactura = $request->numFactura;
            $factura->tipoFacturas_id = $request->tipo;
            $factura->clientes_id = $request->cliente;
            $factura->fecha = $request->fecha ?? Carbon::now("Europe/Madrid")->toDateString();
            $factura->vencimiento = $request->vencimiento;
            $factura->base = $request->base;
            $factura->iva = $request->iva;
            $factura->total = $request->total;
            $factura->retencion = $request->retencion;
            $factura->facturado = isset($request->facturado) ? "S":"N";
            $factura->cobrado = isset($request->cobrado) ? "S":"N";
            $factura->formaPagos_id = $request->pago;
            $factura->observaciones = $request->observaciones;
            $factura->monedas_id = $request->moneda;
            $factura->totalEur = $request->totalEur;
            $factura->estado = 0;
            $factura->save();
            
            $totalBase = 0;
            
            foreach($request->registro as $detalle){
                
                $registro = new FacturasDetalle();
                $registro->facturas_id = $factura->id;
                $registro->proyectos_id = $detalle["proyecto"];
                $registro->concepto = $detalle["concepto"];
                $registro->cantidad = $detalle["cantidad"];
                $registro->importe = $detalle["importe"];
                $registro->total = $detalle["total"];
                $registro->save();
                $totalBase += $detalle["total"];
            }
            $factura->base = $totalBase;
            //El total es la base + el iva y se le quita la retención
            $factura->total = $totalBase + ($totalBase * $factura->iva)/100 - ($totalBase * $factura->retencion)/100;
            $factura->update();
            DB::commit();
            return redirect()->route("facturas.index")
                ->with("success", "Insertado correctamente");
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route("facturas.index")
                ->withErrors("Error al insertar: ".$e);
        }


        return redirect()->route("facturas.index")
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
    public function edit(Facturas $factura)
    {
        $tipos = TipoFacturas::get();
        $clientes = Clientes::get();
        $pagos = FormaPagos::get();
        $monedas = Monedas::get();
        $proyectos = Proyectos::get();
        
        return view("facturas.edit", compact("factura", "tipos", "clientes", "pagos", "monedas", "proyectos"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facturas $factura)
    {
        DB::beginTransaction();
        
        try{
            $factura->tipoFacturas_id = $request->tipo;
            $factura->clientes_id = $request->cliente;
            $factura->fecha = $request->fecha ?? Carbon::now("Europe/Madrid")->toDateString();
            $factura->vencimiento = $request->vencimiento;
            //$factura->base = $request->base;
            $factura->iva = $request->iva;
            //$factura->total = $request->total;
            $factura->retencion = $request->retencion;
            $factura->facturado = isset($request->facturado) ? "S":"N";
            $factura->cobrado = isset($request->cobrado) ? "S":"N";
            $factura->formaPagos_id = $request->pago;
            $factura->observaciones = $request->observaciones;
            $factura->monedas_id = $request->moneda;
            $factura->totalEur = $request->totalEur;
            
            
            //Se eliminan las lineas
            FacturasDetalle::where("facturas_id", $factura->id)->delete();
            
            $totalBase = 0;
            foreach($request->registro as $detalle){
                
                $registro = new FacturasDetalle();
                $registro->facturas_id = $factura->id;
                $registro->proyectos_id = $detalle["proyecto"];
                $registro->concepto = $detalle["concepto"];
                $registro->cantidad = $detalle["cantidad"];
                $registro->importe = $detalle["importe"];
                $registro->total = $detalle["total"];
                $registro->save();
                $totalBase += $detalle["total"];
            }
            
            $factura->base = $totalBase;
            //El total es la base + el iva y se le quita la retención
            $factura->total = $totalBase + ($totalBase * $factura->iva)/100 - ($totalBase * $factura->retencion)/100;
            $factura->update();
            
            DB::commit();
            return redirect()->route("facturas.index")
                ->with("success", "Actualizado correctamente");
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route("facturas.index")
                ->withErrors("Error al actualizar: ".$e);
        }

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
        return redirect()->route("facturas.index")
                ->with("success", "Borrado correctamente");
        
    }
    
    public function exportar(Request $request, $id){   
        $factura = Facturas::with("cliente", "detalle")->where("id", $id)->first();
        $pdf = PDF::loadView("facturas.exportar", compact("factura"));        
        return $pdf->download($factura->numFactura."_".$factura->cliente->nombre.".pdf");
    }
}
