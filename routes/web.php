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

Route::middleware(['auth'])->group(function(){

  Route::get('/admin', function(){
    return view('admin.dashboard');
  });
  
  Route::get('/admin/posts', [PostsController::class,'index']);
  
  Route::get('/admin/posts/create', [PostsController::class,'create']);
  
  Route::post('/admin/posts/insert', [PostsController::class,'store']);
  
  Route::get('/admin/posts/{id}', [PostsController::class,'show']);
  
  Route::get('/admin/posts/{id}/edit', [PostsController::class,'edit']);
  
  Route::put('/admin/posts/{id}/update', [PostsController::class,'update']);
  
  Route::delete('/admin/posts/{id}/destroy',[PostsController::class, 'destroy']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
