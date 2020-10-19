<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor', 14, 2);
            $table->foreignId('tipo_transacao_id');
            $table->foreignId('situacao_transacao_id');
            $table->foreignId('conta_destino_id')->nullable();
            $table->foreignId('conta_origem_id')->nullable();
            $table->timestamps();
            $table->foreign('tipo_transacao_id')->references('id')->on('tipo_transacao')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('conta_origem_id')->references('id')->on('contas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('conta_destino_id')->references('id')->on('contas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('situacao_transacao_id')->references('id')->on('situacao_transacao')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacoes');
    }
}
