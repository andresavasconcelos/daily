<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticiaGaleria extends Model
{
    protected $table = "noticias_galeria";

    protected $fillable = [
        "id_noticia", "imagens"
    ];

    public function noticias()
    {
        return $this->belongsTo('App\Noticia', "id_noticia", "id");
    }
}
