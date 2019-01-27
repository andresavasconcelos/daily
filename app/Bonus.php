<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = "bonus";

    protected $fillable = [
        "titulo", "alias", "descricao", "link"
    ];

}
