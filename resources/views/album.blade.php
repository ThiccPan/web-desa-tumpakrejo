@extends('layouts.main')

@section('container')

<!-- Page Content -->
<div class="container">

  <h1 class="fw-light text-center text-lg-start mt-4 mb-0">{{ $judul }}</h1>

  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-start">

    @foreach ($gambars->gambar as $gambar)
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
        <img src="{{ asset('storage/' . $gambar->gambar) }}" class="d-block w-100 img-responsive" alt="..." style="">
      </a>
    </div>
    @endforeach
  </div>

</div>
@endsection