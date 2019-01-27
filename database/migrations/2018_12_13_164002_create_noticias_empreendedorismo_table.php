<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasEmpreendedorismoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias_empreendedorismo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('alias');
            $table->string('resenha');
            $table->longText('conteudo');
            $table->longText('imagem');
            $table->integer('is_featured')->nullable();
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
        Schema::dropIfExists('noticias_empreendedorismo');
    }
}
