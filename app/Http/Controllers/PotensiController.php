<?php

namespace App\Http\Controllers;

use App\Models\Potensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PotensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $potensis = Potensi::paginate(2);  

        if (request('search')) {
            $potensis = Potensi::where('judul_potensi', 'like', '%' . request('search') . '%')->paginate(2);
        }

        return view('admin.potensi.index',compact('potensis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.potensi.create');
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
            'judul_potensi' => 'required|max:255',
            'konten' => 'required',
            'slug' => '',
            'gambar' => 'nullable',
            'penulis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        if ($request->file('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('post-images');
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = '';

        Potensi::create([
            'judul_potensi' => $validated['judul_potensi'],
            'konten' => $validated['konten'],
            'gambar' => $validated['gambar'],
            'penulis' => $validated['penulis']
        ]);

        $request->session()->flash('msg',"Data potensi berhasil ditambahkan");

        return redirect('/admin/potensi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $potensis = Potensi::where('slug',$slug)->first();
        return view('admin.potensi.view',compact("potensis"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $potensi = Potensi::where('slug',$slug)->first();
        return view('admin.potensi.edit', compact('potensi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $potensi = Potensi::where('slug',$slug)->first();

        $validator = Validator::make($request->all(), [
            'judul_potensi' => 'required|max:255',
            'konten' => 'required',
            'slug' => '',
            'gambar' => 'nullable',
            'penulis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        if ($request->file('gambar')) {
            if (Storage::exists('post-images/' . $potensi->gambar)) {
                Storage::delete('post-images/' . $potensi->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('post-images');
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = $potensi->gambar;

        $potensi->judul_potensi = $validated['judul_potensi'];
        $potensi->konten = $validated['konten'];
        $potensi->gambar = $validated['gambar'];
        $potensi->penulis = $validated['penulis'];
        $potensi->save();

        $request->session()->flash('msg',"Data potensi berhasil diubah");

        return redirect('/admin/potensi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $potensi = Potensi::where('slug',$slug)->first(); 
        
        if (Storage::exists('post-images/' . $potensi->gambar)) {
            Storage::delete('post-images/' . $potensi->gambar);
        } else {
            dd('file not found');
        }
        $potensi->delete();
        return redirect('/admin/potensi');
    }
}
