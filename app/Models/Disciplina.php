<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = "disciplina"    ;

    protected $primaryKey = "id";

    public $timeStamp = true;

    public function Aula()
    {
        return $this->hasMany(Aula::class, "aula_disciplina");
    }

}
