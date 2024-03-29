<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PostController::class, 'index'])->name('blog.index');

Route::get('post/index', [PostController::class, 'index'])->name('post.index');
Route::get('post/search', [PostController::class, 'search'])->name('post.search');
Route::get('post/create', [PostController::class, 'create'])->name('post.create');
Route::post('post/store', [PostController::class, 'store'])->name('post.store');
Route::get('post/show/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
Route::patch('post/update/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('post/delete/{post}', [PostController::class, 'delete'])->name('post.delete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
