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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('name',500);
            $table->string('razon_social',500);
            $table->string('direccion',500)->nullable();
            $table->string('rfc',500);
            $table->string('origen',500);
            $table->string('busqueda')->default('SU PLANTA');
            $table->enum('status',['Activo','Inactivo'])->default('Activo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
