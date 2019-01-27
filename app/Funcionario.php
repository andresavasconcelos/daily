<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionarios";

    protected $fillable = [
        "id", "id_funcionario", "nome", "observacao", "id_projeto", "tarefa", "observacao", "status"
    ];

//    public function noticiasGaleria()
//    {
//        return $this->hasMany('App\NoticiaGaleria', "id_noticia", "id");
//    }
}
