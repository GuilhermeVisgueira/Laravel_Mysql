<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avaliacao extends Model
{
    protected $table = "avaliacao";

    protected $primaryKey = "id";

    public $timestamp = true;

    use SoftDeletes;

    public function nota()
    {
        return $this-> hasMany(Nota::class,"nota_avaliacao");

    }

    public function aula()
    {
        return $this-> belongsTo(Aula::class, "avaliacao_aula");
    }

}
