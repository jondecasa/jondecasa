<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', "WebController@index")->name('landing');
Route::get("/blog", "BusquedaController@blog")->name("blog");
Route::get("/blog/{postUrl}", "PostsController@mostrarPost");

Route::get("/politica-privacidad", "WebController@politicaPrivacidad");
Route::get("/politica-cookies", "WebController@politicaCookies");

Route::post("/contacto", "MailController@contacto")->name("mail.contacto");

// Enlace público de las etiquetas NFC. Debe permanecer fuera del middleware auth.
Route::get("/nfc/{codigo}", "NfcRutasController@redirect")->name("nfc.redirect");

Route::middleware("auth")->group(function(){
    Route::resource("/clientes", "ClientesController");
    Route::resource("/proyectos", "ProyectosController");
    Route::resource("/nfcrutas", "NfcRutasController")->except(["show"]);

    Route::post("/facturas/exportar/{id}", "FacturasController@exportar")->name("facturas.exportar");
    Route::resource("/facturas", "FacturasController");

    //Mi perfil
    Route::get("/perfil", "PerfilController@index")->name("perfil");
    Route::post("/perfil/actualizarPass", "PerfilController@actualizarPass");
    Route::post("/perfil/actualizarInfo", "PerfilController@actualizarInfo");

    //Posts blog
    Route::resource("/posts", "PostsController");
    Route::post("/subirImagen", "PostsController@subirImagen");

    Route::get("/dashboard", "WebController@indexLogued")->name("indexLogued");
});


require __DIR__.'/auth.php';
