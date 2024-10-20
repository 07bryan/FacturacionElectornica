<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionTable extends Migration
{
    public function up()
    {
        Schema::create('promocion', function (Blueprint $table) {
            $table->bigIncrements('id_promocion'); // AUTO_INCREMENT
            $table->text('descripcion');
            $table->bigInteger('id_producto')->unsigned();
            $table->dateTime('fecha_in');
            $table->dateTime('fecha_fin');

            $table->foreign('id_producto')->references('id')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promocion');
    }
}

