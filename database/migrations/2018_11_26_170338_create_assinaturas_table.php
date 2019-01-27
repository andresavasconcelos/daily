<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssinaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_produto');
            $table->integer('id_cliente');
            $table->string('data_efetivacao')->nullable();
            $table->string('data_expiracao')->nullable();
            $table->string('codigo_assinatura');
            $table->integer('status');
            $table->integer('situacao');
            $table->integer('eletronico');
            $table->integer('impresso');
            $table->string('token_transaction');
            $table->string('url_boleto');
            $table->string('paymentMethod');
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
        Schema::dropIfExists('assinaturas');
    }
}
