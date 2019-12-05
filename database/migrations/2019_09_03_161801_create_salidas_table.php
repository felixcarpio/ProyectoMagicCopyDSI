<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
            $table->date('fecha_emision');
            $table->double('total', 8, 2);
            $table->double('total_iva', 8, 2)->nullable(True);
            $table->double('costo')->nullable(True);
            $table->string('comentario',1000)->nullable(True);
            $table->string('correlativo_factura')->nullable(True);
            $table->string('tipo_factura')->nullable(True);
            $table->string('promocion')->nullable(True);
            $table->string('cantidad_promociones')->nullable(True);
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
        Schema::dropIfExists('salidas');
    }
}
