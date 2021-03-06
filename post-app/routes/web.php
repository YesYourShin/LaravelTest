<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/posts/create', [PostsController::class, 'create'])/*->middleware(['auth'])*/;
Route::post('/posts/store', [PostsController::class, 'store'])->name('posts')/*->middleware(['auth'])*/;
Route::get('/posts/index', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/myposts', [PostsController::class, 'myposts'])->name('posts.myposts');

Route::get('/posts/show/{id}', [PostsController::class, 'show'])->name('post.show');
Route::get('/posts/{post}', [PostsController::class, 'edit'])->name('post.edit');
Route::put('/posts/{id}', [PostsController::class, 'update'])->name('post.update');
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('post.delete');

Route::get('/char/index', [ChartController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
