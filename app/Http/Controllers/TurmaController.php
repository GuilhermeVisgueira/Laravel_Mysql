<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;

class TurmaController extends Controller
{
    public function showAll()
    {
        $listTurma = Turma::all();
        return response()->json($listTurma, 200);
    }

    public function searchForId($id)
    {
        $turmaId = Turma::find($id);
        //validação do id com o if, se nao tiver o id ele entra no if e retorna id nao encontrado
        //se true entra, se false nao entra no if
        if (!$turmaId) {
            return response()->json(["Erro" => "Id da turma não encontrado"], 404);
        }
        return response()->json($turmaId, 200);
    }

    public function save(Request $request)
    {
        $createTurma = Turma::create($request->all());
        return response()->json($createTurma, 201);
    }

    public function update(Request $request, $id)
    {
        $turma = Turma::find($id);
        if (!$turma) 
        {
            return response()->json(["Error" => "Turma não encontrada"], 404);
        }
        $turma->update($request->all());
        return response()->json($turma, 200);
    }

    public function delete($id)
    {
        $turma = Turma::find($id);
        if (!$turma) 
        {
            return response()->json(["Erro" => "Turma não encontrada"], 404);
        }
        $turma->delete();
        return response()->json(["mensagem" => "deletado com sucesso", 200]);
    }

}
