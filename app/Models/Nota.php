<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = "nota";

    protected $primaryKey = "id";

    public $timeStamp = true;

    public function Aluno()
    {
        return $this->belongsTo(Aluno::class, "nota_aluno");
    }

    public function Avaliacao()
    {
        return $this->belongsTo(Avaliacao::class, "nota_avaliacao");
    }
}
