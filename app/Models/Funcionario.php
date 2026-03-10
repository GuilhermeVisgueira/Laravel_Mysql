<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionario";

    protected $primaryKey = "id";

    public $timeStamp = true;  

    

    public function EscolaFuncionario ()
    {
        return $this-> hasMany(Professor::class, "professor_id");
    }

    public function Funcao()
    {
        return $this-> belongsTo(Funcao:: class, "funcao_id");
    }

    public function Aula()
    {
        return $this->hasMany(Aula::class,"funcionario_aula");
    }

}

