<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categorias";

    protected $fillable = [
        "titulo", "alias", "status"
    ];

    public function noticiaEmpreendedorismo()
    {
        return $this->hasMany('App\NoticiaEmpreendedorismo', "id_categoria", "id");
    }

    public static function getNoticias($id_categoria)
    {
        $noticias = NoticiaEmpreendedorismo::where('id_categoria', $id_categoria)->orderBy('id', 'DESC')->limit(3)->get();

        return $noticias;
    }
}
