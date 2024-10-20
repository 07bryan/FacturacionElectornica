<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuentoTable extends Migration
{
    public function up()
    {
        Schema::create('descuento', function (Blueprint $table) {
            $table->bigIncrements('id'); // AUTO_INCREMENT
            $table->bigInteger('id_categoria')->unsigned();
            $table->float('porcentaje');
            $table->dateTime('fecha_in');
            $table->dateTime('fecha_fin');

            $table->foreign('id_categoria')->references('id')->on('categoria_prod')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('descuento');
    }
}
