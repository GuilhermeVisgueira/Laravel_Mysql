<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\NotaController;


class Nota extends Model
{
    protected $table = "nota";

    protected $primaryKey = "id";

    public $timeStamp = true;

    use SoftDeletes;
    protected $fillable =
        [
            "aluno_id",
            "avaliacao_id"
        ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, "aluno_id");
    }

    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class, "nota_id");
    }
}
