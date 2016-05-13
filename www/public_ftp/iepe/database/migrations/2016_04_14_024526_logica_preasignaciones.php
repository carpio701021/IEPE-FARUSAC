<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogicaPreasignaciones extends Migration
{
    /**
     * Run the migrations.
     * Esta migración es relacionada a lo que sucede despues de aprobar
     * las pruebas específicas. Se habilita la opción de preasignarse y
     * se preasigna a una seccion segun su jornada.
     * @return void
     */
    public function up()
    {
        //
        Schema::create('jornadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->softDeletes();
        });

        Schema::create('ciclos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('preasignacion_activa');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('secciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->integer('jornada_id')->unsigned();
            $table->foreign('jornada_id')->references('id')->on('jornadas');
            $table->integer('ciclo_id')->unsigned();
            $table->foreign('ciclo_id')->references('id')->on('ciclos');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pre_secciones_aspirantes', function (Blueprint $table) {
            //preasignaciones de los estudiantes a las secciones
            $table->integer('aspirante_id')->unsigned();
            $table->foreign('aspirante_id')->references('NOV')->on('aspirantes');

            $table->integer('seccion_id')->unsigned();
            $table->foreign('seccion_id')->references('id')->on('secciones');

            $table->primary(['aspirante_id', 'seccion_id']);

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('pre_secciones_aspirantes');
        Schema::dropIfExists('secciones');
        Schema::dropIfExists('ciclos');
        Schema::dropIfExists('jornadas');
    }
}
