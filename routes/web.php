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

Route::get("/prueba", "PruebasController@index");
Route::get("/obtenerCredenciales", "PruebasController@obtenerCredenciales");
//Route::get("/mail", "App\Http\Controllers\PruebasController@mail");

Route::get('/', "WebController@index")->name('landing');
Route::get("/politica-privacidad", "WebController@politicaPrivacidad");
Route::get("/politica-cookies", "WebController@politicaCookies");

//Route::get("/prueba", "PruebasController@test");

Route::post("/contacto", "MailController@contacto")->name("mail.contacto");

Route::middleware("auth")->group(function(){
    Route::resource("/clientes", "ClientesController");
    Route::resource("/proyectos", "ProyectosController");
    
    Route::post("/facturas/exportar/{id}", "FacturasController@exportar")->name("facturas.exportar");
    Route::resource("/facturas", "FacturasController");
    
    //Mi perfil
    Route::get("/perfil", "PerfilController@index")->name("perfil");
    Route::post("/perfil/actualizarPass", "PerfilController@actualizarPass");
    Route::post("/perfil/actualizarInfo", "PerfilController@actualizarInfo");
    
    //Paypal
    Route::get("/paypal/pagar", "PaypalController@paypalPayment");
    Route::get("/paypal/status", "PaypalController@paypalStatus");

    //Bot
    Route::get("/bot", "BotController@index");
    
    Route::get("/dashboard", "WebController@indexLogued")->name("indexLogued");
});


require __DIR__.'/auth.php';
