<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas_detalle', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('facturas_id');
            $table->integer('proyectos_id')->nullable();
            $table->text('concepto')->nullable();
            $table->decimal('cantidad', 5, 2)->nullable();
            $table->decimal('importe', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();

            $table->foreign('facturas_id', 'FK_facturas_detalle_facturas')->references('id')->on('facturas');
            $table->foreign('proyectos_id', 'FK_facturas_detalle_proyectos')->references('id')->on('proyectos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas_detalle');
    }
};
