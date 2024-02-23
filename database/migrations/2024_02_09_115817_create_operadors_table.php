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
        Schema::create('operadors', function (Blueprint $table) {
            $table->id();
            $table->string('name',500);
            $table->string('licencia',500)->nullable();
            $table->string('rfc',500)->nullable();
            $table->string('status')->default('DISPONIBLE');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operadors');
    }
};
