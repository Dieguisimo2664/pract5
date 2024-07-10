<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();


Route::get('/shop', function () {
    return view('shop');
});

Route::get('/', [ProductController::class, 'viewProducts']);

Route::get('/{texto}', [ProductController::class, 'viewProducts']);

Route::get('/detail/{tunometecabrasaramambiche}', [ProductController::class, 'viewDetailP']);

