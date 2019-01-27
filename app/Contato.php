<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = "contato";

    protected $fillable = [
        "nome",
        "email",
        "telefone",
        "celular",
        "assunto",
        "mensagem"
    ];
}
