<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/registerPage', [UserController::class, 'showRegisterScreen']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//news routes
Route::get('/createPost', [PostController::class, 'showCreatePage']);
Route::post('/create-article', [PostController::class, 'createArticle']);
Route::get('/newsListings', [PostController::class, 'showNewsListings']);
Route::get('/edit-post/{article}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{article}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{article}', [PostController::class, 'deletePost']);
Route::get('/view-post/{article}', [PostController::class, 'showArticle']);

Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::delete('categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/landing/index', [PostController::class, 'landingIndex'])->name('landing.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/posts-by-category/{id}', [PostController::class, 'postsByCategory']);
Route::get('/view-post/{id}', [PostController::class, 'showArticle'])->name('view-post');
Route::post('/increment-views/{article}', [PostController::class, 'incrementViews'])->name('increment.views');
