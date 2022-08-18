@extends('adminlte::page')

@section('plugins.Summernote', true)
@section('title', 'Tambah Potensi')

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
    <form action="/admin/potensi/store" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="judul">Judul Potensi:</label> 
        <input type="text" name="judul" id="" class="@error('judul') is-invalid @enderror form-control" maxlength="255" value="{{ old('judul') }}">
  
        @error('judul')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <x-adminlte-text-editor name="deskripsi" id="teBasic" :config="$config" enable-old-support/>
  
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="sampul" class="form-label">Sampul</label>
        <input type="file" name="sampul" class="form-control p-1 @error('sampul') is-invalid @enderror" id="gambar1">
        <img src="#" id="preview-tag" style="max-height: 200px; max-width:200px" /> 
  
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="penulis">Penulis: </label>
        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis') }}">
  
        @error('penulis')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="gambars" class="form-label">Gambar</label>
        <input type="file" name="gambars[]" id="gambars" class="form-control p-1  @error('gambar') is-invalid @enderror" multiple>
  
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>
  
      <div class="col-md-12">
        <div class="images-preview-div"> </div>
      </div>
  
      <input type="submit" value="Submit" name="submit" class="btn btn-primary">
      <a href="/admin/potensi" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@stop

@section('footer')
@include('partials.footerAdmin')
@stop

@section('css')
<style>
  .invalid-feedback {
    display: block;
  }
  .images-preview-div img
  {
      padding: 10px;
      max-width: 150px;
  }
</style>
@stop

@section('js')
  {{-- <script src="../../js/imgMultiPreview.js"></script> --}}
  <script src="{{ asset('/js/imgMultiPreview.js') }}"></script>
  <script src="{{ asset('/js/imgPreview.js') }}"></script>
@stop