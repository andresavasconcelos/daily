<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table = "projetos";

    protected $fillable = [
        "id", "nome", "descricao", "status"
    ];

//    public function eventosGaleria()
//    {
//        return $this->hasMany('App\EventoGaleria', "id_evento", "id")->limit(30);
//    }
}
