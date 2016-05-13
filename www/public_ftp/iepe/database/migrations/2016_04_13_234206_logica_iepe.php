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

        });

        Schema::create('pruebas_especificas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->softDeletes();
        });

        Schema::create('oportunidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('path_arte');

            $table->date('fecha_aplicacion');
            //$table->time('hora_inicio');
            //$table->time('hora_fin');
            $table->date('fecha_publicacion_resultados');

            $table->integer('percentil_RA');
            $table->integer('percentil_APE');
            $table->integer('percentil_RV');
            $table->integer('percentil_APN');

            $table->integer('salon_id')->unsigned();
            $table->foreign('salon_id')->references('id')->on('salones');
            $table->integer('prueba_especifica_id')->unsigned();
            $table->foreign('prueba_especifica_id')->references('id')->on('pruebas_especificas');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('horarios', function (Blueprint $table){
            $table->increments('id');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('oportunidad_id')->unsigned();
            $table->foreign('oportunidad_id')->references('id')->on('oportunidades');

            $table->softDeletes();
        });

        Schema::create('aspirantes_oportunidades', function (Blueprint $table){
            $table->integer('oportunidad_id')->unsigned();
            $table->foreign('oportunidad_id')->references('id')->on('oportunidades');
            $table->integer('aspirante_id')->unsigned();
            $table->foreign('aspirante_id')->references('NOV')->on('aspirantes');
            $table->primary(['oportunidad_id', 'aspirante_id']);

            $table->integer('nota_RA');
            $table->integer('nota_APE');
            $table->integer('nota_RV');
            $table->integer('nota_APN');

            $table->enum('resultado',['pendiente','aprobado','reprobado']);

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
        Schema::dropIfExists('aspirantes_oportunidades');
        Schema::dropIfExists('horarios');
        Schema::dropIfExists('oportunidades');
        Schema::dropIfExists('pruebas_especificas');
        Schema::dropIfExists('salones');
    }
}
