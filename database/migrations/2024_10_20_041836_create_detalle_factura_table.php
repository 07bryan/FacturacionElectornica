<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFacturaTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->bigIncrements('id'); // AUTO_INCREMENT
            $table->bigInteger('id_factura')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->integer('cantidad');
            $table->decimal('precio_uni', 10, 2);
            $table->float('desc_aplic');

            $table->foreign('id_factura')->references('id_factura')->on('factura')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_factura');
    }
}

