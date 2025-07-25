
<x-app-layout>


<div class="container-xl mt-2 py-2">
    <div class="">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-6">
                        <h2><b>Posts</b></h2>
                    </div>
                    
                    <div class="col-6 text-right">
                        <a href="{{route("posts.create")}}" class="btn btn-secondary">
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
                            <th>Id</th>
                            <th>Título</th>
                            <th>Resumen</th>						
                            <th>SEO</th>
                            <th>Contenido</th>
                            <th>Visible</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        
                        <tr>
                            <td>{{$registro->id}}</td>
                            <td>{{$registro->titulo}}</td>
                            <td>{{$registro->resumen}}</td>
                            <td>{{$registro->metaSeo}}</td>
                            
                            <td>{{strip_tags(mb_substr($registro->contenido, 0, 100))}}...</td>
                            <td>{{$registro->visible == "N" ? "Oculto" : "Visible"}}</td>
                            <td>
                                <form id="borrar_{{$registro->id}}" class="" action="{{route("posts.destroy", $registro->id)}}" method="POST">
                                    
                                    <a href="{{route("posts.edit", $registro->id)}}" class="btn text-primary">
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
            "order": [[0, "desc"]]
        });
    });
</script>


</x-app-layout>