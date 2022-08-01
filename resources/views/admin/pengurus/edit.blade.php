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
  <h1>Tambahkan Pengurus Baru</h1>
@stop

@section('content')
<div class="card card-default">
  <div class="card-body">

    <form action="/admin/pengurus/{{ $pengurus->NIP }}/update" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="NIP">NIP Pengurus:</label> 
        <input type="text" name="NIP" id="" class="@error('NIP') is-invalid @enderror form-control" maxlength="255" value="{{ $pengurus->NIP }}">
  
        @error('NIP')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="nama">Nama Pengurus:</label> 
        <input type="text" name="nama" id="" class="@error('nama') is-invalid @enderror form-control" maxlength="255" value="{{ $pengurus->nama }}">
  
        @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="jabatan">Jabatan Pengurus:</label> 
        <input type="text" name="jabatan" id="" class="@error('jabatan') is-invalid @enderror form-control" maxlength="255" value="{{ $pengurus->jabatan }}">
  
        @error('jabatan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="tanggal_menjabat" class="form-label">Tanggal Mulai Menjabat:</label>
        <input type="date" name="tanggal_menjabat" id="tanggal_menjabat" class="@error('tanggal_menjabat') is-invalid @enderror form-control" value="{{ $pengurus->tanggal_menjabat }}">
  
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="gambar" class="form-label">Gambar/Pas Foto</label>
        <input type="file" name="gambar" class="form-control p-1 @error('gambar') is-invalid @enderror" value="{{ $pengurus->gambar }}">
  
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <p><strong>Gambar/foto Lama:</strong></p>
        <img src="{{ asset('storage/' . $pengurus->gambar) }}" alt="Gambar lama tidak ditemukan" style="width: 300px; height:300px;">
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop