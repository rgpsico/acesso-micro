<?php

use App\Http\Controllers\Api\AcessoControllerApi;
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
});
