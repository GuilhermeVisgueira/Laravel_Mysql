<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EscolaFuncionario;

class EscolaFuncionarioController extends Controller
{
    public function showAll()
    {
        $listAll = EscolaFuncionario::all();
        return response()->json($listAll, 200);
    }

    public function searchForId($id)
    {
        $EFuncionarioId = EscolaFuncionario::find($id);
        
        if(!$EFuncionarioId)
            {
               return response()->json(["Erro" => "Id de Escola_funcionario não encontrado",404]);
            }
        return response()->json($EFuncionarioId, 200);
    }

    public function save(Request $request)
    {
        $createEFuncionario = EscolaFuncionario::create($request->all());
        return response()->json($createEFuncionario, 201);
    }

    public function update(Request $request, $id)
    {
        $EFuncionario = EscolaFuncionario::find($id);
        if(!$EFuncionario)
            {
                return response()->json(["Erro" => "Escola_Funcionario não encontrado", 404]);
            }
        $EFuncionario->update($request->all());
        return response()->json($EFuncionario, 200);
    }

    public function delete($id)
    {
        $EFuncionario = EscolaFuncionario::find($id);
        if(!$EFuncionario)
            {
                return response()->json(["Erro" => "Escola_funcionario nao encontrado", 404]);
            }
        $EFuncionario->delete();
        return response()->json(["Mensagem" => "Escola_funcionario deletado", 200]);
    }

}
