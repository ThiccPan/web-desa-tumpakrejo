@extends('layouts.main')

@section('container')

<div id="carouselExampleCaptions" class="carousel slide mb-5" data-bs-ride="false" style="width:100%; height: 500px">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" style=" width:100%; height: 500px !important;">
      <img src="img/baldes.jpeg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Balai Desa</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" style=" width:100%; height: 500px !important;">
      <img src="img/jembatan.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item" style=" width:100%; height: 500px !important;">
      <img src="img/nganteb2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
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
          <img src="img/baldes.jpeg" class="card-img-top" alt="..." style ="height: 200px">
          <div class="card-body">
            <h5 class="card-title">Berita</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="/blog" class="btn btn-primary">Lihat Semua</a>
          </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card" style="width: 18rem; width:100%">
        <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.7)">
          <a class="text-white text-decoration-none">Produk Unggulan</a>
        </div>
          <img src="img/jembatan.jpg" class="card-img-top" alt="..." style ="height: 200px">
          <div class="card-body">
            <h5 class="card-title">Potensi</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Lihat Semua</a>
          </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card" style="width: 18rem; width:100%">
        <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.7)">
          <a class="text-white text-decoration-none">Program Desa</a>
        </div>
          <img src="img/nganteb2.jpg" class="card-img-top" alt="..." style ="height: 200px">
          <div class="card-body">
            <h5 class="card-title">Produk Unggulan</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Lihat Semua</a>
          </div>
        </div>
    </div>
  </div>
</div>
  </div>

    
@endsection
