<x-app-layout>
<div class="container-xl mt-2 py-2">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-6"><h2><b>Rutas NFC</b></h2></div>
                <div class="col-6 text-right">
                    <a href="{{ route('nfcrutas.create') }}" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> <span>Nueva</span></a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaRegistros">
                <thead><tr><th>Título</th><th>ID público</th><th>URL</th><th>Activo</th><th>Visitas</th><th>Acciones</th></tr></thead>
                <tbody>
                    @foreach($registros as $registro)
                    <tr>
                        <td>{{ $registro->titulo }}</td>
                        <td>
                            <a href="{{ route('nfc.redirect', $registro->codigo) }}" target="_blank" rel="noopener noreferrer">{{ $registro->codigo }}</a>
                            <button type="button" class="btn btn-sm text-secondary copiar-url-nfc" data-url="{{ route('nfc.redirect', $registro->codigo) }}" title="Copiar URL pública" aria-label="Copiar URL pública">
                                <i class="far fa-copy"></i>
                            </button>
                        </td>
                        <td><a href="{{ $registro->url }}" target="_blank" rel="noopener noreferrer">{{ $registro->url }}</a></td>
                        <td>{{ $registro->activo ? 'Sí' : 'No' }}</td>
                        <td>{{ $registro->visitas_count }}</td>
                        <td>
                            <form action="{{ route('nfcrutas.destroy', $registro->id) }}" method="POST">
                                <a href="{{ route('nfcrutas.edit', $registro->id) }}" class="btn text-primary"><i class="far fa-edit"></i></a>
                                @csrf @method('DELETE')
                                <button type="submit" class="btn text-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#tablaRegistros').DataTable({ "language": @php echo file_get_contents(asset('lang/spanish.json')) @endphp });

    $('.copiar-url-nfc').on('click', function() {
        var boton = $(this);
        var url = boton.data('url');

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(function() {
                boton.attr('title', 'URL copiada');
            });
            return;
        }

        var input = $('<input>').val(url).appendTo('body').select();
        document.execCommand('copy');
        input.remove();
        boton.attr('title', 'URL copiada');
    });
});
</script>
</x-app-layout>
