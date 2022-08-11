<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd(public_path());
        $produks = Produk::paginate(10);  

        if (request('search')) {
            $produks = Produk::where('judul', 'like', '%' . request('search') . '%')->paginate(10);
        }

        return view('admin.produk.index',compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = $this->configTxtOnly;

        return view('admin.produk.create',compact('config'));
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
            'tanggal' => 'required',
            'penulis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();
        
        $deskripsi = $request->deskripsi;
        $dom = new \domdocument();
        $dom->loadHtml($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $finaldesk = $dom->saveHtml();
        $validated['deskripsi'] = $finaldesk;

        if ($request->file('sampul')) {
            $reqGambar = $request->file('sampul');
            $validated['sampul'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = '';

        $produk = Produk::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'sampul' => $validated['sampul'],
            'tanggal' => $validated['tanggal'],
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

                $produk->gambar()->save($gambarTambah);
            }

        } 

        $request->session()->flash('msg',"Data produk berhasil ditambahkan");

        return redirect('/admin/produk');
    }

    public function storeImages(Request $request, Produk $produk)
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

                $produk->gambar()->save($gambarTambah);
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
    public function show($slug)
    {
        $produk = Produk::where('slug',$slug)->first();
        return view('admin.produk.view',compact("produk"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $config = $this->configTxtOnly;
        $produk = Produk::where('slug',$slug)->first();
        return view('admin.produk.edit',compact("produk","config"));
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
        $produk = Produk::where('slug',$slug)->first(   );

        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'slug' => '',
            'sampul' => 'nullable',
            'tanggal' => 'required',
            'penulis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                     ->back()
                     ->withErrors($validator)
                     ->withInput();
        }

        $validated = $validator->validated();

        $deskripsi = $request->deskripsi;
        $dom = new \domdocument();
        $dom->loadHtml($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $finaldesk = $dom->saveHtml();
        $validated['deskripsi'] = $finaldesk;

        if ($request->file('sampul')) {
            if (Storage::exists('post-images/' . $produk->sampul)) {
                Storage::delete('post-images/' . $produk->sampul);
            }
            $reqGambar = $request->file('sampul');
            $validated['sampul'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = $produk->sampul;

        $produk->judul = $validated['judul'];
        $produk->deskripsi = $validated['deskripsi'];
        $produk->sampul = $validated['sampul'];
        $produk->tanggal = $validated['tanggal'];
        $produk->penulis = $validated['penulis'];
        $produk->save();

        $request->session()->flash('msg',"Data produk berhasil diubah");

        return redirect('/admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        foreach ($produk->gambar as $gambar) {
            // dd($gambar->gambar);
            if (Storage::exists('post-images/' . $gambar->gambar)) {
                Storage::delete('post-images/' . $gambar->gambar);
            } else {
                // dd('file not found aaaaa');
            } 
        }
        $produk->gambar()->delete();
        if (Storage::exists('post-images/' . $produk->sampul)) {
            Storage::delete('post-images/' . $produk->sampul);
        }
        $produk->delete();
        return redirect('/admin/produk');
    }
}
