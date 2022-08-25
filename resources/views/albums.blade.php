@extends('layouts.main')

@section('container')

<h1 class = "mb-5">Galeri Album</h1>

<div class="row mb-4">

  @if($albums->count())

  @foreach ($albums as $album)

    <div class="col-md-4 mb-4">
      <img src="{{ asset('storage/' . $album->sampul) }}" class="d-block w-100" alt="...">
          <div class="card-body ">
            <h5 class="card-title text-align-center">{{ $album->nama }}</h5>
            <p>
              <small>
                  {{$album->keterangan}}
              </small>
              </p>
            <p class="card-text">{{ $album->created_at->isoFormat('dddd, D MMMM Y') }}</p>
            <a href="/galeri/{{ $album->slug }}" class="btn btn-primary">Lihat semua...</a>
          </div>
    </div>

    @endforeach

    @else
      <p class="text-center fs-4">Belum ada data.</p>
    @endif
    

    

    
</div>




@endsection