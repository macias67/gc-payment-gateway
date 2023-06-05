<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente');
            $table->datetime('fecha');
            $table->integer('monto')->nullable();
            $table->string('ticket', 199)->nullable();
            $table->string('referencia', 199)->nullable();
            $table->unsignedInteger('banco')->nullable();
            $table->string('corresponde', 199)->nullable();
            $table->string('tecnico', 199)->nullable();
            $table->text('motivo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
