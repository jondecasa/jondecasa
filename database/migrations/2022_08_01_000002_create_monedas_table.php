<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monedas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('moneda', 50)->default('');
            $table->string('ticker', 4)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monedas');
    }
};
