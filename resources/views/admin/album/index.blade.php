@extends('adminlte::page')

@section('title', 'Album')

@section('content_header')
<h1>Daftar Album</h1>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <form action="/admin/album" method="get">
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
            <h3 class="card-title">Data Album</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <a href="/admin/album/create" class="btn btn-block btn-primary">Tambah Album</a>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Album</th>
                  <th>Slug</th>
                  <th>id</th>
                  <th>Sampul</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($albums as $album)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $album->nama }}</td>
                  <td>{{ $album->slug }}</td>
                  <td>{{ $album->id }}</td>
                  <td>
                    <img src="{{ asset('storage/' . $album->sampul) }}" alt="" style="max-height: 100px; max-width: 100px;" class="img-responsive">
                  </td>
                  <td>{{ $album->updated_at }}</td>
                  <td>{{ $album->keterangan }}</td>
                  <td>
                    <form action="/admin/album/{{ $album->slug }}/destroy" method="post">
                      @csrf
                      @method('delete')
            
                      <a class="btn btn-success" href="/admin/album/{{ $album->slug }}">
                        Lihat
                      </a>

                      <a class="btn btn-warning" href="/admin/album/{{ $album->slug }}/edit">
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
        {{ $albums->links() }}
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