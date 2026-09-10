<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('numFactura')->nullable();
            $table->integer('tipoFacturas_id')->nullable();
            $table->integer('clientes_id')->nullable();
            $table->date('fecha')->nullable();
            $table->date('vencimiento')->nullable();
            $table->decimal('base', 10, 2)->nullable();
            $table->integer('iva')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('retencion', 10, 2)->nullable();
            $table->enum('facturado', ['S', 'N'])->default('N')->nullable();
            $table->enum('cobrado', ['S', 'N'])->default('N')->nullable();
            $table->integer('facturasAbono_id')->nullable();
            $table->integer('formaPagos_id')->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('monedas_id')->nullable();
            $table->decimal('totalEur', 10, 2)->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();

            $table->foreign('tipoFacturas_id', 'FK_facturas_tipo_facturas')->references('id')->on('tipo_facturas');
            $table->foreign('clientes_id', 'FK_facturas_clientes')->references('id')->on('clientes');
            $table->foreign('formaPagos_id', 'FK_facturas_forma_pagos')->references('id')->on('forma_pagos');
            $table->foreign('monedas_id', 'FK_facturas_monedas')->references('id')->on('monedas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
