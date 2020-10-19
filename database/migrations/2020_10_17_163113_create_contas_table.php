<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 20);
            $table->decimal('saldo', 14, 2)->default(0.00);
            $table->decimal('limite_saque', 14, 2)->nullable();
            $table->foreignId('tipo_conta_id');
            $table->foreignId('situacao_conta_id');
            $table->timestamps();
            $table->foreign('tipo_conta_id')->references('id')->on('tipo_conta')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('situacao_conta_id')->references('id')->on('situacao_conta')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
