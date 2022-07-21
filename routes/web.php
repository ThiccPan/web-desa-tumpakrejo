<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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

Route::get('/', [PostsController::class,'index']);

Route::get('/posts', [PostsController::class,'index']);

Route::get('/posts/create', [PostsController::class,'create']);

Route::post('/posts/insert', [PostsController::class,'store']);

Route::get('/posts/{id}/edit', [PostsController::class,'edit']);

Route::put('/posts/{id}', [PostsController::class,'update']);

Route::delete('/posts/{id}',[PostsController::class, 'destroy']);