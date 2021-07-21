<x-app-layout>
<div class="container py-2">
    <div class="row">
        <div class="col"></div>
        <div class="col-4 text-right">
            <a href="{{url('proyectos')}}" class="btn btn-secondary">
                <i class="fa fa-arrow-circle-left"></i>
                <span>Volver</span>
            </a>
        </div>
    </div>
    <form action="{{route("proyectos.update", $proyecto->id)}}" method="POST">
        @csrf
        @method("PUT")
        
        <div class="form-group">
            <label for="clientes_id">Cliente</label>
            <select class="form-control" name="clientes_id">
                @foreach($clientes as $cliente)
                <option value="{{$cliente->id}}" @if(old("clientes_id", $proyecto->clientes_id) == $proyecto->clientes_id) selected @endif>{{$cliente->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="proyecto">Proyecto</label>
            <input type="text" name="proyecto" class="form-control" value="{{old('proyecto', $proyecto->proyecto)}}">
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea type="text" name="observaciones" class="form-control">{{old('observaciones', $proyecto->observaciones)}}</textarea>
        </div>
        <div class="form-group">
            <label for="alta">Alta</label>
            <input type="date" id="alta" name="alta" class="form-control" value="{{old('alta', $proyecto->alta)}}">
        </div>
        <div class="form-group">
            <label for="cierre">Cierre</label>
            <input type="date" id="cierre" name="cierre" class="form-control" value="{{old('cierre', $proyecto->cierre)}}">
        </div>
        <div class="form-group">
            <label for="coste">Coste Hora</label>
            <input type="number" name="coste" class="form-control" value="{{old('coste', $proyecto->costeHora)}}">
        </div>
        
        <hr class="mt-2 mb-3"/>
        <div class="row">
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-success">
                    Guardar
                </button>
            </div>
        </div>
    </form>
    
</div>
</x-app-layout>