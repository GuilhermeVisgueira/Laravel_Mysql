<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EscolaFuncionario;

class EscolaFuncionarioController extends Controller
{
    public function showAll()
    {
        $listAll = EscolaFuncionarioController::all();
        return response()->json($listAll, 200);
    }


}
