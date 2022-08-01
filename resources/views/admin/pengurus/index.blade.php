@extends('adminlte::page')

@section('title', 'Pengurus Desa')

@section('content_header')
<h1>Daftar Pengurus Desa</h1>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <form action="/admin/pengurus" method="get">
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
            <h3 class="card-title">Data Pengurus Desa</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <a href="/admin/pengurus/create" class="btn btn-block btn-primary">Tambah Pengurus</a>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama Jabatan</th>
                  <th>Nama</th>
                  <th>Tanggal Mulai Menjabat</th>
                  <th>aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pengurus as $pengurus1)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengurus1->NIP }}</td>
                  <td>{{ $pengurus1->jabatan }}</td>
                  <td>{{ $pengurus1->nama }}</td>
                  <td>{{ $pengurus1->tanggal_menjabat }}</td>
                  <td>
                    <form action="/admin/pengurus/{{ $pengurus1->NIP }}/destroy" method="post">
                      @csrf
                      @method('delete')
            
                      <a href="/admin/pengurus/{{ $pengurus1->NIP }}" class="btn btn-success">
                        Detail
                      </a>
            
                      <a class="btn btn-warning" href="/admin/pengurus/{{ $pengurus1->NIP }}/edit">
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
        {{ $pengurus->links() }}
      </div>
    </div>
  </div>
</section>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('css')
@stop

@section('js')
@stop