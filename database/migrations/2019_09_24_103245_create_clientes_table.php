<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->string('dui')->nullable(True);
            $table->string('direccion');
            $table->string('nombre_empresa')->nullable(True);
            $table->string('giro')->nullable(True);
            $table->string('nit')->nullable(True);
            $table->string('registro')->nullable(True);
            $table->string('telefono');
            $table->string('telefono2')->nullable(True);
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
        Schema::dropIfExists('clientes');
    }
}
