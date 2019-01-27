<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoGaleria extends Model
{
    protected $table = "eventos_galeria";

    protected $fillable = [
        "id_evento", "imagem"
    ];

    public function eventos()
    {
        return $this->belongsTo('App\Evento', "id_evento", "id");
    }
}
