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
        <form action="/admin/potensi/{{ $potensis->slug }}/destroy" method="post">
          @csrf
          @method('delete')

          <a href="/admin/potensi" class="btn btn-secondary">
            Kembali
          </a>

          <a class="btn btn-warning" href="/admin/potensi/{{ $potensis->slug }}/edit">
            Ubah
          </a>

          <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
        </form>
      </div>
    </div>
    <div class="card-body">
      <strong>Judul</strong>
      <p class="text-muted">
        {{ $potensis->judul_potensi }}
      </p>
      <hr>
      <strong>Slug</strong>
      <p class="text-muted">
        {{ $potensis->slug }}
      </p>
      <hr>
      <strong>penulis</strong>
      <p class="text-muted">{{ $potensis->penulis }}</p>
      <hr>
      <strong>Deskripsi</strong>
      <p class="text-muted">
        {{ $potensis->konten }}
      </p>
      <hr>
      <strong>Tanggal</strong>
      <p class="text-muted">{{ $potensis->updated_at }}</p>
      <hr>
      <strong>Gambar</strong>
      <br>
      <img src="{{ asset('storage/' . $potensis->gambar) }}" alt="{{ $potensis->gambar }}" style="width: 300px; height:300px">
    </div>
  </div>
</section>
@stop

@section('css')
@stop

@section('js')
@stop