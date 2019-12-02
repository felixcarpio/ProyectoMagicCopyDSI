<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->integer('codigo')->unique();
            $table->string('descripcion')->nullable(True);
            $table->float('precio');
            $table->integer('existencias')->nullable(True);
            $table->float('precio_con_descuento')->nullable(True);
            $table->integer('marcas_id')->unsigned();
            $table->foreign('marcas_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->integer('categorias_id')->unsigned();
            $table->foreign('categorias_id')->references('id')->on('categorias_productos')->onDelete('cascade');
            $table->string('imagen')->nullable(True);
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
        Schema::dropIfExists('productos');
    }
}
