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
        Schema::create('estacions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->string('num_estacion',500);
            $table->string('razon_social', 500)->nullable();
            $table->string('rfc', 500)->nullable();
            $table->string('siic',500)->nullable();
            $table->float('iva',10,2)->nullable();
            $table->string('num_cre', 500)->nullable();
            $table->string('direccion', 500)->nullable();
            $table->string('propietario', 500)->nullable();
            $table->unsignedBigInteger('zona_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->enum('status',['Activo','Inactivo'])->default('Activo');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('zona_id')->references('id')->on('zonas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estacions');
    }
};
