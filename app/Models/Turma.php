<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = "turma";

    protected $primaryKey = "id";

    public $timeStamp = true;

    public function escola()
    {
        return $this->belongsTo(Escola::class, "escola_id");
    }

    public function aluno()
    {
        return $this->hasMany(Aluno::class,"turma_aluno");
    }

    public function aula()
    {
        return $this-> belongsTo(Aula::class,"turma_aula");
    }
}
