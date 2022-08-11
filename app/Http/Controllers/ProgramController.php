<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::with('gambar')->paginate('10');

        if (request('search')) {
            $programs = Program::where('judul', 'like', '%' . request('search') . '%')->paginate(10);
        }

        return view('admin.program.index',compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = $this->configTxtOnly;

        return view('admin.program.create',compact('config'));
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

        $program = Program::create([
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

                $program->gambar()->save($gambarTambah);
            }

        } 

        $request->session()->flash('msg',"Data program berhasil ditambahkan");

        return redirect('/admin/program');
    }

    public function storeImages(Request $request, Program $program)
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

                $program->gambar()->save($gambarTambah);
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
    public function show(Program $program)
    {
        $gambarProgram = $program->load('gambar');
        return view('admin.program.view',compact("gambarProgram"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $config = $this->configTxtOnly;

        return view('admin.program.edit',compact("program",'config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
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

        if ($request->file('sampul')) {
            if (Storage::exists('post-images/' . $program->sampul)) {
                Storage::delete('post-images/' . $program->sampul);
            }
            $reqGambar = $request->file('sampul');
            $validated['sampul'] = $reqGambar->storePubliclyAs('post-images',time().'_'.$reqGambar->getClientOriginalName());
            $validated['sampul'] = Str::of($validated['sampul'])->after('post-images/');
        } else $validated['sampul'] = $program->sampul;

        $program->judul = $validated['judul'];
        $program->deskripsi = $validated['deskripsi'];
        $program->sampul = $validated['sampul'];
        $program->tanggal = $validated['tanggal'];
        $program->penulis = $validated['penulis'];
        $program->save();

        $request->session()->flash('msg',"Data program berhasil diubah");

        return redirect('/admin/program');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        foreach ($program->gambar as $gambar) {
            // dd($gambar->gambar);
            if (Storage::exists('post-images/' . $gambar->gambar)) {
                Storage::delete('post-images/' . $gambar->gambar);
            } else {
                // dd('file not found aaaaa');
            } 
        }
        $program->gambar()->delete();
        if (Storage::exists('post-images/' . $program->sampul)) {
            Storage::delete('post-images/' . $program->sampul);
        }

        $program->delete();
        return redirect('/admin/program');
    }
}
