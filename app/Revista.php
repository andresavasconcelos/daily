<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revista extends Model
{
    protected $table = "revistas";

    protected $fillable = [
        "titulo", "alias", "descricao", "link", "imagem"
    ];

    public function materia()
    {
        return $this->hasMany('App\Materia', "id_revista", "id");
    }
}
