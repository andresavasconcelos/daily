<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produtos";

    protected $fillable = [
        "code",
        "nome",
        "preco_inicial",
        "desconto",
        "valor",
        "vigencia",
        "status",
        "thumb"
    ];

    public function assinaturas()
    {
        return $this->hasMany('App\Assinatura', 'id_produto', 'id');
    }
}
