<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = "noticias";

    protected $fillable = [
        "id_categoria", "titulo", "alias", "resenha", "descricao", "imagem", "is_featured", "status"
    ];

    public function noticiasGaleria()
    {
        return $this->hasMany('App\NoticiaGaleria', "id_noticia", "id");
    }
}
