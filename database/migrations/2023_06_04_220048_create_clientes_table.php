<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cliente', 199);
            $table->string('identificacion', 199)->nullable();
            $table->string('zona', 199)->nullable();
            $table->text('detalles')->nullable();
            $table->text('extras')->nullable();
            $table->string('email', 199)->nullable();
            $table->string('telefono', 199);
            $table->string('domicilio', 199);
            $table->string('numero', 199)->nullable();
            $table->string('colonia', 199)->nullable();
            $table->string('tecnico', 199)->nullable();
            $table->integer('ipseg')->nullable();
            $table->integer('ip')->nullable();
            $table->string('ap', 199)->nullable();
            $table->string('tipocone', 199)->nullable();
            $table->string('fechinsta', 199)->nullable();
            $table->string('fecha', 199)->nullable();
            $table->integer('corte')->nullable();
            $table->string('contrato', 199)->nullable();
            $table->string('mensual', 199)->nullable();
            $table->string('serie', 199)->nullable();
            $table->string('cable', 199)->nullable();
            $table->string('mbps', 199)->nullable();
            $table->string('dbi', 199)->nullable();
            $table->string('status', 199);
            $table->integer('deudor')->nullable();
            $table->string('clave', 199)->nullable();
            $table->integer('reporte')->nullable();
            $table->integer('prepago')->nullable();
            $table->string('coordenadas', 199)->nullable();
            $table->string('ultimocut', 199)->nullable();
            $table->text('adeudo')->nullable();
            $table->string('comment', 199)->nullable();
            $table->datetime('actualizado')->nullable();
            $table->integer('asignado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
