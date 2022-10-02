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
    <form action="{{route("posts.update", $post->id)}}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <img src="{{url("/img/posts")."/".$post->header->ruta}}" width=100/>
        <div class="row">
            <div class="col">
                <label for="header">Header</label>
                <input type="file" id="header" name="header" accept="image/*" class="form-control">
            </div>
            <div class="col">
                <label for="altText">Texto Alt</label>
                <input type="text" id="altText" name="altText" class="form-control" value="{{old('titulo', $post->header->altText)}}">
            </div>
        </div>
        
        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" maxlength="100" class="form-control" value="{{old('titulo', $post->titulo)}}">
        </div>
        <div class="form-group">
            <label for="slug">URL</label>
            <input type="text" id="slug" readonly name="slug" maxlength="110" class="form-control" value="{{old('slug', $post->slug)}}">
        </div>
        <div class="form-group">
            <label for="metaSeo">SEO (separado por comas)</label>
            <input type="text" id="metaSeo" name="metaSeo" maxlength="100" class="form-control" value="{{old('metaSeo', $post->metaSeo)}}">
        </div>
        <div class="form-group">
            <label for="resumen">Resumen</label>
            <textarea type="resumen" id="resumen" name="resumen" maxlength="220" class="form-control">{{old('resumen', $post->resumen)}}</textarea>
        </div>
        <x-forms.tinymce-editor name="contenido">{{old('contenido', $post->contenido)}}</x-forms.tinymce-editor>
        <div class="form-group">
            <label for="visible">Visible</label>
            <input type="checkbox" name="visible" @if(old("visible", $post->visible) == "S") checked @endif>
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