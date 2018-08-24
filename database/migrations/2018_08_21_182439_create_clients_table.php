<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('telefono', 20);
            $table->string('correo', 50)->unique()->nullable();
            $table->string('numero_documento', 20)->unique();
            $table->integer('id_tipoDocumento')->unsigned();
            $table->integer('id_rol')->unsigned();
            $table->timestamps();

             $table->foreign('id_tipoDocumento')->references('id')->on('document_types')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
