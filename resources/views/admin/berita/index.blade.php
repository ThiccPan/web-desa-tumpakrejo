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
        <h3 class="card-title">Responsive Hover Table</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <a href="/admin/berita/create" class="btn btn-block btn-primary">Tambah berita</a>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Judul</th>
              <th>Cover</th>
              <th>Penulis</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($beritas as $berita)
            <tr>
              <td>{{ $berita['id'] }}</td>
              <td>{{ $berita['judul'] }}</td>

              <td>{{ $berita['cover'] }}</td>

              <td>{{ $berita['penulis'] }}</td>
              <td>
                <a href="/admin/berita/{{ $berita->slug }}" class="btn btn-primary" icon="fas fa-md fa-trash">Lihat</a>
                <a href="/admin/berita/{{ $berita->slug }}/edit" class="btn btn-warning ">Edit</a>
                <form action="/admin/berita/{{ $berita->slug }}/destroy" method="post">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger mt-1" type="submit" name="submit" value="delete"
                    label="delete">Hapus</button>
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