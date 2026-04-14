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
            "nota_aluno",
            "nota_avaliacao"
        ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, "nota_aluno");
    }

    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class, "nota_avaliacao");
    }
}
