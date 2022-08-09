<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GambarController;
use Illuminate\Support\Facades\Route;
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
  Route::get('/admin/berita',[BeritaController::class,'index']);
  Route::get('/admin/berita/create',[BeritaController::class,'create']);
  Route::post('/admin/berita/store',[BeritaController::class,'store']);
  Route::get('/admin/berita/{berita}',[BeritaController::class,'show']);
  Route::get('/admin/berita/{berita}/edit',[BeritaController::class,'edit']);

  // potensi route
  Route::resource('/admin/potensi', PotensiController::class);

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
  
  // Album route
  Route::get('/admin/album', [AlbumController::class,'index']);
  Route::get('/admin/album/create', [AlbumController::class,'create']);
  Route::post('/admin/album/store', [AlbumController::class,'store']);
  Route::get('/admin/album/{album}/edit', [AlbumController::class,'edit']);
  Route::put('/admin/album/{id}/update', [AlbumController::class,'update']);
  Route::delete('/admin/album/{id}/destroy', [AlbumController::class,'destroy']);

  Route::post('/admin/album/{album}/store', [GambarController::class,'store']);
  Route::get('/admin/album/{album}', [GambarController::class,'show']);
  Route::get('/admin/album/{album}/create', [GambarController::class,'create']);
  Route::get('/admin/album/{album}/{gambar}', [GambarController::class,'edit']);
  Route::delete('/admin/album/destroy/{gambar}', [GambarController::class,'destroy']);
  Route::put('/admin/album/update/{gambar}', [GambarController::class,'update']);
  
  // Gambar route
  // Route::resource('/admin/gambar', GambarController::class);

  Route::get('/admin/gambar', [GambarController::class,'index']);
  // Route::get('/admin/gambar/{NIP}', [GambarController::class,'show']);
});

Auth::routes(['register'=>false]);  

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');