@extends('adminlte::page')

@section('title', 'Program')

@section('content_header')
<h1>Detail Program</h1>
@stop

@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex flex-row justify-content-end">
        <form action="/admin/program/{{ $program->slug }}/destroy" method="post">
          @csrf
          @method('delete')

          <a href="/admin/program" class="btn btn-secondary">
            Kembali
          </a>

          <a class="btn btn-warning" href="/admin/program/{{ $program->slug }}/edit">
            Ubah
          </a>

          <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
        </form>
      </div>
    </div>
    <div class="card-body">
      <strong>Judul</strong>
      <p class="text-muted">
        {{ $program->judul }}
      </p>
      <hr>
      <strong>Slug</strong>
      <p class="text-muted">
        {{ $program->slug }}
      </p>
      <hr>
      <strong>penulis</strong>
      <p class="text-muted">{{ $program->penulis }}</p>
      <hr>
      <strong>Deskripsi</strong>
      <p class="text-muted">
        {{ $program->deskripsi }}
      </p>
      <hr>
      <strong>Tanggal</strong>
      <p class="text-muted">{{ $program->updated_at }}</p>
      <hr>
      <strong>Gambar</strong>
      <br>
      <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->gambar }}"
        style="max-height: 300px; max-width: 300px;" class="img-responsive">
    </div>
  </div>
</section>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop