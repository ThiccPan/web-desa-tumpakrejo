@extends('adminlte::page')

@section('title', 'Tambah Produk')
@section('plugins.Summernote', true)

@section('content_header')
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
  <h1>Tambahkan Produk Baru</h1>
@stop

@section('content')
  <form action="/admin/produk/{{ $produk->slug }}/update" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="mb-3">
      <label for="judul">Judul Produk:</label> 
      <input type="text" name="judul" id="" class="@error('judul') is-invalid @enderror form-control" maxlength="255" value="{{ $produk->judul }}">

      @error('judul')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi:</label>
      {{-- <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="6"> {{ $produk->deskripsi }}</textarea> --}}
      <x-adminlte-text-editor name="deskripsi" id="teBasic" enable-old-support :config="$config">
        {!! $produk->deskripsi !!}
      </x-adminlte-text-editor>

      @error('deskripsi')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input type="file" name="gambar" class="form-control p-1 @error('gambar') is-invalid @enderror" value="{{ $produk->gambar }}">
      <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar lama tidak ditemukan" style="max-height: 300px; max-width: 300px;" class="img-responsive">

      @error('deskripsi')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="tanggal">tanggal:</label>
      <input type="date" name="tanggal" class="form-control w-25 @error('tanggal') is-invalid @enderror" value="{{ $produk->tanggal }}">

      @error('tanggal')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="penulis">Penulis: </label>
      <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ $produk->penulis }}">

      @error('penulis')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <input type="submit" value="Submit" name="submit" class="btn btn-primary">
      <a href="/admin/produk" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop