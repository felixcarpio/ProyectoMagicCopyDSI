<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPedidoProducto extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('pedido_producto', function ($table) {
      $table->integer('cantidad_ordenada')->nullable(True);
      $table->float('costo_unitario',8,2)->nullable(True);
      $table->date('fecha_recibido')->nullable($value = true);
      $table->integer('existencias')->nullable(True);
      $table->integer('salidas')->default(0);
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('pedido_producto');
  }
}
