<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscolaFuncionario extends Model
{
    protected $table = "escola_funcionario";
    
    protected $primaryKey ="id";

    public $timeStamp = true;

    public function Escola()
    {
        return $this-> belongsTo(Escola:: class, "escola_id");
    }

    public function Funcionario()
    {
        return $this-> hasMany(Funcionario::class,"funcionario_id");
    }
}
 