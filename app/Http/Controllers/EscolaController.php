<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escola;

class EscolaController extends Controller
{
   // fazer o crud que tem as funções que seram usadas no api.php

  // get request, take all the datas
   public function seeAll()
   {
      $seeAll = Escola::all();
      return response()->json($seeAll, 200);
   }


  // get request, using id to search
  public function searchForId($id)
  {
    $lookId = Escola::find($id);
    // no caso simulando um id que nao tem no banco e ele sendo 99(nao tem) ele entra na expressao condicional e retorna false, ja que foi usado ! vai inverter
    // assim retornando true e entrando no if
    if(!$lookId)
      {
        return response()->json(["erro" => "Id de escola não encontrado"],404);
      }
    // se nao ira sair do if e entrar no return assim mandando o padrao
    return response()->json($lookId,200);
  }

  //post request nas escolas. sugestoes de rota /api/escola/create
  public function safe(Request $request)
  {
    $createSchool = Escola::create($request->all());
    // retorna uma resposta de confirmação da criação do banco
    return response()-> json($createSchool,201);

  }

  // update data 

  public function update (Request $request, $id)
  {
    $escola = Escola::find($id);

    if(!$escola)
      {
        return response()->json(["Erro"=> "Escola não encontrada"],404);
      }
    $escola->update($request->all());

    return response()->json($escola,200);
  }

  public function delete($id)
  {
    $escola = Escola::find($id);
    if(!$escola)
      {
        return response()->json(["Erro" =>"Escola não encontrada"],404);
      }

    $escola->delete();
    return response()->json(["mensagem" => "deletado com sucesso", 200]);
  }

//pesquisar do request, objeto no php

}
