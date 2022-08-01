<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PengurusController;

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

  // produk route
  Route::get('/admin/produk', [ProdukController::class,'index']);
  Route::get('/admin/produk/create', [ProdukController::class,'create']);
  Route::post('/admin/produk/store', [ProdukController::class,'store']);
  Route::get('/admin/produk/{slug}', [ProdukController::class,'show']);
  Route::get('/admin/produk/{slug}/edit', [ProdukController::class,'edit']);
  Route::put('/admin/produk/{slug}/update', [ProdukController::class,'update']);
  Route::delete('/admin/produk/{slug}/destroy', [ProdukController::class,'destroy']);

  // program route
  Route::get('/admin/program', [ProgramController::class,'index']);
  Route::get('/admin/program/create', [ProgramController::class,'create']);
  Route::post('/admin/program/store', [ProgramController::class,'store']);
  Route::get('/admin/program/{slug}', [ProgramController::class,'show']);
  Route::get('/admin/program/{slug}/edit', [ProgramController::class,'edit']);
  Route::put('/admin/program/{slug}/update', [ProgramController::class,'update']);
  Route::delete('/admin/program/{slug}/destroy', [ProgramController::class,'destroy']);
  
  // pengurus route
  Route::get('/admin/pengurus', [PengurusController::class,'index']);
  Route::get('/admin/pengurus/create', [PengurusController::class,'create']);
  Route::post('/admin/pengurus/store', [PengurusController::class,'store']);
  Route::get('/admin/pengurus/{NIP}', [PengurusController::class,'show']);
  Route::get('/admin/pengurus/{NIP}/edit', [PengurusController::class,'edit']);
  Route::put('/admin/pengurus/{NIP}/update', [PengurusController::class,'update']);
  Route::delete('/admin/pengurus/{NIP}/destroy', [PengurusController::class,'destroy']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
