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
        Schema::create('lecturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estacion_id');
            $table->decimal('total_litros', 10, 2);
            $table->decimal('total_pesos', 10, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('estacion_id')->references('id')->on('estacions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturas');
    }
};
