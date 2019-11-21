<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoPromocionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_promocion', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->bigInteger('promocion_id')->unsigned();
            $table->foreign('promocion_id')->references('id')->on('promociones')->onDelete('cascade');
            
            $table->integer('cantidad'); 
            $table->float('precio_unitario');
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
        Schema::dropIfExists('producto_promocion');
    }
}
