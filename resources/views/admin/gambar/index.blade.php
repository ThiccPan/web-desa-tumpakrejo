@extends('adminlte::page')

@section('title', 'Album')

@section('content_header')
<h1>Daftar Album</h1>
@stop

@section('content')
<section class="content">
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Album</th>
                  <th>Sampul</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($albums as $album)                    
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $album->nama }}</td>
                  <td>
                    <img src="{{ asset('storage/' . $album->sampul) }}" alt="" style="max-height: 100px; max-width: 100px;" class="img-responsive">
                  </td>
                  <td>
                    <form action="/admin/gambar/{{ $album->id }}" method="post">
                      @csrf
                      @method('delete')
            
                      <a class="btn btn-warning" href="/admin/gambar/{{ $album->id }}">
                        Lihat gambar
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
      </div>
    </div>
  </div>
</section>
@stop




@section('footer')
@include('partials.footerAdmin')
@stop

@section('css')
@stop

@section('js')
@stop