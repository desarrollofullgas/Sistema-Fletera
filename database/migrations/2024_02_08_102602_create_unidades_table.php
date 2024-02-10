<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('linea_id');
            $table->string('tractor',30);
            $table->integer('capacidad');
            $table->string('placa',30)->nullable();
            $table->string('marca',30)->nullable();
            $table->string('serie',30)->nullable();
            $table->string('status',30)->default('Disponible');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('linea_id')->references('id')->on('lineas')->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
