<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssinaturaEnviada extends Model
{
    protected $table = "assinaturas_enviadas";

    protected $fillable = [
        "id_assinatura", "edicao", "enviado"
    ];

    public function assinaturas()
    {
        return $this->hasMany('App\Assinatura', 'id_assinstura', 'id');
    }

    public static function getEnvios($id_assinatura, $status = null)
    {
        if($status != null){
            $enviosAssinatura = AssinaturaEnviada::where('id_assinatura', $id_assinatura)->where('enviado', $status)->get();
        } else {
            $enviosAssinatura = AssinaturaEnviada::where('id_assinatura', $id_assinatura)->get();
        }

        return $enviosAssinatura;
    }
}
