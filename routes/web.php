<?php

use App\Http\Controllers\Admin\AcessoController;
use App\Http\Controllers\Admin\ConfigController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::prefix('acesso')->group(function () {
        Route::get('/', [AcessoController::class, 'index'])->name('acesso.index');

    });

    Route::prefix('config')->group(function () {
        Route::get('/', [ConfigController::class, 'index'])->name('config.index');

    });
});


Route::get('/executar-comando', function () {
    exec('C:\Users\barbara.MU\Downloads\Debug\nseUSB2E2S3121.exe');
  });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
