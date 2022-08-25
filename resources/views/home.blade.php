@extends('layouts.main')

@section('container')

<div id="carouselExampleCaptions" class="carousel slide mb-5" data-bs-ride="false" style="width:100%; height: 500px">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
      aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" style=" width:100%; height: 500px !important;">
      @if ($berita!=null)
      <a href="/berita/{{ $berita->slug }}">
        <img src="{{ asset('storage/' . $berita->sampul) }}" class="d-block w-100" alt="...">
      </a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Berita Terbaru</h5>
        <p>{{ $berita->judul }}</p>
      </div>
      @endif
    </div>
    @if ($potensi!=null)
    <div class="carousel-item" style=" width:100%; height: 500px !important;">   
      <a href="/potensi/{{ $potensi->slug }}">
        <img src="{{ asset('storage/' . $potensi->sampul) }}" class="d-block w-100" alt="...">
      </a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Potensi Desa</h5>
        <p>{{ $potensi->judul }}</p>
      </div>
    </div>  
    @endif
    <div class="carousel-item" style=" width:100%; height: 500px !important;">
      @if ($program!=null)
      <img src="{{ asset('storage/' . $program->sampul) }}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Program Kerja</h5>
        <p>{{ $program->judul }}</p>
      </div>
      @endif
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container text-center mb-5">
  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card" style="width: 18rem; width:100%">
        <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.7)">
          <a class="text-white text-decoration-none">Potensi Desa</a>
        </div>
        <img src="{{ asset('storage/nganteb2.jpg') }}" class="card-img-top" alt="..." style="height: 200px">
        <div class="card-body">
          <h5 class="card-title">Potensi</h5>
          <a href="/potensi" class="btn btn-primary">Lihat Semua</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card" style="width: 18rem; width:100%">
        <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.7)">
          <a class="text-white text-decoration-none">Produk Unggulan</a>
        </div>
        <img src="{{ asset('storage/produkdesa.jpeg') }}" class="card-img-top" alt="..." style="height: 200px">
        <div class="card-body">
          <h5 class="card-title">Produk</h5>
          <a href="/produk" class="btn btn-primary">Lihat Semua</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card" style="width: 18rem; width:100%">
        <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.7)">
          <a class="text-white text-decoration-none">Program Desa</a>
        </div>
        <img src="{{ asset('storage/baldes.jpeg') }}" class="card-img-top" alt="..." style="height: 200px">
        <div class="card-body">
          <h5 class="card-title">Program</h5>
          <a href="/program" class="btn btn-primary">Lihat Semua</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


@endsection