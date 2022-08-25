<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beritas = Berita::paginate(10);  

        if (request('search')) {
            $beritas = Berita::where('judul', 'like', '%' . request('search') . '%')->paginate(10);
        }

        return view('admin.berita.index',compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = $this->configTxtOnly;
        return view('admin.berita.create',compact('config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

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
            $reqGambar = $request->file('sampul');
            $validated['sampul'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = '';

        $berita = Berita::create([
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

                $berita->gambar()->save($gambarTambah);
            }

        } 

        $request->session()->flash('msg',"Data Berita berhasil ditambahkan");

        return redirect('/admin/berita/');        
    }

    public function storeImages(Request $request, Berita $berita)
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

                $berita->gambar()->save($gambarTambah);
            }


        } else ddd();


        $request->session()->flash('msg',"Data album berhasil ditambahkan");

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        return view('admin.berita.view',compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        $config = $this->configTxtOnly;
        return view('admin.berita.edit',compact('berita','config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        // dd($request);

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
        
        // dd($deskripsi);

        if ($request->file('sampul')) {
            if (Storage::exists('post-images/' . $berita->sampul)) {
                Storage::delete('post-images/' . $berita->sampul);
            }
            $reqGambar = $request->file('sampul');
            $validated['sampul'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
            $berita->sampul = $validated['sampul'];
        }else $validated['sampul'] = $berita->sampul;
        
        $berita->judul = $validated['judul'];
        $berita->deskripsi = $validated['deskripsi'];
        $berita->sampul = $validated['sampul'];
        $berita->penulis = $validated['penulis'];
        $berita->save();
        
        $request->session()->flash('msg',"Data berita berhasil ditambahkan");

        return redirect('/admin/berita');          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        foreach ($berita->gambar as $gambar) {
            if (Storage::exists('post-images/' . $gambar->gambar)) {
                Storage::delete('post-images/' . $gambar->gambar);
            } 
            // else {
            //     dd('file not found aaaaa');
            // }
        }
        $berita->gambar()->delete();
        if (Storage::exists('post-images/' . $berita->sampul)) {
            Storage::delete('post-images/' . $berita->sampul);
        } else {
            dd('file not found');
        }
        $berita->delete();
        return redirect('/admin/berita');
    }
}
