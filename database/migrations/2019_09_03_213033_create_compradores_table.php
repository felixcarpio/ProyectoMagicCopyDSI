<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compradores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',256);
            $table->string('email',256)->nullable(True);
            $table->string('nit',256)->nullable(True);
            $table->string('dui',9)->nullable(True);
            $table->string('telefono',8)->nullable(True);
            $table->string('cuenta')->nullable(True);
            $table->string('direccion')->nullable(True);
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
        Schema::dropIfExists('compradores');
    }
}
