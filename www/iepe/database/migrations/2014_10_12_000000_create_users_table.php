<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * Esta migración crea los dos usuarios principales que son los aspirantes
     * y los administradores. Los administradores tienen diferentes asignaciones
     * a permisos.
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('registro_personal')->unsigned()->primary();
            //$table->increments('id');
            $table->string('email')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('password', 60);

            $table->enum('rol',[
                'superadmin', //persona que puede editar todo_
                'jefe_bienestar',
                'secretario',
                'decano',
                'director_arquitectura',
                'director_disenio_grafico',
                'consultor_ws'
            ]);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('aspirantes', function (Blueprint $table) {
            $table->bigInteger('NOV')->unsigned()->primary();
            $table->bigInteger('CUI')->unsigned()->nullable()->unique(); //número de DPI
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('activated')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('lista_negra_aspirantes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('NOV')->unsigned();
            $table->timestamps();
        });

        Schema::create('formularios', function (Blueprint $table) {
            $table->increments('id_formulario');
            $table->date('fecha_nacimiento');
            $table->string('residencia');
            $table->string('departamento');
            $table->string('municipio');
            $table->enum('estado_civil',['soltero', 'casado']);
            $table->enum('estado_laboral',['trabaja', 'no_trabaja']);
            $table->enum('genero',['masculino', 'femenino']);
            $table->string('titulo');
            $table->string('telefono');
            $table->string('celular');
            $table->integer('anio_titulo');
            $table->integer('dependientes');
            $table->string('centro_educativo');
            $table->string('direccion_centro_educativo');
            $table->enum('sector',['privado', 'publico']);
            $table->enum('carrera',['arquitectura', 'diseño']);
            $table->enum('jornada',['matutina', 'vespertina']);
            $table->boolean('confirmacion_intereses');
            $table->bigInteger('NOV')->unsigned();
            $table->foreign('NOV')->references('NOV')->on('aspirantes');
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
        Schema::dropIfExists('formularios');
        Schema::drop('lista_negra_aspirantes');
        Schema::drop('aspirantes');
        Schema::drop('admins');
    }
}
