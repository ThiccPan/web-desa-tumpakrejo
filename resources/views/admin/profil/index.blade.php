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
@foreach ($profils as $profil)

<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title"><b>{{$loop->iteration . ". " . $profil->judul }}</b></h3>
    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <a class="btn btn-warning" href="/admin/profil/{{ $profil->id }}">
          Ubah
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <p>Deskripsi: </p>
      {!! $profil->deskripsi !!}
    </div>

    <div class="my-3">
      <p>Gambar: </p>
      <img src="{{ asset('storage/' . $profil->gambar) }}" alt="gambar tidak ditemukan"
        style="max-height: 200px; max-width: 200px;" class="img-responsive">
    </div>

  </div>
</div>
@endforeach
@stop

@section('footer')
@include('partials.footer')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop