<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [
        "name",
        "email",
        "password",
        "confirmPass",
        "cpf",
        "cnpj",
        "celular",
        "telefone",
        "numero",
        "address",
        "cep",
        "complemento",
        "referencia",
        "estado",
        "bairro",
        "cidade",
        "politica"
    ];

    public function assinatura()
    {
        return $this->hasMany('App\Assinatura', "id_cliente", "id");
    }

    /**
     * @param $fields
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */

    public function validator($fields)
    {
        $rules = [
            "name"     => "required",
            "email"    => "email|required|unique:clientes",
            "password" => "required|confirmed",
            "celular"  => "required",
            "telefone" => "required",
            "numero"   => "required",
            "address"  => "required",
            "cep"      => "required",
            "estado"   => "required",
            "bairro"   => "required",
            "cidade"   => "required"
        ];

        $msgs = [
            "name.required"     => "Preencha o campo Nome",
            "email.required"    => "Preencha o campo Email",
            "email.email"       => "O campo email deve conter um email válido",
            "email.unique"      => "Este email já possui uma assinatura",
            "password.required" => "Preencha o campo senha",
            "password.confirmed" => "Os campos de senha não conferem",
            "celular.required"   => "Preencha o campo celular",
            "telefone.required"  => "Preencha o campo telefone",
            "numero.required"   => "Preencha o campo Número",
            "address.required"  => "Preencha o campo Endereço",
            "cep.required"      => "Preencha o campo CEP",
            "estado.required"   => "Preencha o campo Estado",
            "bairro.required"   => "Preencha o campo Bairro",
            "cidade.required"   => "Preencha o campo Cidade",
        ];

        $validator = Validator::make($rules, $msgs, $fields);

        return $validator;

    }

}
