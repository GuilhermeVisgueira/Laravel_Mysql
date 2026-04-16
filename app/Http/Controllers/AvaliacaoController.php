<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Nota;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function list()
    {
        $av = Avaliacao::all();
        return response()->json($av, 200);
    }

    public function searchForId($id)
    {
        $av = Avaliacao::find($id);

        if(!$av)
            {
            return response()->json(["Erro" => "Avaliacao nao encontrada"],404);
            }
        return response()->json($av, 200);

    }

    public function save(Request $request)
    {
        $av = Avaliacao::create($request->all());

        return response()->json($request, 201);

    }

    public function update(Request $request, $id)
    {
        $av = Avaliacao::find($id);
        if(!$av)
            {
            return response()->json(["erro" => "avaliacao nao encontrada"],404);
            }
        $av->update($request->all());
        return response()->json($av, 200);
    }

    public function delete($id)
    {
        $av = Avaliacao::find($id);
        if(!$av)
            {
            return response()->json(["Erro" => "Avaliacao nao encontrada"], 404);
            }
        $av->delete();
        return response()->json(["Mensagem" => "deletado com sucesso"], 200);
    }
}
