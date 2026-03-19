<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\FuncaoController;

class Funcao extends Model
{
    protected $table = "funcao";
    
    protected $primaryKey ="id";

    public $timeStamp = true;

    use SoftDeletes;
    
    public function funcionario ()
    {
        return $this->hasMany(Funcionario::class, "funcao_id"); 
    }

}
