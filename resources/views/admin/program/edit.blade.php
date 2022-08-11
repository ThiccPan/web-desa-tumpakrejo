@extends('adminlte::page')

@section('plugins.Summernote', true)
@section('title', 'Tambah Program Kerja')

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
<h1>Tambahkan Program Kerja Baru</h1>
@stop

@section('content')
<div class="card card-default">
  <div class="card-body">

    <form action="/admin/program/{{ $program->slug }}/update" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="form-group">
        <label for="judul">Judul Program:</label>
        <input type="text" name="judul" id="" class="@error('judul') is-invalid @enderror form-control" maxlength="255"
          value="{{ $program->judul }}">

        @error('judul')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <hr>

      <div class="form-group">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <x-adminlte-text-editor name="deskripsi" id="teBasic" enable-old-support :config="$config">
          {!! $program->deskripsi !!}
        </x-adminlte-text-editor>

        @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <hr>

      <div class="form-group">
        <label for="tanggal">tanggal:</label>
        <input type="date" name="tanggal" class="form-control w-25 @error('tanggal') is-invalid @enderror"
          value="{{ $program->tanggal }}">

        @error('tanggal')
        <div class="invalid-feedback">
        </div>
        {{ $message }}
        @enderror
      </div>

      <div class="form-group">
        <label for="penulis">Penulis: </label>
        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror"
          value="{{ $program->penulis }}">

        @error('penulis')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="sampul" class="form-label">Sampul</label>
        <input type="file" name="sampul" class="form-control p-1 @error('sampul') is-invalid @enderror"
          value="{{ $program->sampul }}">


        @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="gambar-lama">Sampul lama: </label><br>
        <img src="{{ asset('storage/' . $program->sampul) }}" alt="Gambar lama tidak ditemukan"
          style="max-height: 200px; max-width: 200px;" class="img-responsive">
      </div>

      <div class="form-group">
        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        <a href="/admin/program" class="btn btn-secondary">Kembali</a>
      </div>
    </form>

  </div>
</div>

<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Data gambar program</h3>
  </div>

  <div class="card-body">

    <form action="/admin/program/{{ $program->slug }}/gambar/tambah" method="POST" enctype="multipart/form-data" class="row row-cols-lg-auto g-3 align-items-center">
      @csrf
      <div class="form-group col-8">
        <div class="input-group">
          <label for="" class="input-group-text">Tambah gambar: </label>
          <input type="file" name="gambars[]" class="form-control p-1 @error('sampul') is-invalid @enderror" multiple required>
  
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

    <hr>

    <div class="form-group">
      <label for="">Daftar gambar program</label>


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
          @foreach ($program->gambar as $gambar)
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

@section('css')
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@stop

@section('js')
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

@stop