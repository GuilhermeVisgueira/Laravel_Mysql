<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcao;

class FuncaoController extends Controller
{

    public function list()
    {
        $list = Funcao::all();
        return response()->json($list, 200);
    }

    public function searchForId($id)
    {
        $funcao = Funcao::find($id);

        if(!$funcao)
            {
            return response()->json(["Error" => "Funcao não encontrada"]);
            }
        return response()->json($funcao, 200);
    }

    public function save(Request $request)
    {
        $createFuncao = Funcao::create($request->all());

        return response()->json($createFuncao, 201);
    }

    public function update(Request $request, $id)
    {
        $funcao = Funcao::find($id);

        if(!$funcao)
            {
            return response()->json(["Erro" => "Funcao nao encontrada"],404);
            
            }

        $funcao->update($request->all());
        return response()->json($funcao, 200);
    }

    public function delete($id)
    {
        $funcao = Funcao::find($id);
        if(!$funcao)
            {
            return response()->json(["Erro" => "Funcao nao encontrada"],404);
            }
        $funcao->delete();
        return response()->json(["Mensagem" => "Funcao deletada com sucesso"],200);
    }

}
