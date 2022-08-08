@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Detail Potensi</h1>
@stop

@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex flex-row justify-content-end">
        <form action="/admin/potensi/{{ $potensi->slug }}" method="post">
          @csrf
          @method('delete')

          <a href="/admin/potensi" class="btn btn-secondary">
            Kembali
          </a>

          <a class="btn btn-warning" href="/admin/potensi/{{ $potensi->slug }}/edit">
            Ubah
          </a>

          <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
        </form>
      </div>
    </div>
    <div class="card-body">
      <strong>Judul</strong>
      <p class="text-muted">
        {{ $potensi->judul }}
      </p>
      <hr>
      <strong>Slug</strong>
      <p class="text-muted">
        {{ $potensi->slug }}
      </p>
      <hr>
      <strong>penulis</strong>
      <p class="text-muted">{{ $potensi->penulis }}</p>
      <hr>
      <strong>Deskripsi</strong>
      <p class="text-muted">
        {{ $potensi->deskripsi }}
      </p>
      <hr>
      <strong>Tanggal</strong>
      <p class="text-muted">{{ $potensi->updated_at }}</p>
      <hr>
      <strong>Gambar</strong>
      <br>
      <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="{{ $potensi->gambar }}" style="max-height: 300px; max-width: 300px;" class="img-responsive">
    </div>
  </div>
</section>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop