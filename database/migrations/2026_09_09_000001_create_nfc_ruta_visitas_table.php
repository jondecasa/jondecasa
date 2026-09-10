<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNfcRutaVisitasTable extends Migration
{
    public function up()
    {
        Schema::create('nfc_ruta_visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nfc_ruta_id')->constrained('nfc_rutas')->cascadeOnDelete();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('referer')->nullable();
            $table->string('accept_language', 255)->nullable();
            $table->json('request_headers')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nfc_ruta_visitas');
    }
}
