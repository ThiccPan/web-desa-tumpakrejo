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
        $potensis = Potensi::paginate(10);  

        if (request('search')) {
            $potensis = Potensi::where('judul', 'like', '%' . request('search') . '%')->paginate(10);
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
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
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
            $reqGambar = $request->file('gambar');
            $validated['gambar'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = '';

        Potensi::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
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
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
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
            $reqGambar = $request->file('gambar');
            $validated['gambar'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = $potensi->gambar;

        $potensi->judul = $validated['judul'];
        $potensi->deskripsi = $validated['deskripsi'];
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
