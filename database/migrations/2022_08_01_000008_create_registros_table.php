<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabla usada por PaypalController/BotController (App\Models\Registros) para
 * registrar los periodos de suscripción del bot pagados vía PayPal.
 * No estaba en el backup (nunca se llegó a poblar); el esquema se infiere del
 * código: Registros tiene $timestamps = false y usa user_id / fechaInicio / fechaFin.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('user_id');
            $table->dateTime('fechaInicio')->nullable();
            $table->dateTime('fechaFin')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
