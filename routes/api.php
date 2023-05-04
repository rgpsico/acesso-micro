<?php

use App\Http\Controllers\Api\AcessoControllerApi;
use App\Http\Controllers\Api\AlunoControllerApi;
use App\Http\Controllers\Api\ConfiguracaoControllerApi;
use App\Http\Controllers\Api\JustificativaControllerApi;
use App\Http\Controllers\AuthController;
use App\Models\ConfiguracaoLegado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('acesso')->group(function () {
    Route::post('addPermissao', [AcessoControllerApi::class, 'addpermissoes']);
    Route::post('bymatricula', [AcessoControllerApi::class, 'getByMatricula']);
    Route::post('byNome', [AcessoControllerApi::class, 'byNome']);
    Route::get('validacoes', [AcessoControllerApi::class, 'validacoes']);
    Route::post('removerPermissao', [AcessoControllerApi::class, 'removerPermissao']);
    Route::post('savejustificativa', [AcessoController::class, 'saveJustificativa']);
    Route::post('log', [AcessoControllerApi::class, 'logjustificativa']);
});


Route::prefix('justificativa')->group(function () {
    Route::post('store', [JustificativaControllerApi::class, 'store']);
});


Route::prefix('configuracao')->group(function () {
    Route::put('update', [ConfiguracaoControllerApi::class, 'updateConfiguracao']);
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'auth']);
});


Route::prefix('alunos')->group(function () {
    Route::get('byName', [AlunoControllerApi::class, 'byName']);
});


