<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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
    return view('auth.login');
});

Route::get('/dashboard', [PostController::class, "view_all_post"])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/post/create', [PostController::class, "create_a_post"])->middleware(['auth', 'verified'])->name("post.create");
Route::get('/post/edit/{id}', [PostController::class, "edit_a_post"])->middleware(['auth', 'verified'])->name("post.edit");
Route::post('/post/update/{id}', [PostController::class, "update_a_post"])->middleware(['auth', 'verified'])->name("post.update");
Route::get('/post/update/{id}', [PostController::class, "delete_a_post"])->middleware(['auth', 'verified'])->name("post.delete");

// api route

Route::middleware('cors')->group(function () {
    Route::get('/posts', [PostController::class, "get_posts"])->name('get.posts');
    Route::get('/post/{id}',[PostController::class, "get_post"])->name('get.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
