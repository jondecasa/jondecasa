<x-app-layout>
<div class="container py-2">
    <div class="row">
        <div class="col"></div>
        <div class="col-4 text-right">
            <a href="{{url('clientes')}}" class="btn btn-secondary">
                <i class="fa fa-arrow-circle-left"></i>
                <span>Volver</span>
            </a>
        </div>
    </div>
    <form action="{{route("clientes.store")}}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{old('nombre')}}">
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" maxlength="9" id="dni" name="dni" class="form-control" value="{{old('dni')}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control"  value="{{old('email')}}">
        </div>

        <div class="form-group">
            <label for="fechaNac">Fecha Nacimiento</label>
            <input type="date" id="fechaNac" name="fechaNac" class="form-control" value="{{old('fechaNac')}}">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control"  value="{{old('direccion')}}">
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