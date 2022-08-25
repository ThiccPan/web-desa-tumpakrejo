<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Potensi;
use App\Models\Profil;
use App\Models\Program;

class FrontWebController extends Controller
{
    public function index()
    {
        $latestBerita = Berita::latest()->first();
        $latestPotensi = Potensi::latest()->first();
        $latestProgram = Program::latest()->first();

        return view('home', [
            "title" => "Home",
            'active' => "home",
            'berita' => $latestBerita,
            'potensi' => $latestPotensi,
            'program' => $latestProgram,
        ]);
    }
    
    public function about()
    {
        $sejarah = Profil::find(3);
        $img = $sejarah->gambar;
        $sejarah = $sejarah->deskripsi;

        $gambaran = Profil::find(2);
        $gambaran = $gambaran->deskripsi;
        return view('about', [
            "title" => "About",
            'active' => "about",
            "name" => "Desa Tumpakrejo",
            "email" => "aractorz123@gmail.com",
            "img" => $img,
            "sejarah" => $sejarah,
            "profil" => $gambaran
        ]);
    }
    
    public function visiMisi()
    {
        $visiMisi = Profil::find(1);
        return view('visi', [
            "title" => "About",
            'active' => "about",
            "name" => "Desa Tumpakrejo",
            "email" => "aractorz123@gmail.com",
            "img" => "img/baldes.jpeg",
            "visiMisi" => $visiMisi->deskripsi
        ]);
    }
}
