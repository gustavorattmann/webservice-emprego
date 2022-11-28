<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/empresa/{id?}', [EmpresaController::class, 'consultar'])->where('id', '[0-9]+');
Route::post('/empresa/cadastro', [EmpresaController::class, 'cadastrar']);