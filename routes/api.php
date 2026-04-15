<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\EscolaFuncionarioController;
use App\Http\Controllers\FuncaoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\TurmaController;
use App\Models\Disciplina;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//Rotas Escola:

Route::get('/escolas', [EscolaController::class, 'showAll']);
Route::get('/escolas/{id}', [EscolaController::class, 'searchForId']);
Route::post('/escolas', [EscolaController::class, 'save']);
Route::put('/escolas/{id}', [EscolaController::class, 'update']);
Route::delete('/escolas/{id}', [EscolaController::class, 'delete']);

//Rotas Turma:

Route::get("/turma", [TurmaController::class, "showAll"]);
Route::get("/turma/{id}", [TurmaController::class, "searchForId"]);
Route::post("/turma", [TurmaController::class, "save"]);
Route::put("/turma/{id}", [TurmaController::class, "update"]);
Route::delete("/turma/{id}", [TurmaController::class, "delete"]);

//Rotas Aluno:

Route::get("/aluno", [AlunoController::class, "showAll"]);
Route::get("/aluno/{id}", [AlunoController::class, "searchForId"]);
Route::post("/aluno", [AlunoController::class, "save"]);
Route::put("/aluno/{id}", [AlunoController::class, "update"]);
Route::delete("/aluno/{id}", [AlunoController::class, "delete"]);

//Rotas Escola_funcionario:

Route::get("/Escola_Funcionario", [EscolaFuncionarioController::class, "showAll"]);
Route::get("/Escola_Funcionario/{id}", [EscolaFuncionarioController::class, "searchForId"]);
Route::post("/Escola_Funcionario", [EscolaFuncionarioController::class, "save"]);
Route::put("/Escola_Funcionario/{id}", [EscolaFuncionarioController::class, "save"]);
Route::delete("/Escola_Funcionario/{id}", [EscolaFuncionarioController::class, "delete"]);

//Rotas funcionario:
Route::get('/funcionario', [FuncionarioController::class, 'showAll']);
Route::get("/funcionario/{id}", [FuncionarioController::class, "searchForId"]);
Route::post("/funcionario", [FuncionarioController::class, "save"]);
Route::put("/funcionario/{id}", [FuncionarioController::class, "update"]);
Route::delete("/funcionario/{id}", [FuncionarioController::class, "delete"]);

//Rotas Funcao:
Route::get("/funcao", [FuncaoController::class, "showAll"]);
Route::get("/funcao/{id}", [FuncaoController::class, "searchForId"]);
Route::post("/funcao", [FuncaoController::class, "save"]);
Route::put("/funcao/{id}", [FuncaoController::class, "update"]);
Route::delete("/funcao/{id}", [FuncaoController::class, "delete"]);

//Rotas Aula:
Route::get("/aula", [AulaController::class, "showAll"]);
Route::get("/aula/{id}", [AulaController::class, "searchForId"]);
Route::post("/aula", [AulaController::class, "save"]);
Route::put("/aula/{id}", [AulaController::class, "update"]);
Route::delete("/aula/{id}", [AulaController::class, "delete"]);

//Rotas Disciplinas:

Route::get("/disciplina", [Disciplina::class, "showAll"]);
Route::get("/disciplina/{id}", [Disciplina::class, "searchForId"]);
Route::post("/disciplina", [Disciplina::class, "save"]);
Route::put("/disciplina/{id}", [Disciplina::class, "update"]);
Route::delete("/disciplina/{id}", [Disciplina::class, "delete"]);