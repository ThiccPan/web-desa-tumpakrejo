@extends('adminlte::page')

@section('title', 'Produk')

@section('content_header')
<h1>Detail Produk</h1>
@stop

@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex flex-row justify-content-end">
        <form action="/admin/produk/{{ $produk->slug }}/destroy" method="post">
          @csrf
          @method('delete')

          <a href="/admin/produk" class="btn btn-secondary">
            Kembali
          </a>

          <a class="btn btn-warning" href="/admin/produk/{{ $produk->slug }}/edit">
            Ubah
          </a>

          <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
        </form>
      </div>
    </div>
    <div class="card-body">
      <strong>Judul</strong>
      <p class="text-muted">
        {{ $produk->judul }}
      </p>
      <hr>
      <strong>Slug</strong>
      <p class="text-muted">
        {{ $produk->slug }}
      </p>
      <hr>
      <strong>penulis</strong>
      <p class="text-muted">{{ $produk->penulis }}</p>
      <hr>
      <strong>Deskripsi</strong>
      {!! $produk->deskripsi !!}
      <hr>
      <strong>Tanggal</strong>
      <p class="text-muted">{{ $produk->updated_at }}</p>
      <hr>
      <strong>Gambar</strong>
      <br>
      <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->gambar }}"
      style="max-height: 300px; max-width: 300px;" class="img-responsive">
    </div>
  </div>
</section>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop