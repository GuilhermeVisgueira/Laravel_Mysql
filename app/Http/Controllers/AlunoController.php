<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;




class AlunoController extends Controller
{
    public function showAll()
    {
        $listAll = Aluno::all();
        return response()->json($listAll, 200);
    }

    public function searchForId($id)
    {
        $alunoId = Aluno::find($id);

        if(!$alunoId)
            {
                return response(())->json(["error" => "Id de aluno não encontrado"]);

            }
        return response()->json($alunoId,200);
    }

    public function save(Request $request)
    {
        $createAluno = Aluno::create($requeste->all());
        return response()->json($createAluno. 201);
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id);
        if(!$aluno)
            {
                return response()->json(["Error" => "Aluno não encontrado"],404);
            }
        $aluno->update()->json($aluno,200);
        return response()->json($aluno,200);
    }

    public function delete($id)
    {
        $aluno = Aluno::find($id);
        if(!$aluno)
            {
                return response()->json((["Erro"=>"Aluno não encontrado"],404));

            }
    }   $aluno->delete();
    return response()->json(["mensagem"=>"deletado com sucesso",200]);

}
