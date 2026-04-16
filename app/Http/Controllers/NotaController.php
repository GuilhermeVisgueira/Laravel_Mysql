<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    public function list()
    {
        $nota = Nota::all();
        return response()->json($nota, 200);
    }

    public function searchForId($id)
    {
        $nota = Nota::find($id);
        if(!$nota)
            {
            return response()->json(["Erro" => "Nota nao encontrada"],404);
            }
        return response()->json($nota, 200);
    }

    public function save(Request $request)
    {
        $nota = Nota::create($request->all());

        return response()->json($nota, 201);
    }

    public function update(Request $request, $id)
    {
        $nota = Nota::find($id);
        if(!$nota)
            {
            return response()->json(["Erro" => "nota nao encontrada"], 404);
            }

        $nota->update($request->all());
        return response()->json($nota, 200);
    }

    public function delete($id)
    {
        $nota = Nota::find($id);
        if(!$nota)
            {
            return response()->json(["Erro" => "Nota nao encontrada"], 404);
            }
        $nota->delete();
        return response()->json(["Mensagem" => "Nota deletada"]);
    }
}
