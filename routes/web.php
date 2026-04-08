<?php

use App\Http\Controllers\EscolaController;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//Rotas Escola:

Route::get('/escolas', [EscolaController::class, 'showAll']);
Route::get('/escolas/{id}', [EscolaController::class, 'searchForId']);
Route::post('/escolas', [EscolaController::class, 'save']);
Route::put('/escolas', [EscolaController::class, 'update']);
Route::delete('/escolas', [EscolaController::class, 'delete']);

//Rotas Escola_funcionario
Route::get('/escola_funcionario', [FuncionarioController::class, '']);

//Rotas Turma:

