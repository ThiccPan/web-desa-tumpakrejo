

@extends('layouts.main')

@section('container')
    <h1 class = "mb-3 text-center">{{ $title }}</h1>

<div class="row justify-content-center mb-3">
  <div class="col-md-6">
    <form action="/{{ $slug }}">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari {{ $title }}..." name="search" value="{{ request('search') }}">
        <button class="btn btn-danger" type="submit">Cari</button>
      </div>
    </form>
  </div>
</div>


@if ($posts->count())
<div class="card mb-3">
    <img src="{{ asset('storage/' . $posts[0]->sampul) }}" class="card-img-top" alt="" style="max-height: 400px; width:100%; object-fit:cover;">
    <div class="card-body text-center">
      <h5 class="card-title"><a href="/{{ $slug }}/{{ $posts[0]->slug }}"  class="text-decoration-none text-dark">{{ $posts[0]->judul }}</a></h5>
      <p>
        <small>
            Oleh <a class ="text-decoration-none">{{ $posts[0]->penulis }}</a>
            {{ $posts[0]->created_at->diffForHumans() }}
        </small>
    </p>
      <p class="card-text">{{ $posts[0]->excerpt() }}</p>
      <a href="/{{ $slug }}/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Baca lanjut...</a>
    </div>
  </div>
    
<div class="container">
    <div class="row">
        @foreach ($posts->skip(1) as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
                {{-- <div class="position-absolute px-3 py-2 " style="background-color: rgba(0,0,0,0.7)">
                    
                </div> --}}
                <img src="{{ asset('storage/' . $post->sampul) }}" class="card-img-top" alt="" style="max-height: 400px; width:100%; object-fit:cover;">
                <div class="card-body">
                  <h5 class="card-title"><a class="text-decoration-none text-dark" href="/{{ $slug }}/{{ $post->slug }}"> {{ $post->judul }}</a></h5>
                  <p>
                    <small>
                        Oleh <a href="/blog?author={{ $post->penulis }}" class ="text-decoration-none">{{ $post->penulis }}.</a>
                        {{ $post->created_at->isoFormat('dddd, D MMMM Y') }}
                    </small>
                    </p>
                  <p class="card-text">{{ $post->excerpt() }}</p>
                  @if($title != "Berita")
                  <a href="/{{ $slug }}/{{ $post->slug }}" class="btn btn-primary">Baca lanjut</a>
                  @endif
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>

@else
  <p class="text-center fs-4">Belum ada {{ $title }}.</p>
@endif

<div class="d-flex justify-content-end mt-1">
  {{ $posts->links() }}
</div>

@endsection

