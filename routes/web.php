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

// Dominio dedicado a las etiquetas NFC (NFC_DOMAIN). Debe registrarse antes que el
// resto de rutas: ese host solo sirve /CODIGO y responde 404 a cualquier otra cosa.
if ($nfcDomain = config("app.nfc_domain")) {
    foreach ([$nfcDomain, "www.".$nfcDomain] as $i => $host) {
        Route::domain($host)->group(function () use ($i) {
            $redirect = Route::get("/{codigo}", "NfcRutasController@redirect")
                ->where("codigo", "[A-Za-z0-9]{20}");
            if ($i === 0) {
                $redirect->name("nfc.redirect");
            }
            Route::any("/{any?}", "NfcRutasController@noEncontrada")->where("any", ".*");
        });
    }
}

Route::get('/', "WebController@index")->name('landing');
Route::get("/blog", "BusquedaController@blog")->name("blog");
Route::get("/blog/{postUrl}", "PostsController@mostrarPost");

Route::get("/politica-privacidad", "WebController@politicaPrivacidad");
Route::get("/politica-cookies", "WebController@politicaCookies");

Route::post("/contacto", "MailController@contacto")->name("mail.contacto");

// Enlace público de las etiquetas NFC en el dominio principal (/nfc/CODIGO).
// Con NFC_DOMAIN es la ruta "legacy" de las etiquetas ya grabadas; sin él, la única.
// Debe permanecer fuera del middleware auth.
Route::get("/nfc/{codigo}", "NfcRutasController@redirect")
    ->name(config("app.nfc_domain") ? "nfc.redirect.legacy" : "nfc.redirect");

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
