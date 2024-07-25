<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();

Route::get('/', [ProductController::class, 'viewProducts']);
Route::get('/home', [ProductController::class, 'viewProducts']);

Route::get('/{texto}', [ProductController::class, 'viewProducts']);

Route::get('/home{texto}', [ProductController::class, 'viewProducts']);

Route::get('/detail/{tunometecabrasaramambiche}', [ProductController::class, 'viewDetailP']);

Route::get('/home/detail/{tunometecabrasaramambiche}', [ProductController::class, 'viewDetailP']);



Route::post('/saveProd', [CartController::class, 'saveProductIntoCart2'])->name('saveProd');

Route::post('/gotopay', [CartController::class, 'goToPayCart'])->name('gotopay');

