<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = "turma";

    protected $primaryKey = "id";

    public $timeStamp = true;

    public function Escola()
    {
        return $this->belongsTo(Escola::class, "escola_id");
    }

    public function Aluno()
    {
        return $this->hasMany(Aluno::class,"turma_aluno");
    }
}
