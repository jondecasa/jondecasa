<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('users_id')->nullable();
            $table->text('nombre')->nullable();
            $table->text('dni')->nullable();
            $table->date('fechaNac')->nullable();
            $table->text('email')->nullable();
            $table->text('direccion')->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();

            $table->foreign('users_id', 'FK_clientes_users')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
