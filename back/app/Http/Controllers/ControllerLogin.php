<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\JwtService;


class ControllerLogin extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user' => 'required|user',
            'senha' => 'required|string',
        ]);

        // verificaação se o user e a senha estao corretos
        // a utilização do auth::attempt faz uma verificação do usuario se esta correto no banco 
        if (!Auth::attempt($credentials))
            {
                return response()->json(['error' => 'usuario ou senha incorretos'], 401);
            }
        // Auth::user pega o usuario ja validado e passa as informações para a variavel $user
        $user = Auth::user();

        // apos passar os dados para a variavel user uso o metodo para gerar o token jwt
        $tokenUser = jwtService::generatorToken($user);

            
            

            return response()->json([
                'token' => $tokenUser,
                'token_type' => 'Bearer',
                'user' => $user->user_name,
                'senha' => $user->senha,
            ]);
    
    }
}