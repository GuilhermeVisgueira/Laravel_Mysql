<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = "aluno";

    protected $primaryKey = "id";

    public $timestamp = false;

    public function AlunosToEscola ()
    {
        return $this->belongsTo(Escola::class, "aluno_escola");
    }
}
