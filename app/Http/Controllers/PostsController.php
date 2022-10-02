<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Headers;
use Carbon\Carbon;

class PostsController extends Controller
{
    public function index()
    {
        $registros = Posts::orderBy("created_at", "desc")->get();
        return view("posts.index", compact('registros'));
        
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        
        $valido = $request->validate([
            'header' => 'required|mimes:png,jpg,jpeg,gif',
            'titulo' => 'required|max:100',
            'slug' => ['required', 'unique:posts,slug', 'max:110'],
            'metaSeo' => 'max:100',
            'resumen' => 'max:220',
            'contenido' => '',
            'visible' => '',
            'fechaPublicacion' => '',
            'header_id' => '',
            'altText' => '',
        ], [], [
            
        ]);

        $header = new Headers;
        if($request->file('header')){
            $file = $request->file('header');
            $filename = date('Y-m-d_').$file->getClientOriginalName();
            $file->move(public_path('img/posts/'), $filename);
            $header->ruta = $filename;
            $header->altText = $valido["altText"];
        }
    
        $header->save();

        
        //Asignarle la foto al post
        $valido["header_id"] = $header->id;

        //Hasta añadir fecha de publicacion:
        $valido["fechaPublicacion"] = Carbon::now();

        //Para incrustar el contenido con las html tags
        $valido["contenido"] = $_POST["contenido"];
        
        isset($valido["visible"]) && $valido["visible"] == "on" ? $valido["visible"]="S":$valido["visible"]="N";

        Posts::create($valido);
        
        return redirect()->route("posts.index")
                ->with("success", "Insertado correctamente");
    }

    public function show($id)
    {
        //
    }

    public function edit(Posts $post)
    {
        return view("posts.edit", compact("post"));
    }

    public function update(Request $request, Posts $post)
    {
        $valido = $request->validate([
            'titulo' => 'required|max:100',
            'slug' => ['required', 'unique:posts,slug,'.$post->id, 'max:110'],
            'metaSeo' => 'max:100',
            'resumen' => 'max:220',
            'contenido' => '',
            'visible' => '',
        ], [], [
            
        ]);
        //Para incrustar el contenido con las html tags
        $valido["contenido"] = $_POST["contenido"];


        isset($valido["visible"]) && $valido["visible"] == "on" ? $valido["visible"]="S":$valido["visible"]="N";
        
        $post->update($valido);
        
        return redirect()->route("posts.index")
                ->with("success", "Actualizado correctamente");
        
    }

    public function destroy($id)
    {
        
        Posts::where("id", $id)->delete();
        return redirect()->route("posts.index")
                ->with("success", "Borrado correctamente");
        
    }

    public function subirImagen(Request $request){

        $imgpath = request()->file("file")->store("posts", "public");

        $url = (url("/storage/$imgpath"));

        return response()->json(["location" => $url]);
        
    }

    public function mostrarPost($postUrl){

        $post = Posts::where("slug", $postUrl)->first();

        $postAnterior = null;
        $postPosterior = null;

        if($post){
            $postPosterior = Posts::where("id", "<", $post->id)->where("visible", "S")->first();
            $postAnterior = Posts::where("id", ">", $post->id)->where("visible", "S")->first();
            return view("mostrarPost", compact("post", "postAnterior", "postPosterior"));
        }else{
            abort(404);
        }

        
    }
}
