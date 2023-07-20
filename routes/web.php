<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'age'])->group(function(){
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('posts/index', [PostController::class, 'index'])->name('posts.index');
    Route::get('post/{id}/show', [PostController::class, 'show'])->name('post.show');
    Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::post('post/{id}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('posts/listing', [PostController::class, 'listing'])->name('posts.listing');
});
Route::middleware(['admin', 'auth'])->group(function () {
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    
    Route::get('category/{id}/show', [CategoryController::class, 'show'])->name('category.show');
    Route::get('category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
});
Route::get('categories/index', [CategoryController::class, 'index'])->name('categories.index');


Route::get('test/create', [TestController::class, 'create'])->name('test.create');
Route::post('test/store', [TestController::class, 'store'])->name('test.store');
Route::get('tests/index', [TestController::class, 'index'])->name('test.index');