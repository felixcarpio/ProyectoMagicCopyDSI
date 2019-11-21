<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntidadSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad_salida', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('entidad_id')->unsigned();
            $table->foreign('entidad_id')->references('id')->on('entidades')->onDelete('cascade');
            
            $table->bigInteger('salida_id')->unsigned();
            $table->foreign('salida_id')->references('id')->on('salidas')->onDelete('cascade');

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
        Schema::dropIfExists('entidad_salida');
    }
}
