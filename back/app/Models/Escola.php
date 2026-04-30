<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\EscolaController;

class Escola extends Model
{
    protected $table = "escola";

    protected $primaryKey = "id";

    public $timeStamp = true;

    use SoftDeletes;

    // fillable serve para: mostra que campos eu posso ou nao alterar na requisição
    protected $fillable =
        [
            "nome_escola",
        ];

    
    public function aluno()
    {
        return $this->hasMany (Aluno:: class, "aluno_escola");
    }

    public function escolaFuncionario ()
    {
        return $this-> hasMany (Funcionario:: class, "escola_id");
    }

    public function turma()
    {
        return $this->hasMany(Turma::class, "turma_escola");
    }
}