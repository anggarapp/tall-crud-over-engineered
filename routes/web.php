<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Route::get('test', [PostController::class, 'test']);

Route::prefix('posts')->name('posts')->group(
    function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
    }
);

Route::prefix('images')->name('images')->group(
    function () {
        Route::get('/', [ImageController::class, 'index'])->name('index');
    }
);

Route::prefix('tags')->name('tags')->group(
    function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
    }
);
