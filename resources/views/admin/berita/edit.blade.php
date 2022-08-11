@extends('adminlte::page')

@section('plugins.Summernote', true)
@section('title', 'Edit Program')

@section('content_header')
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<h1>Tambahkan Program Baru</h1>
@stop

@section('content')
<div class="card card-default">
  <div class="card-body">
    <form action="/admin/berita/{{ $berita->slug }}/update" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="mb-3">
        <label for="judul">Judul Berita:</label>
        <input type="text" name="judul" id="" class="@error('judul') is-invalid @enderror form-control" maxlength="255"
          value="{{ $berita->judul }}">

        @error('judul')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <x-adminlte-text-editor name="deskripsi" id="teBasic" enable-old-support :config="$config">
          {!! $berita->deskripsi !!}
        </x-adminlte-text-editor>

        @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>


      <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" name="gambar" class="form-control p-1 @error('gambar') is-invalid @enderror">

        @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-1">
        <label for="penulis">Penulis: </label>
        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror"
          value="{{ $berita->penulis }}">

        @error('penulis')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <input type="submit" value="Submit" name="submit" class="btn btn-primary">
      <a href="/admin/produk" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>


<div class="card card-default">
  <div class="card-header pt-4">

    <form action="/admin/berita/{{ $berita->slug }}/gambar/tambah" method="POST" enctype="multipart/form-data"
      class="row row-cols-lg-auto g-3 align-items-center">
      @csrf
      <div class="form-group col-8">
        <div class="input-group">
          <label for="" class="input-group-text">Tambah gambar: </label>
          <input type="file" name="gambars[]" class="form-control p-1 @error('sampul') is-invalid @enderror" multiple
            required>

          @error('deskripsi')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>
      <div class="form-group">
        <input type="submit" value="Tambah" name="submit" class="btn btn-success">
      </div>
    </form>
  </div>

  <div class="card-body">

    <div class="form-group">
      <label for="">Daftar gambar berita</label>


      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
        aria-describedby="example1_info">
        <thead>
          <tr role="row">
            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
              aria-sort="ascending">No</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Nama File</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Gambar</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($berita->gambar as $gambar)
          <tr class="">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $gambar->gambar }}</td>
            <td><img src="{{ asset('storage/' . $gambar->gambar) }}" alt="{{ asset($gambar->gambar) }}"
                style="max-width:200px;max-height:200px;" class="img-responsive"></td>
            <td>
              <form action="/admin/destroy/{{ $gambar->gambar }}" method="post">
                @csrf
                @method('delete')
                <input class="btn btn-danger" type="submit" name="" value="Hapus">
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('js')

@stop