<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRepetidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table("formularios", function(Blueprint $table){
            //primero borrar los formularios repetidos
            DB::statement('delete from formularios where 
                id_formulario not in (
                    select maximo from (
                        select max(id_formulario) as maximo
                        from formularios
                        group by nov
                    ) as t
                )');
            // crear llave unica
            $table->unique('NOV');
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
    }
}



