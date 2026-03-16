<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = "avaliacao";

    protected $primaryKey = "id";

    public $timestamp = true;

    public function nota()
    {
        return $this-> hasMany(Nota::class,"nota_avaliacao");

    }

    public function aula()
    {
        return $this-> belongsTo(Aula::class, "avaliacao_aula");
    }

}
