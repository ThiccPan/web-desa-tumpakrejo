<?php

namespace App\Http\Controllers;

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
        $programs = Program::paginate('10');

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
        return view('admin.program.create');
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

        if ($request->file('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('post-images');
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = '';

        Program::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'gambar' => $validated['gambar'],
            'tanggal' => $validated['tanggal'],
            'penulis' => $validated['penulis']
        ]);

        $request->session()->flash('msg',"Data program berhasil ditambahkan");

        return redirect('/admin/program');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $program = Program::where('slug',$slug)->first();
        return view('admin.program.view',compact("program"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $program = Program::where('slug',$slug)->first();
        return view('admin.program.edit',compact("program"));
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
        $program = Program::where('slug',$slug)->first();

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

        if ($request->file('gambar')) {
            if (Storage::exists('post-images/' . $program->gambar)) {
                Storage::delete('post-images/' . $program->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('post-images');
            $validated['gambar'] = Str::of($validated['gambar'])->after('post-images/');
        } else $validated['gambar'] = $program->gambar;

        $program->judul = $validated['judul'];
        $program->deskripsi = $validated['deskripsi'];
        $program->gambar = $validated['gambar'];
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
    public function destroy($slug)
    {
        $program = Program::where('slug',$slug)->first();

        if (Storage::exists('post-images/' . $program->gambar)) {
            Storage::delete('post-images/' . $program->gambar);
        }

        $program->delete();
        return redirect('/admin/potensi');
    }
}
