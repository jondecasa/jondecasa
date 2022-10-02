<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class BusquedaController extends Controller
{
    public function buscar(Request $request){

        if(isset($request->buscar)){
            $palabras = explode(" ", $request->buscar);
            $posts = Posts::with("header")->where("visible", "S");
            
            $posts->where( function($query) use ($palabras) {
                foreach($palabras as $palabra){
                    $query->orWhere("titulo", 'LIKE','%'.$palabra.'%');
                    $query->orWhere("metaSeo", 'LIKE','%'.$palabra.'%');
                    $query->orWhere("resumen", 'LIKE','%'.$palabra.'%');
                    $query->orWhere("contenido", 'LIKE','%'.$palabra.'%');
                }
            });
            
            $posts = $posts->get();

            return view("resultadoBusqueda", compact("posts"));
        }
    }

    public function blog(){
        $posts = Posts::with("header")
                        ->where("visible", "S")
                        ->orderBy("fechaPublicacion", "desc")
                        ->paginate(3);

        return view("blog", compact("posts"));
    }
}
