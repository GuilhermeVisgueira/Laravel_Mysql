<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $table = "funcao";
    
    protected $primaryKey ="id";

    public $timeStamp = true;
    
    public function Funcionario ()
    {
        return $this->hasMany(Funcionario::class, "funcao_id"); 
    }

}
