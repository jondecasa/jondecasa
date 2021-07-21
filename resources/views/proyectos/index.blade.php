
<x-app-layout>


<div class="container-xl mt-2 py-2">
    <div class="">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-6">
                        <h2><b>Proyectos</b></h2>
                    </div>
                    
                    <div class="col-6 text-right">
                        <a href="{{route("proyectos.create")}}" class="btn btn-secondary">
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
                            <th>Cliente</th>
                            <th>Proyecto</th>						
                            <th>Observaciones</th>
                            <th>Fecha Cierre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        
                        <tr>
                            <td>{{$registro->cliente->nombre}}</td>
                            <td>{{$registro->proyecto}}</td>
                            <td>{{$registro->observaciones}}</td>
                            <td>{{$registro->cierre ?? ""}}</td>
                            <td>
                                <form id="borrar_{{$registro->id}}" class="" action="{{route("proyectos.destroy", $registro->id)}}" method="POST">
                                    
                                    <a href="{{route("proyectos.edit", $registro->id)}}" class="btn text-primary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    
                                </form>
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