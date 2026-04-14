<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\AlunoController;

class Aluno extends Model
{
    protected $table = "aluno";

    protected $primaryKey = "id";

    public $timestamp = true;

    use SoftDeletes;

    protected $fillable =
        [
            "nome",
            "matricula",
            "aluno_escola"
        ];

    public function escola ()
    {
        return $this->belongsTo(Escola::class, "aluno_escola");
    }

    public function nota()
    {
        return $this->hasMany(Nota::class, "nota_aluno");
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, "aluno_turma");
    }
    
}
