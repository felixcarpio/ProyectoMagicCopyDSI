<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pedido_producto_id')->unsigned();
            $table->foreign('pedido_producto_id')->references('id')->on('pedido_producto');
            $table->bigInteger('salida_id')->unsigned();
            $table->foreign('salida_id')->references('id')->on('salidas')->onDelete('cascade');
            $table->double('total', 8, 2);
            $table->double('total_con_descuento', 8, 2)->nullable(True);
            $table->integer('cantidad_vendida');
            $table->integer('existencias')->nullable(True);
            $table->string('comentario',1000)->nullable(True); 
            $table->double('costo')->nullable(True);
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
        Schema::dropIfExists('detalles');
    }
}
