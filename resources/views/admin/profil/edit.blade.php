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
<h1>Edit Profil Desa</h1>
@stop

@section('content')
<div class="card card-default">
  <div class="card-body">
    <form action="/admin/profil/{{ $profil->id }}/update" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf

      <label for="">{{ $profil->judul }}</label>

      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        {{-- <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="6"> {{ $produk->deskripsi }}</textarea>
        --}}
        <x-adminlte-text-editor name="deskripsi" id="teBasic" enable-old-support :config="$config">
          {!! $profil->deskripsi !!}
        </x-adminlte-text-editor>

        @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="gambar" class="form-label">gambar</label>
        <input type="file" name="gambar" class="form-control p-1 @error('gambar') is-invalid @enderror"
          value="{{ $profil->gambar }}">
        <img src="{{ asset('storage/' . $profil->gambar) }}" alt="Gambar lama tidak ditemukan"
          style="max-height: 200px; max-width: 200px;" class="img-responsive">

        @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>
@stop

@section('footer')
@include('partials.footerAdmin')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop