<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\FuncionarioController;


class Funcionario extends Model
{
    protected $table = "funcionario";

    protected $primaryKey = "id";

    public $timeStamp = true;  

    use SoftDeletes;

    protected $fillable =
        [
            "nome",
            "pessoal",
            "funcao_id"
        ];

    public function escolaFuncionario ()
    {
        return $this-> hasMany(EscolaFuncionario::class, "funcionario_id");
    }

    public function funcao()
    {
        return $this-> belongsTo(Funcao:: class, "funcao_id");
    }

    public function aula()
    {
        return $this->hasMany(Aula::class,"funcionario_aula");
    }

}

