<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('estado');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->double('arrendamiento',8,2)->nullable();
            $table->double('reparacionfc',8,2)->nullable();
            $table->double('reparacionpc',8,2)->nullable();
            $table->double('total',8,2)->nullable();
            $table->string('comentario')->nullable();
            $table->integer('maquina_id')->unsigned();
            $table->foreign('maquina_id')->references('id')->on('maquinas')->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
