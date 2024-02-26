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
        Schema::create('pipas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unidad_id');
            $table->string('toneles',20);
            $table->string('placa',20)->nullable();
            $table->string('marca',20)->nullable();
            $table->string('modelo')->nullable();
            $table->string('serie')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('unidad_id')->references('id')->on('unidads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pipas');
    }
};
