<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PotensiController;

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

  // dashboard
  Route::get('/admin', function(){
    return view('admin.dashboard');
  });
  
  // posts route
  Route::get('/admin/posts', [PostsController::class,'index']);
  
  Route::get('/admin/posts/create', [PostsController::class,'create']);
  
  Route::post('/admin/posts/insert', [PostsController::class,'store']);
  
  Route::get('/admin/posts/{id}', [PostsController::class,'show']);
  
  Route::get('/admin/posts/{id}/edit', [PostsController::class,'edit']);
  
  Route::put('/admin/posts/{id}/update', [PostsController::class,'update']);
  
  Route::delete('/admin/posts/{id}/destroy',[PostsController::class, 'destroy']);

  // potensi route
  Route::get('/admin/potensi', [PotensiController::class,'index']);

  Route::get('/admin/potensi/create', [PotensiController::class,'create']);

  Route::post('/admin/potensi/store', [PotensiController::class,'store']);

  Route::get('/admin/potensi/{slug}', [PotensiController::class,'show']);

  Route::get('/admin/potensi/{slug}/edit', [PotensiController::class,'edit']);

  Route::put('/admin/potensi/{slug}/update', [PotensiController::class,'update']);

  Route::delete('/admin/potensi/{slug}/destroy', [PotensiController::class,'destroy']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
