<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index(){
        $programs = Program::latest()->filter(request(['search']))->paginate(7)->withQueryString();

        return view('artikel',[
            "title" => "Program Desa",
            "active" => 'artikel',
            "slug" => 'program',
            "posts" => $programs
        ]);
    }

    public function show(Program $post){
        return view("artikel.program", [
            "title" => "Program",
            "active" => 'artikel',
            "post" => $post
        ]);
    }
}
