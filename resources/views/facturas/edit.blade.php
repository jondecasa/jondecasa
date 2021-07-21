<x-app-layout>
<div class="container py-2">
    <div class="row">
        <div class="col"></div>
        <div class="col-4 text-right">
            <a href="{{url('facturas')}}" class="btn btn-secondary">
                <i class="fa fa-arrow-circle-left"></i>
                <span>Volver</span>
            </a>
        </div>
    </div>
    <form action="{{route("facturas.update", $factura->id)}}" method="POST" id="formularioFacturas">
        @csrf
        @method("PUT")
        
        <div class="row">
            <div class="col-12 col-md-3">
                <strong>Nº Factura</strong>
                <input type="text" readonly id="numFactura" name="numFactura" class="form-control" value="{{$factura->numFactura}}">
            </div>
            <div class="col-12 col-md-3">
                <strong>Tipo Factura</strong>
                <select name="tipo" class="form-control">
                    @foreach($tipos as $tipo)
                    <option value="{{$tipo->id}}" @if($factura->tipoFacturas_id == $tipo->id) selected @endif>{{$tipo->tipo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3">
                <strong>Forma Pago</strong>
                <select name="pago" class="form-control">
                    @foreach($pagos as $pago)
                    <option value="{{$pago->id}}" @if($factura->formaPagos_id == $pago->id) selected @endif>{{$pago->pago}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3">
                <strong>Moneda</strong>
                <select name="moneda" class="form-control">
                    @foreach($monedas as $moneda)
                    <option value="{{$moneda->id}}" @if($factura->monedas_id == $moneda->id) selected @endif>{{$moneda->moneda}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <strong>Cliente</strong>
                <select name="cliente" id="cliente" class="form-control">
                    @foreach($clientes as $cliente)
                    <option value="{{$cliente->id}}" @if($factura->clientes_id == $cliente->id) selected @endif>{{$cliente->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-4">
                <strong>Fecha</strong>
                <input type="date" id="fecha" name="fecha" class="form-control" value="{{old("fecha", $factura->fecha)}}">
            </div>
            <div class="col-12 col-md-4">
                <strong>Vencimiento</strong>
                <input type="date" id="vencimiento" name="vencimiento" class="form-control" value="{{old("vencimiento", $factura->vencimiento)}}">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3">
                <strong>Base</strong>
                <input type="number" name="base" class="form-control" value="{{old("vencimiento", $factura->base)}}" readonly>
            </div>
            <div class="col-12 col-md-3">
                <strong>IVA</strong>
                <input type="number" name="iva" class="form-control" value="{{old("iva", $factura->iva)}}">
            </div>
            <div class="col-12 col-md-3">
                <strong>Total</strong>
                <input type="number" name="total" class="form-control" value="{{old("total", $factura->total)}}" readonly>
            </div>
            <div class="col-12 col-md-3">
                <strong>Retencion</strong>
                <input type="number" name="retencion" class="form-control" value="{{old("retencion", $factura->retencion)}}">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <strong>Observaciones</strong>
                <textarea name="observaciones" rows="3" class="form-control">{{old("observaciones", $factura->observaciones)}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 my-auto">
                <strong>Facturado</strong>
                <input type="checkbox" name="facturado" @if(old("facturado", $factura->facturado) == "S") checked @endif>
            </div>
            <div class="col-12 col-md-3 my-auto">
                <strong>Cobrado</strong>
                <input type="checkbox" name="cobrado"  @if(old("cobrado", $factura->cobrado) == "S") checked @endif>
            </div>
            
            <div class="col-12 col-md-3 offset-md-3">
                <strong>Total Eur</strong>
                <input type="number" readonly name="totalEur" class="form-control" value="{{old("totalEur", $factura->totalEur)}}">
            </div>
        </div>
        <hr class="mt-2 mb-3"/>
        <div class="row">
            <div class="offset-9 col-3 text-right">
                <button type="button" class="btn btn-success" id="nuevaFila">
                    <i class="fas fa-plus"></i> Nuevo
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Proyecto</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </thead>
                <tbody id="cuerpoDetalle">
                    <tr class="filaNueva d-none">
                        <td>
                            <select class="form-control" name="registro[][proyecto]">
                                <option></option>
                                @foreach($proyectos as $proyecto)
                                <option value="{{$proyecto->id}}" data-cliente="{{$proyecto->clientes_id}}" data-coste="{{$proyecto->costeHora}}">{{$proyecto->proyecto}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="registro[][concepto]">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="registro[][cantidad]">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="registro[][importe]">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="registro[][total]" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn text-danger borrarFila">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @foreach($factura->detalle as $key => $detalle)
                        <tr class="">
                            <td>
                                
                                <select class="form-control" name="registro[{{$key}}][proyecto]">
                                    <option @if(!isset($detalle->proyectos_id)) selected @endif></option>
                                    @foreach($proyectos as $proyecto)
                                    <option value="{{$proyecto->id}}" data-cliente="{{$proyecto->clientes_id}}" data-coste="{{$proyecto->costeHora}}"
                                            @if($detalle->proyectos_id == $proyecto->id) selected @endif>{{$proyecto->proyecto}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="registro[{{$key}}][concepto]" value="{{$detalle->concepto}}">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="registro[{{$key}}][cantidad]" value="{{$detalle->cantidad}}">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="registro[{{$key}}][importe]" value="{{$detalle->importe}}">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="registro[{{$key}}][total]" value="{{$detalle->total}}" readonly="">
                            </td>
                            <td>
                                <button type="button" class="btn text-danger borrarFila">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <hr class="mt-2 mb-3"/>
        <div class="row">
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-success" id="enviarDatos">
                    Guardar
                </button>
            </div>
        </div>
    </form>
    
</div>
    <script>
        var numFilas = {{$key}};
        $(document).ready(function(){
           $("#cliente").trigger("change");
        });
        $("#enviarDatos").on("click", function(e){
            e.preventDefault();
            $(".filaNueva").remove();
            $("#formularioFacturas").submit();
        });
        $("#cliente").on("change", function(){
            var cliente = $(this).val();

            $("select[name*='proyecto'] option").each(function(){
                if($(this).attr("data-cliente") == cliente){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });
        });
        $("#nuevaFila").on("click", function(){
            var nf = $(".filaNueva").clone();
            nf.removeClass("filaNueva d-none");
            numFilas += 1;
            
            $(nf).find("input[name*='registro'], select[name*='registro']").each(function(){
               $(this).attr("name", $(this).attr("name").replace("[]", "["+numFilas+"]"));
            });
                    
            $("#cuerpoDetalle").append(nf);
        });
        $(document).on("change", "select[name*='proyecto']", function(){
            var op = ($(":selected", $(this)));
            $(op).closest("tr").find("input[name*='importe']").val(op.data("coste"));
        });
        $(document).on("focusout", "input[name*='cantidad']", function(){
            var cantidad = $(this).val();
            var importe = $(this).closest("tr").find("input[name*='importe']").val();
            $(this).closest("tr").find("input[name*='total']").val(cantidad * importe);
        });
        $(document).on("focusout", "input[name*='importe']", function(){
            var cantidad = $(this).val();
            var importe = $(this).closest("tr").find("input[name*='cantidad']").val();
            $(this).closest("tr").find("input[name*='total']").val(cantidad * importe);
        });
        $(document).on("click", ".borrarFila", function(){
            $(this).closest("tr").remove();
        });
    </script>
</x-app-layout>