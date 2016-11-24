<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogicaIepe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * En este archivo se crea la v1 de la lógica de la base de datos
     * de iepe. Si el sistema ya está en producción no se debe modificar
     * este archivo, sino crear otra migrasión que modifique éste (para
     * perder información).
     *
     * Se hace el uso de softDeletes, opción que permite que cuando algo se
     * elimina solo sea para el front end ya que el dato aun queda guardado
     * en la base de datos pero ya no aparece en las consultas.
     * Ésto evita inconvenientes con la perdida de datos.
     */
    public function up()
    {
        //

        Schema::create('salones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('edificio');
            $table->integer('capacidad');
            //$table->softDeletes();
            $table->timestamps();
        });

        Schema::create('aplicaciones', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('nombre');
            $table->integer('irregular')->unsigned()->default(0);
            $table->integer('year')->unsigned();
            $table->integer('naplicacion')->unsigned();
            $table->unique(
                ['year', 'naplicacion','irregular'],
                'aplicacion_name_unique');

            $table->string('path_arte');

            $table->date('fecha_inicio_asignaciones');
            $table->datetime('fecha_fin_asignaciones');

            $table->integer('percentil_RA');
            $table->integer('percentil_APE');
            $table->integer('percentil_RV');
            $table->integer('percentil_APN');
            $table->boolean('mostrar_resultados');

            $table->timestamps();
            //$table->softDeletes();
        });

        Schema::create('horarios', function (Blueprint $table){
            $table->increments('id');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
            //$table->softDeletes();
        });

        Schema::create('aplicaciones_salones_horarios', function (Blueprint $table){
            $table->increments('id');
            $table->integer('aplicacion_id')->unsigned();
            $table->foreign('aplicacion_id')->references('id')->on('aplicaciones');
            $table->integer('salon_id')->unsigned();
            $table->foreign('salon_id')->references('id')->on('salones');
            $table->integer('horario_id')->unsigned();
            $table->foreign('horario_id')->references('id')->on('horarios');
            $table->integer('asignados')->unsigned()->default(0);
            $table->date('fecha_aplicacion');

            $table->unique(['aplicacion_id', 'salon_id','horario_id','fecha_aplicacion'],'aplicacion_salon_horario_primary');
            $table->timestamps();
        });

        Schema::create('actas',function(Blueprint $table){
            $table->increments('id');
            $table->string('path_pdf');
            $table->string('comentario');

            $table->boolean('aprobacion_decanato');
            $table->boolean('aprobacion_secretaria');

            $table->enum('estado',['propuesta','enviada','aprobada','reprobada']);

            $table->integer('aplicacion_id')->unsigned();
            $table->foreign('aplicacion_id')->references('id')->on('aplicaciones');

            $table->timestamps();
            $table->softDeletes();


        });


        Schema::create('aspirantes_aplicaciones', function (Blueprint $table){
            $table->increments('id');
            $table->integer('aplicacion_salon_horario_id')->unsigned();
            $table->foreign('aplicacion_salon_horario_id')->references('id')->on('aplicaciones_salones_horarios');

            $table->bigInteger('aspirante_id')->unsigned();
            $table->foreign('aspirante_id')->references('NOV')->on('aspirantes');

            $table->integer('acta_id');

            $table->unique(['aplicacion_salon_horario_id', 'aspirante_id'],'aspirantes_aplicaciones_primary');

            $table->integer('nota_RA');
            $table->integer('nota_APE');
            $table->integer('nota_RV');
            $table->integer('nota_APN');

            $table->enum('resultado',['pendiente','aprobado','reprobado','irregular']);

            $table->timestamps();
            //$table->softDeletes();
        });

        Schema::create('datos_sun',function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('orientacion');
            $table->bigInteger('CUI');
            $table->string('primer_apellido',35);
            $table->string('segundo_apellido',35);
            $table->string('primer_nombre',35);
            $table->string('segundo_nombre',35);
            $table->date('fecha_nacimiento');
            $table->boolean('sexo');
            $table->tinyInteger('id_materia');
            $table->boolean('aprobacion');
            $table->date('fecha_evaluacion');
            $table->integer('anio_evaluacion');

            $table->timestamps();
            //$table->softDeletes();

            $table->unique(['orientacion', 'fecha_evaluacion','id_materia'],'datos_sun_primary');
        });

        Schema::create('cupos',function(Blueprint $table){
            $table->increments('id');
            $table->enum('carrera',['disenio','arquitectura']);
            $table->enum('jornada',['matutina','vespertina']);
            $table->integer('cantidad');
            $table->integer('confirmados');
            $table->integer('anio');

            $table->timestamps();
            //$table->softDeletes();

            $table->unique(['anio', 'carrera','jornada'],'cupos_primary');

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
        Schema::dropIfExists('aspirantes_aplicaciones');
        Schema::dropIfExists('aplicaciones_salones_horarios');
        Schema::dropIfExists('horarios');
        Schema::dropIfExists('actas');
        Schema::dropIfExists('aplicaciones');
        Schema::dropIfExists('salones');
        Schema::dropIfExists('datos_sun');
        Schema::dropIfExists('cupos');
    }
}
