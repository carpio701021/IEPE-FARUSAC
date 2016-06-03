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
            $table->integer('capacidad');
            $table->string('ubicacion');
            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('aplicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('path_arte');

            $table->date('fecha_aplicacion');
            $table->date('fecha_publicacion_resultados');
            $table->date('fecha_inicio_asignaciones');
            $table->date('fecha_fin_asignaciones');

            $table->integer('percentil_RA');
            $table->integer('percentil_APE');
            $table->integer('percentil_RV');
            $table->integer('percentil_APN');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('horarios', function (Blueprint $table){
            $table->increments('id');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
            $table->softDeletes();
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

            $table->unique(['aplicacion_id', 'salon_id','horario_id'],'aplicacion_salon_horario_primary');
            $table->timestamps();
        });


        Schema::create('aspirantes_aplicaciones', function (Blueprint $table){
            $table->increments('id');
            $table->integer('aplicacion_salon_horario_id')->unsigned();
            $table->foreign('aplicacion_salon_horario_id')->references('id')->on('aplicaciones_salones_horarios');

            $table->integer('aspirante_id')->unsigned();
            $table->foreign('aspirante_id')->references('NOV')->on('aspirantes');

            $table->unique(['aplicacion_salon_horario_id', 'aspirante_id'],'aspirantes_aplicaciones_primary');

            $table->integer('nota_RA');
            $table->integer('nota_APE');
            $table->integer('nota_RV');
            $table->integer('nota_APN');

            $table->enum('resultado',['pendiente','aprobado','reprobado']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('datos_sun',function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('orientacion');
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
            $table->softDeletes();

            $table->unique(['orientacion', 'fecha_evaluacion','id_materia'],'datos_sun_primary');

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
        Schema::dropIfExists('aplicaciones');
        Schema::dropIfExists('salones');
        Schema::dropIfExists('datos_sun');
    }
}
