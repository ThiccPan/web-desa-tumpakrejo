@extends('layouts.main')

@section('container')

<h1 class="text-center">{{ $name }}</h1>
    <div class="row mb-4 mt-4">
        <h3 class="text-center border-3 border-bottom border-top border-danger">Visi & Misi</h3>
    </div>
    <div class="row mb-4 mt-4">
        <article class="my-3 fs-5">
            {{ $visiMisi }}
        </article>
    </div>

@endsection