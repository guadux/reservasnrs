<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReservaTieneButacas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_tiene_butaca', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("id_reserva");
            $table->bigInteger("id_asiento");
            $table->timestamps();

            $table->foreign("id_reserva")->references("id")->on("reservas");
            $table->foreign("id_asiento")->references("id")->on("butacas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
