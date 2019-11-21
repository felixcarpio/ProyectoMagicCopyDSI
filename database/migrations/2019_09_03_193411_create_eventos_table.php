<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('codigo_clasificacion')->unsigned();
            $table->foreign('codigo_clasificacion')->references('id')->on('clasificaciones')->onDelete('cascade');
            $table->string('codigo', 6)->unique();
            $table->integer('cantidad_personas')->nullable(True);
            $table->string('descripcion');
            $table->date('fecha_evento');
            $table->string('lugar');
            $table->string('tema');
            $table->boolean('tarjetas');
            $table->boolean('mesa_boquitas');
            $table->boolean('centros_mesa');
            $table->boolean('arco_entrada');
            $table->boolean('recuerdos');
            $table->boolean('comida');
            $table->string('imagen')->nullable(True);
            $table->string('nombre_cliente');
            $table->string('correo');
            $table->string('num_telefono');
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
        Schema::dropIfExists('eventos');
    }
}
