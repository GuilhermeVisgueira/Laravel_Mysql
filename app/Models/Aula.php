<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = "aula";

    protected $primaryKey = "id";

    public $timestamp = true;

    public function turma()
    {
        return $this->hasMany(Turma::class, "turma_aula");
    }
    public function avaliacao()
    {
        return $this->hasMany(Avaliacao::class, "avaliacao_aula");
    }
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class,"aula_disciplina");
    
    }
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class,"funcionario_aula");
    }
}
