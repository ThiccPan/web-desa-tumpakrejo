<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Models\Potensi;

class PotensiController extends Controller
{
    public function index(){
        $potensi = Potensi::latest()->filter(request(['search']))->paginate(7)->withQueryString();

        return view('artikel',[
            "title" => "Potensi Desa",
            "active" => 'artikel',
            "slug" => 'potensi',
            "posts" => $potensi
        ]);
    }

    public function show(Potensi $post){
        return view("artikel.potensi", [
            "title" => "Potensi",
            "active" => 'artikel',
            "post" => $post
        ]);
    }


}
