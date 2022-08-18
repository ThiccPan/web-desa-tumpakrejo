@extends('adminlte::page')

@section('title', 'Produk')

@section('content_header')
<h1>Daftar Produk Unggulan</h1>
@stop

@section('content')
<div class="container-fluid">
  <form action="/admin/produk" method="get">
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
          <h3 class="card-title">Data Produk</h3>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px">
              <a href="/admin/produk/create" class="btn btn-block btn-success">Tambah produk</a>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal Dimulai</th>
                <th>Penulis</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($produks as $produk)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $produk['judul'] }}</td>
                <td>{{ $produk['tanggal'] }}</td>
                <td>{{ $produk['penulis'] }}</td>
                <td>
                  <form action="/admin/produk/{{ $produk->slug }}/destroy" method="post">
                    @csrf
                    @method('delete')

                    <a href="/admin/produk/{{ $produk->slug }}" class="btn btn-primary">
                      Detail
                    </a>

                    <a class="btn btn-warning" href="/admin/produk/{{ $produk->slug }}/edit">
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
      {{ $produks->links() }}
    </div>
  </div>
</div>
@stop

@section('footer')
@include('partials.footerAdmin')
@stop