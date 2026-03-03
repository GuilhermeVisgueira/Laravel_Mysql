<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = "nota";

    protected $primaryKey = "id";

    public $timeStamp = false;
}
