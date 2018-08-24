<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('inicio');
            $table->timestamp('fin');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_habitacion')->unnsigned();
            $table->float('precioT')->unsigned();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_habitacion')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reservations');
    }

}
