<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\AulaController;

class Aula extends Model
{
    protected $table = "aula";

    protected $primaryKey = "id";

    public $timestamp = true;

    use SoftDeletes;

    protected $fillable =
        [
            "disciplina_id",
            "funcionario_id",
            "turma_id"
        ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, "turma_id");
    }
    public function avaliacao()
    {
        return $this->hasMany(Avaliacao::class, "aula_id");
    }
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class,"disciplina_id");
    
    }
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class,"funcionario_id");
    }
}
