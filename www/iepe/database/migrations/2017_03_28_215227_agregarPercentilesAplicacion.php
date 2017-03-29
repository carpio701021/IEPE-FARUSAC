<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarPercentilesAplicacion extends Migration
{
    /**
     * Run the migrations.
     * Se agregó la funcionalidad para poder calificar de diferente forma a la carrera de 
     * diseño grafico y arquitectura pero se quiere guardar registro de los precentiles utilizados
     * por lo que se agregan 4 nuevos campos para calificar a disenio
     * @return void
     */
    public function up()
    {
        Schema::table("aplicaciones", function(Blueprint $table){
            $table->integer('percentil_RA_disenio');
            $table->integer('percentil_APE_disenio');
            $table->integer('percentil_RV_disenio');
            $table->integer('percentil_APN_disenio');            
            $table->boolean('mostrar_resultados_detallados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("aplicaciones", function(Blueprint $table){
            $table->dropColumn('percentil_RA_disenio');
            $table->dropColumn('percentil_APE_disenio');
            $table->dropColumn('percentil_RV_disenio');
            $table->dropColumn('percentil_APN_disenio');
            $table->dropColumn('mostrar_resultados_detallados');
            
        });
    }
}
