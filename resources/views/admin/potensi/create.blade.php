@extends('adminlte::page')

@section('title', 'Add New Post')

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
  <h1>Tambahkan Potensi Baru</h1>
@stop

@section('content')
  <form action="/admin/potensi/store" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="judul">Judul Potensi:</label> 
      <input type="text" name="judul" id="" class="@error('judul') is-invalid @enderror form-control" maxlength="255" value="{{ old('judul') }}">

      @error('judul')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi:</label>
      <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="6"> {{ old('deskripsi') }}</textarea>

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
    <a href="/admin/potensi" class="btn btn-secondary">Kembali</a>
  </form>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop