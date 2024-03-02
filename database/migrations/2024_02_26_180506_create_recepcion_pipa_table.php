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
        Schema::create('recepcion_pipas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cataporte_id');
            $table->string('ciza')->nullable();
            $table->boolean('parti_gerente')->default(false);
            $table->string('remision_fac')->nullable();
            $table->unsignedBigInteger('importe')->nullable();
            $table->string('selloP1')->nullable();
            $table->string('selloP2')->nullable();
            $table->time('hora_desc_in')->nullable();
            $table->time('hora_desc_fin')->nullable();
            $table->time('hora_llegada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->unsignedFloat('ant_desc_vroot')->default(0);
            $table->unsignedFloat('desp_desc_vroot')->default(0);
            $table->unsignedFloat('ant_desc_fisico')->default(0);
            $table->unsignedFloat('desp_desc_fisico')->default(0);
            $table->unsignedFloat('aum_desc_fisico')->default(0);
            $table->float('dif_lent_fisico')->default(0);
            $table->unsignedFloat('venta_dur_descarga')->default(0);
            $table->unsignedFloat('litros_adicionales')->default(0);
            $table->unsignedFloat('aum_desc_vroot')->default(0);
            $table->float('dif_litros_fact_root')->default(0);
            $table->string('status_pipa')->nullable();
            $table->string('observacion_op')->nullable();
            $table->string('observaciones')->nullable();
            $table->date('fecha_factura')->nullable();//
            $table->integer('variacion')->default(0);
            $table->float('por_dif_fisico')->default(0);
            $table->float('por_dif_root')->default(0);
            $table->integer('costo_flete')->default(0);
            $table->unsignedBigInteger('costos')->default(0);
            $table->unsignedFloat('costo_fac')->default(0);
            $table->unsignedFloat('costos_uni')->default(0);
            //$table->unsignedBigInteger('capacidad_pipa')->default(0);//contenido del viaje
            $table->integer('dif_fisico')->default(0);
            $table->integer('dif_vroot')->default(0);
            $table->float('dif_fvsv')->default(0);
            $table->float('merma_fisico_p')->default(0);
            $table->float('merma_vroot_p')->default(0);
            $table->float('merma_fisico_f')->default(0);
            $table->float('merma_vroot_f')->default(0);
            $table->float('dif_pipa_fac')->default(0);
            $table->float('vol_abf')->default(0);
            $table->float('vol_abv')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('cataporte_id')->references('id')->on('cataports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepcion_pipa');
    }
};
