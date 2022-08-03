<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurus = Pengurus::paginate(10);

        if (request('search')) {
            $pengurus = Pengurus::where('judul', 'like', '%' . request('search') . '%')->paginate(10);
        }

        // dd($pengurus);

        return view('admin.pengurus.index',compact('pengurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengurus.create');
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
            'NIP' => 'required|distinct',
            'jabatan' => 'required',
            'nama' => 'required',
            'tanggal_menjabat' => 'required',
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
            $reqGambar = $request->file('gambar');
            $validated['gambar'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = '';

        Pengurus::create([
            'NIP' => $validated['NIP'],
            'jabatan' => $validated['jabatan'],
            'nama' => $validated['nama'],
            'tanggal_menjabat' => $validated['tanggal_menjabat'],
            'gambar' => $validated['gambar']
        ]);

        $request->session()->flash('msg',"Data program berhasil ditambahkan");

        return redirect('/admin/pengurus');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $NIP
     * @return \Illuminate\Http\Response
     */
    public function show($NIP)
    {
        $pengurus = Pengurus::find($NIP);
        return view('admin.pengurus.view',compact('pengurus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($NIP)
    {
        $pengurus = Pengurus::find($NIP);
        return view('admin.pengurus.edit',compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $NIM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $NIP)
    {
        $pengurus = Pengurus::find($NIP);

        $validator = Validator::make($request->all(), [
            'NIP' => 'required|distinct',
            'jabatan' => 'required',
            'nama' => 'required',
            'tanggal_menjabat' => 'required',
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
            $reqGambar = $request->file('gambar');
            $validated['gambar'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = $pengurus->gambar;

        $pengurus->NIP = $validated['NIP'];
        $pengurus->jabatan = $validated['jabatan'];
        $pengurus->nama = $validated['nama'];
        $pengurus->tanggal_menjabat = $validated['tanggal_menjabat'];
        $pengurus->gambar = $validated['gambar'];

        $request->session()->flash('msg',"Data pengurus berhasil ditambahkan");

        return redirect('/admin/pengurus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($NIP)
    {
        $pengurus = Pengurus::find($NIP);

        if (Storage::exists('post-images/' . $pengurus->gambar)) {
            Storage::delete('post-images/' . $pengurus->gambar);
        }

        $pengurus->delete();
        return redirect('/admin/potensi');
    }
}
