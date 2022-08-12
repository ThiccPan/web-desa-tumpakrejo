<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GambarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfilController;

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
  Route::put('/admin/berita/{berita}/update',[BeritaController::class,'update']);
  Route::delete('/admin/berita/{berita}/destroy',[BeritaController::class,'destroy']);
  Route::post('/admin/berita/{berita}/gambar/tambah',[BeritaController::class,'storeImages']);

  // potensi route
  Route::get('/admin/potensi', [PotensiController::class,'index']);
  Route::get('/admin/potensi/create', [PotensiController::class,'create']);
  Route::post('/admin/potensi/store', [PotensiController::class,'store']);
  Route::get('/admin/potensi/{potensi}', [PotensiController::class,'show']);
  Route::get('/admin/potensi/{potensi}/edit', [PotensiController::class,'edit']);
  Route::put('/admin/potensi/{potensi}/update', [PotensiController::class,'update']);
  Route::delete('/admin/potensi/{potensi}/destroy', [PotensiController::class,'destroy']);
  Route::post('/admin/potensi/{potensi}/gambar/tambah', [PotensiController::class,'storeImages']);

  // produk route
  Route::get('/admin/produk', [ProdukController::class,'index']);
  Route::get('/admin/produk/create', [ProdukController::class,'create']);
  Route::post('/admin/produk/store', [ProdukController::class,'store']);
  Route::get('/admin/produk/{produk}', [ProdukController::class,'show']);
  Route::get('/admin/produk/{produk}/edit', [ProdukController::class,'edit']);
  Route::put('/admin/produk/{produk}/update', [ProdukController::class,'update']);
  Route::delete('/admin/produk/{produk}/destroy', [ProdukController::class,'destroy']);
  Route::post('/admin/produk/{produk}/gambar/tambah', [ProdukController::class,'storeImages']);

  // program route
  Route::get('/admin/program', [ProgramController::class,'index']);
  Route::get('/admin/program/create', [ProgramController::class,'create']);
  Route::post('/admin/program/store', [ProgramController::class,'store']);
  Route::get('/admin/program/{program}', [ProgramController::class,'show']);
  Route::get('/admin/program/{program}/edit', [ProgramController::class,'edit']);
  Route::put('/admin/program/{program}/update', [ProgramController::class,'update']);
  Route::delete('/admin/program/{program}/destroy', [ProgramController::class,'destroy']);
  Route::post('/admin/program/{program}/gambar/tambah', [ProgramController::class,'storeImages']);
  
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
  Route::put('/admin/album/{album}/update', [AlbumController::class,'update']);
  Route::delete('/admin/album/{album}/destroy', [AlbumController::class,'destroy']);

  Route::post('/admin/album/{album}/store', [GambarController::class,'store']);
  Route::get('/admin/album/{album}', [GambarController::class,'show']);
  Route::get('/admin/album/{album}/create', [GambarController::class,'create']);
  Route::get('/admin/album/{album}/{gambar}', [GambarController::class,'edit']);
  Route::delete('/admin/destroy/{gambar}', [GambarController::class,'destroy']);
  Route::put('/admin/album/update/{gambar}', [GambarController::class,'update']);
  
  // Gambar route
  Route::get('/admin/gambar', [GambarController::class,'index']);

  // Profil route
  Route::get('/admin/profil', [ProfilController::class,'index']);
  Route::get('/admin/profil/{profil}', [ProfilController::class,'edit']);
  Route::put('/admin/profil/{profil}/update', [ProfilController::class,'update']);
});

Auth::routes(['register'=>false]);  

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');