<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;

class AparaturController extends Controller
{
    public function index(){
        return view('aparatur', [
            'title' => 'Aparatur Desa',
            'active' => 'about',
            'name' => 'Desa Tumpakrejo',
            'aparaturs' => Pengurus::all()

        ]);
    }
}
