<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Models\Berita;


class BeritaController extends Controller
{
    public function index(){
        $berita = Berita::latest()->filter(request(['search']))->paginate(7)->withQueryString();
        // $berita = Berita::find();
        // $shortDesc = strip_tags($berita->deskripsi);
        // $shortDesc = substr($shortDesc,0,10);
        // ddd($shortDesc);

        return view('artikel',[
            "title" => "Berita",
            "active" => "berita",
            "slug" => 'berita',
            "posts" => $berita
        ]);
    }

    public function show(Berita $post){
        return view("berita", [
            "title" => "Berita",
            "active" => 'berita',
            "post" => $post
        ]);
    }
}
