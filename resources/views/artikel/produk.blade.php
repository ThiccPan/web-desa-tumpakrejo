@extends('layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <article>
                <h2>
                    {{ $post->judul }}
                </h2>
                <small>{{ $post->created_at->isoFormat('dddd, D MMMM Y') }}</small>
                <p class="mt-3">Oleh. <a class ="text-decoration-none">{{ $post->penulis }}</a> Tentang <a href="/potensi" class ="text-decoration-none">Produk Unggulan</a></p>
                <img src="{{ asset('storage/' . $post->sampul) }}" alt="" class="img-fluid" style="max-height: 400px; width:100%; object-fit:cover;">
                <article class="my-3 fs-5">
                    <p>{!! $post->deskripsi !!}</p>
                </article>
                
            </article>
            
            <div id="carouselExampleIndicators" class="carousel slide mb-3" data-bs-ride="true">

              <div class="carousel-inner">
                @foreach ($post->gambar as $gambar)
                <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                  <img src="{{ asset('storage/' . $gambar->gambar) }}" class="d-block w-100" alt="..." style="max-height: 400px; width:100%; object-fit:cover;">
                </div>
      
                @endforeach
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

              <a href="/potensi">Kembali</a>
        </div>
    </div>
</div>


@endsection

