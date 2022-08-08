<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::with('gambar')->paginate(10);
        return view('admin.album.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'slug' => '',
            'sampul' => 'nullable',
            'keterangan' => 'required|max:50'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        if ($request->file('sampul')) {
            $reqGambar = $request->file('sampul');
            $validated['sampul'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = '';

        Album::create([
            'nama' => $validated['nama'],
            'keterangan' => $validated['keterangan'],
            'sampul' => $validated['sampul'],
        ]);

        $request->session()->flash('msg',"Data album berhasil ditambahkan");

        return redirect('/admin/album');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('admin.album.edit',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $album = Album::find($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'slug' => '',
            'sampul' => 'nullable',
            'keterangan' => 'nullable|max:50'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        if ($request->file('sampul')) {
            if (Storage::exists('post-images/' . $album->sampul)) {
                Storage::delete('post-images/' . $album->sampul);
            }
            $reqGambar = $request->file('sampul');
            $validated['sampul'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = $album->sampul;

        $album->nama = $validated['nama'];
        $album->keterangan = $validated['keterangan'];
        $album->sampul = $validated['sampul'];
        $album->save();

        $request->session()->flash('msg',"Data album berhasil ditambahkan");

        return redirect('/admin/album');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);        
        if (Storage::exists('post-images/' . $album->sampul)) {
            Storage::delete('post-images/' . $album->sampul);
        } else {
            dd('file not found');
        }
        $album->delete();
        return redirect('/admin/album');
        
    }
}
