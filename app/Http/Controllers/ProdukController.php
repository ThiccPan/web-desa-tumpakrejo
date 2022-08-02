<?php

namespace App\Http\Controllers;

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
        return view('admin.produk.create');
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
            'gambar' => 'nullable',
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

        // 
        $deskripsi = $request->deskripsi;
        $dom = new \domdocument();
        $dom->loadHtml($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $finaldesk = $dom->saveHtml();
        $validated['deskripsi'] = $finaldesk;

        if ($request->file('gambar')) {
            $reqGambar = $request->file('gambar');
            $validated['gambar'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = '';

        Produk::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'gambar' => $validated['gambar'],
            'tanggal' => $validated['tanggal'],
            'penulis' => $validated['penulis']
        ]);

        $request->session()->flash('msg',"Data produk berhasil ditambahkan");

        return redirect('/admin/produk');
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
        $produk = Produk::where('slug',$slug)->first();
        return view('admin.produk.edit',compact("produk"));
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
            'gambar' => 'nullable',
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

        if ($request->file('gambar')) {
            if (Storage::exists('post-images/' . $produk->gambar)) {
                Storage::delete('post-images/' . $produk->gambar);
            }
            $reqGambar = $request->file('gambar');
            $validated['gambar'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = $produk->gambar;

        $produk->judul = $validated['judul'];
        $produk->deskripsi = $validated['deskripsi'];
        $produk->gambar = $validated['gambar'];
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
    public function destroy($slug)
    {
        $produk = Produk::where('slug',$slug)->first(); 
        
        if (Storage::exists('post-images/' . $produk->gambar)) {
            Storage::delete('post-images/' . $produk->gambar);
        }
        $produk->delete();
        return redirect('/admin/produk');
    }
}
