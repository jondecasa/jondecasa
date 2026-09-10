<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('clientes_id');
            $table->mediumText('proyecto');
            $table->mediumText('observaciones')->nullable();
            $table->date('alta')->nullable();
            $table->date('cierre')->nullable();
            $table->integer('costeHora')->nullable();

            $table->foreign('clientes_id', 'FK_proyectos_clientes')->references('id')->on('clientes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
