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
        Schema::create('cataports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estacion_id');
            $table->unsignedBigInteger('combustible_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('unidad_id');
            $table->unsignedBigInteger('pipa_id');
            $table->unsignedBigInteger('operador_id');
            $table->unsignedBigInteger('contenido');
            $table->string('remisionfac',30)->nullable();
            $table->string('sello_tfgd',30)->nullable();
            $table->string('sello_tfgc',30)->nullable();
            $table->string('sello_r',30)->nullable();
            $table->string('sello_td',30)->nullable();
            $table->string('status',30)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('estacion_id')->references('id')->on('estacions')->onDelete('CASCADE');
            $table->foreign('combustible_id')->references('id')->on('combustibles')->onDelete('CASCADE');
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('CASCADE');
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('CASCADE');
            $table->foreign('pipa_id')->references('id')->on('pipas')->onDelete('CASCADE');
            $table->foreign('operador_id')->references('id')->on('operadors')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cataports');
    }
};
