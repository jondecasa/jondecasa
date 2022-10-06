@extends('layouts.index')

@section('cuerpo')

@include('layouts.navFixed')

@section('post', 'true')
@section('titulo', $post->titulo. " | Jon de Casa")
@section('keywords', $post->metaSeo)
@section('resumen', $post->resumen)
@if($post->header && $post->header->ruta)
    @section('header', asset("banners/".$post->header->ruta) )
@endif
@section('publicado', $post->metaPublicado)
@section('actualizado', $post->metaModificado)

<div class="container">
    <article class="noticia">
        <div class="row">
            @if($post->header)
                <div class="col-12">
                    <div class="noticiaHeader" style="background-image: url('{{asset("img/posts/".$post->header->ruta)}}')"></div>
                </div>
            @endif
            <div class="col-12">
                <h1><u>{{$post->titulo}}</u></h1>
            </div>
            <div class="col-12">
                <div>{!! $post->contenido !!}</div>
            </div>
        </div>
    </article>


    <div class="otrosPosts d-flex my-3">
        @if($postAnterior)
            <div class="noticiaAnterior">
                <i class="fas fa-chevron-left"></i>
                <a href="{{$postAnterior->slug}}">{{$postAnterior->titulo}}</a>
            </div>
        @endif
        @if($postPosterior)
            <div class="noticiaPosterior">
                <a href="{{$postPosterior->slug}}">{{$postPosterior->titulo}}</a>
                <i class="fas fa-chevron-right"></i>
            </div>
        @endif
    </div>
</div>
@endsection