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
        Schema::create('dispensarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estacion_id');
            $table->string('marca',500);
            $table->string('modelo', 500);
            $table->string('mangueras');
            $table->enum('flujo', ['ALTO','NORMAL','ALTO/NORMAL']);
            $table->string('serie',500);
            $table->string('version_cpu');
            $table->timestamps();
    

            $table->foreign('estacion_id')->references('id')->on('estacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispensarios');
    }
};
