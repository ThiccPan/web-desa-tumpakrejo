@extends('adminlte::page')

@section('plugins.Summernote', true)
@section('title', 'Tambah Program')

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
  <h1>Tambahkan Program Baru</h1>
@stop

@section('content')
  <form action="/admin/berita/{{ $berita->slug }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="judul">Judul Berita:</label> 
      <input type="text" name="judul" id="" class="@error('judul') is-invalid @enderror form-control" maxlength="255" value="{{ old('judul') }}">

      @error('judul')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi:</label>
      <x-adminlte-text-editor name="deskripsi" id="teBasic" :config="$config" enable-old-support/>

      @error('deskripsi')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>


    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input type="file" name="gambar" class="form-control p-1 @error('gambar') is-invalid @enderror">

      @error('deskripsi')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-1">
      <label for="penulis">Penulis: </label>
      <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis') }}">

      @error('penulis')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>

    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
    <a href="/admin/produk" class="btn btn-secondary">Kembali</a>
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