@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Detail Galeri</h1>
@stop

@section('content')

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar gambar album</h3>
      <div class="card-tools">
        <a href="/admin/albumx/create">
          <div class="input-group input-group-sm" style="width: 150px;">
            <button type="button" class="btn btn-block btn-success">Tambah Gambar</button>
          </div>
        </a>
      </div>
    </div>
    <div class="card-body">
      {{ $berita->slug }} <br>
      {!! $berita->deskripsi !!}
    </div>
  </div>
</section>

@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop


