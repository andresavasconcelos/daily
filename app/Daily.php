<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    protected $table = "dailies";

    protected $fillable = [
       "id", "id_daily", "data", "id_funcionario", "id_projeto",
        "tarefa", "observacao", "atividade"
    ];

    public function funcionarios()
    {
        return $this->hasMany('App\Funcionario', "id", "id_funcionario");
    }
    public function projetos()
    {
        return $this->hasMany('App\Projeto', "id", "id_projeto");
    }
}
