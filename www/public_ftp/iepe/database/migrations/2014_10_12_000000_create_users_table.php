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
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('admin_rols', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('rol',[
                'superadmin', //persona que puede editar todo
                'jefe_bienestar',
                'secretario',
                'decano'
            ]);
            $table->integer('admin_registro_personal')->unsigned();
            $table->foreign('admin_registro_personal')->references('registro_personal')->on('admins');
            $table->timestamps();
        });

        Schema::create('aspirantes', function (Blueprint $table) {
            $table->integer('NOV')->unsigned()->primary();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
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
        Schema::drop('aspirantes');
        Schema::drop('adminRol');
        Schema::drop('admins');
    }
}
