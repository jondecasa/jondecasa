@extends('layouts.index')

@section('cuerpo')

@include('layouts.navFixed')
<div class="pt-5"></div>
<div class="max-width pt-5">
    <div class="container">
    <div class="row animacionVisible ani-slide-up animacion">
            @foreach($posts as $post)
                <div class="col-12 col-lg-3">
                        @if($post->header)
                        <a href="{{url('blog/'.$post->slug)}}">
                            <div class="fotoNoticia">
                                <img src="{{asset('img/posts/'.$post->header->ruta)}}" alt="{{$post->header->altText ?? ""}}"/>
                            </div> 
                        </a>   
                        @endif
                        <div class="noticia">
                            <div class="fechaTitulo">{{date('d/m/Y', strtotime($post->fechaPublicacion))}}</div>
                            <a href="{{url('blog/'.$post->slug)}}">
                                <div class="noticiaTitulo">{{$post->titulo}}</div>
                            </a>
                            <div class="noticiaTexto">{{$post->resumen}}</div>
                        </div>
                </div>
            @endforeach
            </div>
            @if ($posts->hasPages())
                <div class="pagination-wrapper">
                    {{ $posts->links() }}
                </div>
            @endif
    </div>
</div>
@endsection