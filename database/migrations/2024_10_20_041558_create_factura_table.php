<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaTable extends Migration
{
    public function up()
    {
        /*Schema::create('factura', function (Blueprint $table) {
            $table->bigIncrements('id_factura')->unsigned();
            $table->dateTime('fecha');
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('ced_usuario'); // Asegúrate de que sea `unsigned`
            $table->unsignedBigInteger('ced_cliente'); // Asegúrate de que sea `unsigned`

            // Clave foránea
            $table->foreign('ced_usuario')->references('cedula')->on('usuario')->onDelete('cascade');
            // Puedes agregar otras claves foráneas aquí si es necesario
        });*/
    }

    public function down()
    {
        Schema::dropIfExists('factura');
    }
}



