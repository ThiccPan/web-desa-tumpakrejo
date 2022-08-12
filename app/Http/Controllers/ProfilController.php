<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profils = Profil::all();
        $config = $this->configTxtOnly;
        return view('admin.profil.index',compact('profils','config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Profil $profil)
    {
        $config = $this->configTxtOnly;
        return view('admin.profil.edit',compact('profil','config')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profil $profil)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'gambar' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        if ($request->file('gambar')) {
            if (Storage::exists('post-images/' . $profil->gambar)) {
                Storage::delete('post-images/' . $profil->gambar);
            }
            $reqgambar = $request->file('gambar');
            $validated['gambar'] = $reqgambar->storePubliclyAs('post-images',time().'_'.$reqgambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = $profil->gambar;

        $profil->deskripsi = $validated['deskripsi'];
        $profil->gambar = $validated['gambar'];
        $profil->save();

        $request->session()->flash('msg',"Data potensi berhasil diubah");

        return redirect('/admin/profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
