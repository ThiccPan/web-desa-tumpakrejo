@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Detail Galeri</h1>
@stop

@section('content')

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar gambar album</h3>
      <div class="card-tools">
        <a href="/admin/album/{{ $gambar_album->slug }}/create">
          <div class="input-group input-group-sm" style="width: 150px;">
            <button type="button" class="btn btn-block btn-success">Tambah Gambar</button>
          </div>
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="col-sm-12">
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama File</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Gambar</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($gambar_album->gambar as $gambar)
            <tr class="">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $gambar->gambar }}</td>
              <td><img src="{{ asset('storage/' . $gambar->gambar) }}" alt="{{ asset($gambar->gambar) }}" style="max-width:200px;max-height:200px;" class="img-responsive"></td>
              <td>
                <form action="/admin/destroy/{{ $gambar->gambar }}" method="post">
                  @csrf
                  @method('delete')

                  <a class="btn btn-warning" href="/admin/album/{{ $gambar_album->slug }}/{{ $gambar->gambar }}">
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
  </div>
</section>

@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')
@stop


