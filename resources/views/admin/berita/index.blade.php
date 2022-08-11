@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Daftar Berita</h1>
@stop

@section('content')
<form action="/admin/berita" method="get">
  <div class="input-group mb-3 w-25">
    <button type="submit" class="btn btn-default" id="button-search">
      <i class="fas fa-search"></i>
    </button>
    <input type="text" name="search" class="form-control" placeholder="Search" aria-describedby="button-search"
      value="{{ request('search') }}">
  </div>
</form>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Berita</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <a href="/admin/berita/create" class="btn btn-block btn-success">Tambah berita</a>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Cover</th>
              <th>Penulis</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($beritas as $berita)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $berita->judul }}</td>

              <td>
                <img src="{{ asset('storage/' . $berita->sampul) }}" alt="{{ $berita->sampul }}" style="max-height: 100px; max-width: 100px;" class="img-responsive">
              </td>

              <td>{{ $berita->penulis }}</td>
              <td>
                <form action="/admin/berita/{{ $berita->slug }}/destroy" method="post">
                  @csrf
                  @method('delete')
                  <a href="/admin/berita/{{ $berita->slug }}" class="btn btn-primary">Lihat</a>
                  <a href="/admin/berita/{{ $berita->slug }}/edit" class="btn btn-warning ">Edit</a>
                  <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  console.log('Hi!'); 
</script>
@stop