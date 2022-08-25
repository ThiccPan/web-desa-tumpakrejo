<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
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
        $config = $this->configTxtOnly;
        return view('admin.potensi.create',compact('config'));
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
            'sampul' => 'nullable',
            'penulis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        if ($request->file('sampul')) {
            $reqsampul = $request->file('sampul');
            $validated['sampul'] = $reqsampul->storePubliclyAs('post-images',time().'_'.$reqsampul->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = '';

        $potensi = Potensi::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'sampul' => $validated['sampul'],
            'penulis' => $validated['penulis']
        ]);

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

                $potensi->gambar()->save($gambarTambah);
            }

        } 

        $request->session()->flash('msg',"Data potensi berhasil ditambahkan");

        return redirect('/admin/potensi');
    }

    public function storeImages(Request $request, Potensi $potensi)
    {
        // dd($program);
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

                $potensi->gambar()->save($gambarTambah);
            }


        } else ddd();


        $request->session()->flash('msg',"Data album berhasil ditambahkan");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $potensi
     * @return \Illuminate\Http\Response
     */
    public function show(Potensi $potensi)
    {
        // dd($potensi);
        return view('admin.potensi.view',compact("potensi"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Potensi  $potensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Potensi $potensi)
    {
        $config = $this->configTxtOnly;
        // dd($potensi->gambar);
        return view('admin.potensi.edit', compact('potensi','config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Potensi $potensi)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'slug' => '',
            'sampul' => 'nullable',
            'penulis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        if ($request->file('sampul')) {
            if (Storage::exists('post-images/' . $potensi->sampul)) {
                Storage::delete('post-images/' . $potensi->sampul);
            }
            $reqsampul = $request->file('sampul');
            $validated['sampul'] = $reqsampul->storePubliclyAs('post-images',time().'_'.$reqsampul->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = $potensi->sampul;

        $potensi->judul = $validated['judul'];
        $potensi->deskripsi = $validated['deskripsi'];
        $potensi->sampul = $validated['sampul'];
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
    public function destroy(Potensi $potensi)
    {    
        foreach ($potensi->gambar as $gambar) {
            if (Storage::exists('post-images/' . $gambar->gambar)) {
                Storage::delete('post-images/' . $gambar->gambar);
            } 
            // else {
            //     dd('file not found aaaaa');
            // }
        }
        $potensi->gambar()->delete();
        if (Storage::exists('post-images/' . $potensi->sampul)) {
            Storage::delete('post-images/' . $potensi->sampul);
        } else {
            dd('file not found');
        }
        $potensi->delete();
        return redirect('/admin/potensi');
    }
}
