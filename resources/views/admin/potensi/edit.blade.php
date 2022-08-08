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
<div class="card card-default">
  <div class="card-body">

    <form action="/admin/potensi/{{ $potensi->slug }}" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf
  
      <div class="form-group">
        <label for="judul">Judul Potensi:</label> 
        <input type="text" name="judul" id="" class="@error('judul') is-invalid @enderror form-control" maxlength="255" value="{{ $potensi->judul }}">
  
        @error('judul')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="6"> {{ $potensi->deskripsi }}</textarea>
  
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="gambar" class="form-label">Gambar: </label>
        <input type="file" name="gambar" class="form-control p-1 @error('gambar') is-invalid @enderror" value="{{ $potensi->gambar }}">
        
        @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <p><strong>Gambar Lama:</strong></p>
        <img src="{{ asset('storage/' . $potensi->gambar) }}" alt="Gambar lama tidak ditemukan" style="max-height: 300px; max-width: 300px;" class="img-responsive">
      </div>
  
      <div class="form-group">
        <label for="penulis">Penulis: </label>
        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ $potensi->penulis }}">
  
        @error('penulis')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
  
      <input type="submit" value="Submit" name="submit" class="btn btn-primary">
      <a href="/admin/potensi" class="btn btn-secondary">Kembali</a>
    
    </form>
  </div>
</div>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop