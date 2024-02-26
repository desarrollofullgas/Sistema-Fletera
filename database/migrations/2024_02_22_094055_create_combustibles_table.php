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
        Schema::create('combustibles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estacion_id');
            $table->enum('tipo',['MAGNA','PREMIUM','DIESEL']);
            $table->string('clave', 500);
            $table->decimal('capacidad', 10, 2);
            $table->decimal('prom_venta', 8, 2); 
            $table->decimal('dif_vr_fisico', 8, 2); 
            $table->decimal('minimo', 8, 2); 
            $table->decimal('alerta', 8, 2); 
            $table->timestamps();
    

            $table->foreign('estacion_id')->references('id')->on('estacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combustibles');
    }
};
