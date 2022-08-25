<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(){
        $produks = Produk::latest()->filter(request(['search']))->paginate(7)->withQueryString();

        return view('artikel',[
            "title" => "Produk Desa",
            "active" => 'artikel',
            "slug" => 'produk',
            "posts" => $produks
        ]);
    }

    public function show(Produk $post){
        return view("artikel.produk", [
            "title" => "Produk",
            "active" => 'artikel',
            "post" => $post
        ]);
    }
}
