<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function showAll()
    {
        $list = Funcionario::all();
        return response()->json($list, 200);
    }

    public function searchForId($id)
    {
        $list = Funcionario::all($id);

        if(!$list)
            {
                return response()->json(["erro" => "Id de funcionario nao encontrado"]);
            }
        return response()->json($list, 200);
    }

    public function save(Request $request)
    {
        $createFuncionario = Funcionario::create($request->all());

        return response()->json($createFuncionario, 201);
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::find($id);

        if(!$funcionario)
            {
            return response()->json(["Erro" => "Funcionario nao encontrado"]);
            }
        $funcionario->updated($request->all());
        return response()->json($funcionario, 200);
    }

    public function delete($id)
    {
        $funcionario = Funcionario::find($id);

        if(!$funcionario)
            {
                return response()->json(["Erro"=>"Funcionario nao encontrado"]);
            }

        $funcionario->delete();
        return response()->json(["mensagem"=>"Funcionario deletado com sucesso"]);
    }


}
