<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;

class AulaController extends Controller
{
    

    public function list()
    {
        $list = Aula::all();

        return response()->json($list, 200);
    }

    public function searchForId($id)
    {
        $aula = Aula::find($id);

        if(!$aula)
            {
            return response()->json(["Erro" => "Aula nao encontrada"]);
            }
        return response()->json($aula, 200);
    }
    
    public function save(Request $request)
    {
        $createAula = Aula::create($request->all());

        return response()->json($createAula, 201);
    }

    public function update(Request $request, $id)
    {
        $aula = Aula::find($id);

        if(!$aula)
            {
            return response()->json(["Erro" => "Aula nao encontrada"], 404);
            }

        $aula->update($request->all());
        return response()->json($aula, 200);

    }

    public function delete($id)
    {
        $aula = Aula::find($id);
        if(!$aula)
            {
            return response()->json(["Erro" => "Aula nao encontrada"], 404);
            }

        $aula->delete();
        return response()->json(["mensagem" => "aula deletada"], 200);
    }
}
