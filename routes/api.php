<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EscolaController;

//para cada controller se deve ter uma linha de comando relacionada ao ep que quero utilizar



//Rotas Escola:
//Get
//saber oq faz esse name
Route::get('/escolas', 'showAll')->name('orders.index');

