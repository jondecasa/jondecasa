<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("test", function(){
    if((response())){
        $res = json_encode(response());
    }else{
        $res = "vacio";
    }
    \Log::info("aaaa". $res);
    
});
Route::get("test2", function(Request $request){
    if($request){
        $res = json_encode($request->all());
    }else{
        $res = "vacio";
    }
    \Log::info(date("Y-m-d h:i:s")." GET: ". json_encode([
            "info" => "Info recibida",
            "datos" => $res,
            "contenido" => $request->getContent()]));
    
    return response()->json([
            "info" => "Info recibida",
            "datos" => $res,
            "contenido" => $request->getContent()]);
});

Route::post("test3", function(Request $request){
    if($request){
        $res = json_encode($request->all());
    }else{
        $res = "vacio";
    }
    \Log::info(date("Y-m-d h:i:s")." POST: ". json_encode([
            "info" => "Info recibida",
            "datos" => $res,
            "contenido" => $request->getContent()]));
    
    return response()->json([
            "info" => "Info recibida",
            "datos" => $res,
            "contenido" => $request->getContent()]);
});