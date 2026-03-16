<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionario";

    protected $primaryKey = "id";

    public $timeStamp = true;  

    

    public function escolaFuncionario ()
    {
        return $this-> hasMany(Professor::class, "professor_id");
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

