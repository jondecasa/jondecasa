
<x-app-layout>


<div class="container-xl mt-2 py-2">
    <div class="">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-6">
                        <h2><b>Facturas</b></h2>
                    </div>
                    
                    <div class="col-6 text-right">
                        <a href="{{route("facturas.create")}}" class="btn btn-secondary">
                            <i class="fas fa-plus-circle"></i> 
                            <span>Nuevo</span>
                        </a>
                    </div>
                    
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tablaRegistros">
                    <thead>
                        <tr>
                            <th>Nº Factura</th>
                            <th>Tipo</th>						
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Facturado</th>
                            <th>Cobrado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        
                        <tr>
                            <td>{{$registro->numFactura}}</td>
                            <td>{{$registro->tipoFacturas_id}}</td>
                            <td>{{$registro->clientes_id}}</td>
                            <td>{{$registro->fecha}}</td>
                            <td>@if ($registro->facturado == "S") <i class="fas fa-check text-success" data-facturado="{{$registro->id}}"></i> @else <i class="fas fa-times text-danger"></i> @endif </td>
                            <td>@if ($registro->cobrado == "S") <i class="fas fa-check text-success" data-cobrado="{{$registro->id}}"></i> @else <i class="fas fa-times text-danger"></i> @endif </td>
                            <td>{{$registro->totalEur}}</td>
                            <td style="width: 15%;">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{route("facturas.edit", $registro->id)}}" class="btn text-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <form id="borrar_{{$registro->id}}" class="" action="{{route("facturas.destroy", $registro->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn text-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        <form class="form-inline" action="{{route("facturas.exportar", $registro->id)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn text-info">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="button" class="btn text-warning">
                                            <i class="fas fa-mail-bulk"></i>
                                        </button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<script>
    $(document).ready(function() {
       
        $('#tablaRegistros').DataTable( {
            "language": @php echo file_get_contents(asset('lang/spanish.json')) @endphp,
        });
    });
</script>


</x-app-layout>