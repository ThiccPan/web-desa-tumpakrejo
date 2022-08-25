<?php

namespace App\Http\Controllers\Display;

use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Models\Gambar;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('albums', [
            'title' => 'Galeri',
            'active' => 'galeri',
            'name' => 'Desa Tumpakrejo',
            'albums' => Album::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $gambars = $album->load('gambar');
        return view('album', [
            'title' => 'Galeri',
            'active' => 'galeri',
            'name' => 'Desa Tumpakrejo',
            'judul' => $album->nama,
            'gambars' => $gambars
        ]);
    }
}
