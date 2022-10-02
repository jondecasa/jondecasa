<x-app-layout>
    
<x-head.tinymce-config/>
<div class="container py-2">
    <div class="row">
        <div class="col"></div>
        <div class="col-4 text-right">
            <a href="{{url('posts')}}" class="btn btn-secondary">
                <i class="fa fa-arrow-circle-left"></i>
                <span>Volver</span>
            </a>
        </div>
    </div>
    <form action="{{route("posts.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <label for="header">Header</label>
                <input type="file" id="header" name="header" accept="image/*" class="form-control">
            </div>
            <div class="col">
                <label for="altText">Texto Alt</label>
                <input type="text" id="altText" name="altText" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" required maxlength="100" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">URL</label>
            <input type="text" id="slug" name="slug" required maxlength="110" class="form-control">
        </div>
        <div class="form-group">
            <label for="metaSeo">SEO (separado por comas)</label>
            <input type="text" id="metaSeo" name="metaSeo" maxlength="100" class="form-control">
        </div>
        <div class="form-group">
            <label for="resumen">Resumen</label>
            <textarea type="resumen" id="resumen" name="resumen" maxlength="220" class="form-control"></textarea>
        </div>
        {{-- <div class="form-group">
            <label for="contenido">Contenido</label>
            <textarea type="contenido" id="contenido" name="contenido" class="form-control" rows="10"></textarea>
        </div> --}}
        <div class="form-group">
            <label for="contenido">Contenido</label>
            <x-forms.tinymce-editor name="contenido"/>
        </div>

        <div class="form-group">
            <label for="visible">Visible</label>
            <input type="checkbox" name="visible" checked>
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
<script>
    $("#titulo").on("change", function(){
        var titulo = $("#titulo").val();
        titulo = titulo.replace(/ /g, "-").toLowerCase();
        $("#slug").val(titulo);
    });
</script>
</x-app-layout>