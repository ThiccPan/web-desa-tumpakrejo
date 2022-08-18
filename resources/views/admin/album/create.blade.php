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
<h1>Tambahkan Album Baru</h1>
@stop

@section('content')
<div class="card card-default">
  <div class="card-body">

    <form action="/admin/album/store" method="post" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="nama">Nama Album:</label>
        <input type="text" name="nama" id="" class="@error('nama') is-invalid @enderror form-control" maxlength="50"
          value="{{ old('nama') }}">

        @error('nama')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="keterangan" class="form-label">Keterangan:</label>
        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
          rows="6"> {{ old('keterangan') }}</textarea>

        @error('keterangan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="sampul" class="form-label">Sampul</label>
        <input type="file" id="gambar1" name="sampul" class="form-control p-1 @error('sampul') is-invalid @enderror">

        <img src="#" id="preview-tag" width="200px" /> 


        @error('sampul')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <input type="submit" value="Submit" name="submit" class="btn btn-primary">
      <a href="/admin/album" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@stop 

@section('footer')
@include('partials.footerAdmin')
@stop

@section('js')
<script src="../../js/imgPreview.js"></script>
@stop