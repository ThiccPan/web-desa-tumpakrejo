<?php

namespace App\Http\Controllers;

use App\Models\Berita;
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
        array_push($config['toolbar'][6][1],'picture');
        // dd($config['toolbar'][6][1]);
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
        
        $deskripsi = $request->deskripsi;
        // dd($deskripsi);

        $dom = new \domdocument();
        $dom->loadHtml($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // dd($dom);
        
        $deskripsiGambar = $dom->getElementsByTagName('img');
        // dd($deskripsiGambar);

        foreach($deskripsiGambar as $dGambar =>$img)
        {
            $data = $img->getattribute('src');
            // dd($data);
            
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
        
            $data = base64_decode($data);
            // dd($data);
            $image_name= time(). '_' . $dGambar.'.png';

            // dd($image_name);
            
            Storage::disk('local')->put('post-images/' . $image_name,$data);

            $img->removeattribute('src');
            $img->setattribute('src', asset('storage/' . $image_name));

        }

        $finaldesk = $dom->saveHtml();
        $validated['deskripsi'] = $finaldesk;

        if ($request->file('gambar')) {
            $reqGambar = $request->file('gambar');
            $validated['gambar'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = '';

        Berita::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'gambar' => $validated['gambar'],
            'penulis' => $validated['penulis']
        ]);

        $request->session()->flash('msg',"Data produk berhasil ditambahkan");

        return redirect('/admin/berita');        
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
        array_push($config['toolbar'][6][1],'picture');
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
