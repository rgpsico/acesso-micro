<?php

use App\Http\Controllers\Admin\AcessoController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function ()
{
    Route::prefix('acesso')->group(function () {
        Route::get('/', [AcessoController::class, 'index'])->name('acesso.index');
    });

    Route::prefix('config')->group(function () {
        Route::get('/', [ConfigController::class, 'index'])->name('config.index');
    });
});




Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::get('/loginMicro/{idweb}/{name}', [HomeController::class, 'loginMicro'])->name('loginMicro');



Route::get('logout', [AuthController::class, 'logout']);



Route::get('/executar-comando', function () {
    exec('C:\micro\micro.exe');
});

Route::get('/downloadMicro', function () {
    $filePath = public_path('download/microRequired.rar');
    return response()->download($filePath);
});


Auth::routes();



Auth::routes();


