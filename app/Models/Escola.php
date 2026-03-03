<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    protected $table = "escola";

    protected $primaryKey = "id";

    public $timeStamp = false;

    public function EscolaToAluno()
    {
        return $this->hasMany (Aluno:: class, "aluno_escola");
    }
}
