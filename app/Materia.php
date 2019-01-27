<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = "materias";

    protected $fillable = [
        "id_revista", "titulo", "alias", "resenha",
        "conteudo", "imagem", "is_featured", "status"
    ];

    public function revista()
    {
        return $this->belongsTo('App\Revista', "id_revista", "id");
    }
}
