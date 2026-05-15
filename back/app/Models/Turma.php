<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\TurmaController;


class Turma extends Model
{
    protected $table = "turma";

    protected $primaryKey = "id";

    public $timeStamp = true;

    use SoftDeletes;

    protected $fillable =
        [
            "descricao",
            "escola_id",
            
        ];

    public function escola()
    {
        return $this->belongsTo(Escola::class, "escola_id");
    }

    public function aluno()
    {
        return $this->hasMany(Aluno::class,"turma_id");
    }

    public function aula()
    {
        return $this->hasMany(Aula::class,"turma_id");
    }
}
