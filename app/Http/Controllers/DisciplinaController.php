<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function showAll()
    {
        $list = Disciplina::all();
        return response()->json($list, 200);
    }


    public function searchForId($id)
    {
        $list = Disciplina::find($id);
        if(!$list)
            {
            return response()->json(["Erro" => "Disciplina nao encontrada"], 404);
            }
        return response()->json($list, 200);
    }   

    public function save(Request $request)
    {
        $dicisplina = Disciplina::create($request->all());

        return response()->json($dicisplina, 201);
    }

    public function update(Request $request, $id)
    {
        $disciplina = Disciplina::find($id);

        if(!$disciplina)
            {
            return response()->json(["Erro" => "Disciplina nao encontrada"], 404);
            }

        $disciplina->update($request->all());
        return response()->json($disciplina, 200);

    }

    public function delete($id)
    {
        $disciplina = Disciplina::find($id);

        if(!$disciplina)
            {
            return response()->json(["Erro" => "Disciplina nao encontrada"],404);
            }

        $disciplina->delete();
        return response()->json(["Mensagem" => "Disciplina deletada com sucesso"], 200);
    }

}
