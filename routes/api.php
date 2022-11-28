<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\EmpregoController;

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

Route::get('/emprego/{id?}', [EmpregoController::class, 'consultar'])->where('id', '[0-9]+');
Route::post('/emprego/cadastro', [EmpregoController::class, 'cadastrar']);