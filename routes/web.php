<?php

use App\Http\Controllers\Admin\AcessoController;
use App\Http\Controllers\Admin\ConfigController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::prefix('acesso')->group(function () {
        Route::get('/', [AcessoController::class, 'index'])->name('acesso.index');
    });
    Route::prefix('config')->group(function () {
        Route::get('/', [ConfigController::class, 'index'])->name('config.index');
    });
});


Route::get('/executar-comando', function () {
    exec('C:\micro\micro.exe');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
