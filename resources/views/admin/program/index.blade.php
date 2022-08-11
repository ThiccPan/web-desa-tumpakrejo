@extends('adminlte::page')

@section('title', 'Program Kerja')

@section('content_header')
<h1>Daftar Program Kerja</h1>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <form action="/admin/program" method="get">
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
            <h3 class="card-title">Data Program Kerja</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <a href="/admin/program/create" class="btn btn-block btn-success">Tambah Program</a>
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
                @foreach ($programs as $program)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $program['judul'] }}</td>
                  <td>{{ $program['tanggal'] }}</td>
                  <td>{{ $program['penulis'] }}</td>
                  <td>
                    <form action="/admin/program/{{ $program->slug }}/destroy" method="post">
                      @csrf
                      @method('delete')
            
                      <a href="/admin/program/{{ $program->slug }}" class="btn btn-primary">
                        Detail
                      </a>
            
                      <a class="btn btn-warning" href="/admin/program/{{ $program->slug }}/edit">
                        Ubah
                      </a>
                      
                      <button type="submit" class="btn btn-danger">Hapus</button>

                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        {{ $programs->links() }}
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