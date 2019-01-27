<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticiaEmpreendedorismo extends Model
{
    protected $table = "noticias_empreendedorismo";

    protected $fillable = [
        "id_categoria",
        "titulo",
        "alias",
        "resenha",
        "conteudo",
        "imagem",
        "is_featured"
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', "id_categoria", "id");
    }
}
