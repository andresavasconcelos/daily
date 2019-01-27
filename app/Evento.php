<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = "eventos";

    protected $fillable = [
        "titulo", "alias", "resenha", "texto", "data", "hora", "imagem", "link", "is_featured"
    ];

    public function eventosGaleria()
    {
        return $this->hasMany('App\EventoGaleria', "id_evento", "id")->limit(30);
    }
}
