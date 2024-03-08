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
        Schema::create('lectura_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lectura_id');
            $table->unsignedBigInteger('combustible_id');
            $table->decimal('veeder', 10, 2);
            $table->decimal('fisico', 10, 2);
            $table->decimal('venta_periferico', 10, 2);
            $table->decimal('venta_electronica', 10, 2);
            $table->decimal('venta_odometro', 10, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lectura_id')->references('id')->on('lecturas')->onDelete('cascade');
            $table->foreign('combustible_id')->references('id')->on('combustibles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectura_detalles');
    }
};
