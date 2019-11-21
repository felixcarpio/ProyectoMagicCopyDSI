<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('estado_reserva_id')->unsigned()->nullable(True);
            $table->foreign('estado_reserva_id')->references('id')->on('estado_reserva')->onDelete('cascade');
            $table->string('codigo_reserva', 6)->unique()->nullable(True);
            $table->string('nombre')->nullable(True);
            $table->date('fecha_solicitud')->nullable(True);
            $table->date('fecha_vencimiento')->nullable(True);
            $table->string('correo_comprador')->nullable(True);
            $table->string('telefono_reserva')->nullable(True);
            $table->date('fecha_reclamo')->nullable(True);
            $table->float('precio_sin_descuento')->nullable(True);
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
        Schema::dropIfExists('reservas');
    }
}
