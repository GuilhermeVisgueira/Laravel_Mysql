<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    protected $table = "escola";

    protected $primaryKey = "id";

    public $timeStamp = true;

    
    public function Aluno()
    {
        return $this->hasMany (Aluno:: class, "aluno_escola");
    }

    public function EscolaFuncionario (): HasMany
    {
        return $this-> hasMany (Funcionario:: class, "escola_id");
    }

    public function Turma()
    {
        return $this->hasMany(Turma::class, "turma_escola");
    }
}