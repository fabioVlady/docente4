<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique();
            $table->string('descripcion')->nullable();

            $table->date('fecha_entrega_plan');
            
            $table->date('primer_parcial_desde');
            $table->date('primer_parcial_hasta');
            
            $table->date('segundo_parcial_desde');
            $table->date('segundo_parcial_hasta');

            $table->date('examen_final_desde');
            $table->date('examen_final_hasta');

            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodos');
    }
};
