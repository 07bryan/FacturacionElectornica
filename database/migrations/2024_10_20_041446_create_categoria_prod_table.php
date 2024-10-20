<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaProdTable extends Migration
{
    public function up()
    {
        Schema::create('categoria_prod', function (Blueprint $table) {
            $table->bigIncrements('id'); // AUTO_INCREMENT
            $table->string('nombre_cat', 50);
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoria_prod');
    }
}
