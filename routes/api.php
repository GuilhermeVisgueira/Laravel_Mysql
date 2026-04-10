<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\TurmaController;
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

Route::get("/turma", [TurmaController::class, "showAll"]);
Route::get("/turma/{id}", [TurmaController::class, "searchForId"]);
Route::post("/turma", [TurmaController::class, "save"]);
Route::put("/turma", [TurmaController::class, "update"]);
Route::delete("/turma", [TurmaController::class, "delete"]);

//Rotas Aluno:

Route::get("/alunos", [AlunoController::class, "showAll"]);
Route::get("/aluno/{id}", [AlunoController::class, "searchForId"]);
Route::post("/aluno", [AlunoController::class, "save"]);
Route::put("/aluno", [AlunoController::class, "update"]);
Route::delete("/aluno", [AlunoController::class, "delete"]);
