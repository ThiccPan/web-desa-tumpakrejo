@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Daftar Potensi</h1>
@stop

@section('content')
<form action="/admin/potensi" method="get">
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
        <h3 class="card-title">Data Potensi</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <a href="/admin/potensi/create" class="btn btn-block btn-primary">Tambah potensi</a>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tanggal</th>
              <th>Penulis</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($potensis as $potensi)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $potensi['judul'] }}</td>
              <td>{{ $potensi['updated_at'] }}</td>
              <td>{{ $potensi['penulis'] }}</td>
              <td>
                <form action="/admin/potensi/{{ $potensi->slug }}/destroy" method="post">
                  @csrf
                  @method('delete')
        
                  <a href="/admin/potensi/{{ $potensi->slug }}" class="btn btn-success">
                    Detail
                  </a>
        
                  <a class="btn btn-warning" href="/admin/potensi/{{ $potensi->slug }}/edit">
                    Ubah
                  </a>
        
                  <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{ $potensis->links() }}
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
<script>
  console.log('Hi!'); 
</script>
@stop