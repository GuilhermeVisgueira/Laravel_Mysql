<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\EscolaFuncionarioController;

class EscolaFuncionario extends Model
{
    protected $table = "escola_funcionario";
    
    protected $primaryKey ="id";

    public $timeStamp = true;

    use SoftDeletes;

    protected $fillable =
        [
            "funcionario_id",
            "escola_id"
        ];

    public function escola()
    {
        return $this-> belongsTo(Escola:: class, "escola_id");
    }

    public function funcionario()
    {
        return $this-> belongsTo(Funcionario::class,"funcionario_id");
    }
}
 