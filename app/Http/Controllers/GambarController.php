<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Album $album)
    {
        return view('admin.gambar.create',compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Album $album)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'gambars' => 'required',
            'keterangan' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        // dd($validated);

        if ($request->file('gambars')) {
            $reqGambar = $request->file('gambars');
            // ddd($reqGambar);

            foreach ($reqGambar as $gambar) {
                $validated['gambar'] = $gambar->storePubliclyAs('post-images',time().'_'.$gambar->getClientOriginalName());
                $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
                $validated['keterangan'] = null;

                // ddd($validated);
                
                $gambarTambah = new Gambar();
                $gambarTambah->gambar = $validated['gambar'];
                $gambarTambah->keterangan = $validated['keterangan'];

                $album->gambar()->save($gambarTambah);
            }


        } else ddd();


        $request->session()->flash('msg',"Data album berhasil ditambahkan");

        return redirect('/admin/album/' . $album->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $gambar_album = $album->load('gambar');
        return view('admin.gambar.view',compact('gambar_album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album, Gambar $gambar)
    {
        // ddd($album,$gambar_nama);
        return view('admin.gambar.edit',compact('album','gambar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gambar $gambar)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'image',
            'keterangan' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        // dd($validated);

        if ($request->file('gambar')) 
        {
            if (Storage::exists('post-images/' . $gambar->gambar)) {
                Storage::delete('post-images/' . $gambar->gambar);
            }
            $reqGambar = $request->file('gambar');
            // ddd($reqGambar);
            $gambar->gambar = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $gambar->gambar = Str::of($gambar->gambar)->after('post-images/');

        }
        $gambar->keterangan = $validated['keterangan'];
        $gambar->save();

        $request->session()->flash('msg',"Data gambar berhasil ditambahkan");

        return redirect('admin/album/');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gambar $gambar)
    {
        if (Storage::exists('post-images/' . $gambar->gambar)) {
            Storage::delete('post-images/' . $gambar->gambar);
        }

        $gambar->delete();
        return redirect()->back();
    }
}
