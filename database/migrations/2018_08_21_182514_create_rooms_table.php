<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_habitacion', 10)->unique();
            $table->integer('id_categoria')->unsigned();
            $table->integer('id_piso')->unisgned();
            $table->text('descripcion');
            $table->string('foto', 100)->unique();
            $table->boolean('disponible');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_piso')->references('id')->on('floors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('rooms');
    }

}
