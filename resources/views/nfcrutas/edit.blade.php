<x-app-layout>
<div class="container py-2">
    <div class="row"><div class="col"></div><div class="col-4 text-right"><a href="{{ url('nfcrutas') }}" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i> <span>Volver</span></a></div></div>
    <form action="{{ route('nfcrutas.update', $nfcruta->id) }}" method="POST">
        @csrf @method('PUT')
        @include('nfcrutas.form')
        <hr class="mt-2 mb-3"/>
        <div class="row"><div class="col-12 text-right"><button type="submit" class="btn btn-success">Guardar</button></div></div>
    </form>
</div>
</x-app-layout>
