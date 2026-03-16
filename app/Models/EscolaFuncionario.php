<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscolaFuncionario extends Model
{
    protected $table = "escola_funcionario";
    
    protected $primaryKey ="id";

    public $timeStamp = true;

    public function escola()
    {
        return $this-> belongsTo(Escola:: class, "escola_id");
    }

    public function funcionario()
    {
        return $this-> belongsTo(Funcionario::class,"funcionario_id");
    }
}
 