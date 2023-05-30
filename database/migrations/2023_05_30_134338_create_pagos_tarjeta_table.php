<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTarjetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_tarjeta', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente')->index();
            $table->string('email')->index();
            $table->string('procesador_pago');
            $table->integer('id_pago')->index();
            $table->float('monto');
            $table->string('estatus');
            $table->boolean('respuesta_webhook')->default(false);
            $table->json('metadata')->nullable();
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
        Schema::dropIfExists('pagos_tarjeta');
    }
}
