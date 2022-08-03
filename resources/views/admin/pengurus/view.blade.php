@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Detail Pengurus</h1>
@stop

@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex flex-row justify-content-end">
        <form action="/admin/pengurus/{{ $pengurus->NIP }}/destroy" method="post">
          @csrf
          @method('delete')

          <a href="/admin/pengurus" class="btn btn-secondary">
            Kembali
          </a>

          <a class="btn btn-warning" href="/admin/pengurus/{{ $pengurus->NIP }}/edit">
            Ubah
          </a>

          <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
        </form>
      </div>
    </div>
    <div class="card-body">
      <strong>Nama</strong>
      <p class="text-muted">
        {{ $pengurus->nama }}
      </p>
      <hr>
      <strong>NIP</strong>
      <p class="text-muted">
        {{ $pengurus->NIP }}
      </p>
      <hr>
      <strong>Jabatan</strong>
      <p class="text-muted">{{ $pengurus->jabatan }}</p>
      <hr>
      <strong>Tanggal Menjabat</strong>
      <p class="text-muted">
        {{ $pengurus->tanggal_menjabat }}
      </p>
      <hr>
      <strong>Gambar</strong>
      <br>
      <img src="{{ asset('storage/' . $pengurus->gambar) }}" alt="{{ $pengurus->gambar }}" style="max-height: 300px; max-width: 300px;" class="img-responsive">
    </div>
  </div>
</section>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop