<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/css/{filename}', function ($filename) {
    $cssPath = resource_path('css/' . $filename);
    
    if (File::exists($cssPath)) {
        $cssContent = File::get($cssPath);
        return Response::make($cssContent, 200, [
            'Content-Type' => 'text/css'
        ]);
    } else {
        abort(404);
    }
});


Route::get('/js/{filename}', function ($filename) {
    $jsPath = resource_path('js/' . $filename);
    
    if (File::exists($jsPath)) {
        $jsContent = File::get($jsPath);
        return Response::make($jsContent, 200, [
            'Content-Type' => 'text/js'
        ]);
    } else {
        abort(404);
    }
});


Auth::routes();


Route::get('/shop', function () {
    return view('shop');
});

Route::get('/', [ProductController::class, 'viewProducts']);

Route::get('/{texto}', [ProductController::class, 'viewProducts']);

