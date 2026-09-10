<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('forma_pagos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('pago', 50)->default('');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forma_pagos');
    }
};
