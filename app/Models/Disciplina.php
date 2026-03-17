<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model
{
    protected $table = "disciplina"    ;

    protected $primaryKey = "id";

    public $timeStamp = true;

    use SoftDeletes;

    public function aula()
    {
        return $this->hasMany(Aula::class, "aula_disciplina");
    }

}
