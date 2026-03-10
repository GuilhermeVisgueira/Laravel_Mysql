<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = "aluno";

    protected $primaryKey = "id";

    public $timestamp = true;

    public function Escola ()
    {
        return $this->belongsTo(Escola::class, "aluno_escola");
    }

    public function Nota()
    {
        return $this-> hasMany(Nota::class, "nota_aluno");
    }
}
