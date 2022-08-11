@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Detail Galeri</h1>
@stop

@section('content')

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex flex-row justify-content-end">
        <form action="/admin/berita/{{ $berita->slug }}/destroy" method="post">
          @csrf
          @method('delete')

          <a href="/admin/berita" class="btn btn-secondary">
            Kembali
          </a>

          <a class="btn btn-warning" href="/admin/berita/{{ $berita->slug }}/edit">
            Ubah
          </a>

          <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
        </form>
      </div>
    </div>
    <div class="card-body">
      <strong>Judul</strong>
      <p class="text-muted">
        {{ $berita->judul }}
      </p>
      <hr>
      <strong>Slug</strong>
      <p class="text-muted">
        {{ $berita->slug }}
      </p>
      <hr>
      <strong>penulis</strong>
      <p class="text-muted">{{ $berita->penulis }}</p>
      <hr>
      <strong>Deskripsi</strong>
      <p class="text-muted">
        {!! $berita->deskripsi !!}
      </p>
      <hr>
      <strong>Tanggal</strong>
      <p class="text-muted">{{ $berita->updated_at }}</p>
      <hr>
      <strong>Sampul</strong>
      <br>
      <img src="{{ asset('storage/' . $berita->sampul) }}" alt="{{ $berita->sampul }}" style="max-height: 300px; max-width: 300px;" class="img-responsive">
      <hr>
      <strong>Gambar</strong>
      <br>
      @foreach ($berita->gambar as $gambar)          
        <img src="{{ asset('storage/' . $gambar->gambar) }}" alt="{{ $gambar->gambar }}"
          style="max-height: 300px; 
          max-width: 300px;" 
          class="img-responsive"
        >
        <p></p>
      @endforeach
    </div>
  </div>
</section>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop


