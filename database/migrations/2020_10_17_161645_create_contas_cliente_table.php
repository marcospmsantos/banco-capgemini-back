<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_cliente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id');
            $table->foreignId('conta_id');
            $table->foreignId('agencia_id');
            $table->unique(['cliente_id', 'conta_id', 'agencia_id'], 'uk_agencia_conta_cliente');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('conta_id')->references('id')->on('contas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('agencia_id')->references('id')->on('agencias')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas_cliente');
    }
}
