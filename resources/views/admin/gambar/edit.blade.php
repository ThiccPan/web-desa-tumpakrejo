@extends('adminlte::page')

@section('title', 'Add New Post')

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
<h1>Tambahkan Gambar Baru</h1>
@stop

@section('content')
<div class="card card-default">
  <div class="card-body">

    <form action="/admin/album/update/{{ $gambar->gambar }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div>
        <label>Gambar</label><br>
        <input class="form-control" type="file" name="gambar" id="gambar" data-multiple-caption="{count} files selected"/>
      </div>

      <div>
        <label for="">Gambar baru</label><br>
        {{-- <img src="#" alt="tambahkan gambar" class="img-responsive" style="max-height: 200px; max-width:200px;" id="gambar"> --}}
        <img src="#" id="preview-tag" width="200px" /> 
      </div>

      <div>
        <label for="">Gambar lama</label><br>
        <img src="{{ asset('storage/' . $gambar->gambar) }}" alt="" class="img-responsive" style="max-height: 200px; max-width:200px;">
      </div>

      <div class="form-group">
        <label>Keterangan</label>
        <input class="form-control" type="text" placeholder="keterangan" value="{{ $gambar->keterangan }}" name="keterangan">
      </div>

      <div class="d-flex flex-row justify-content-end">
        <div class="mr-2">
          <button type="submit" class="btn btn-block btn-success">Tambah</button>
        </div>
        <div class="mr-2">
          <a href="/admin/album/{{ $album->slug }}">
            <button type="button" class="btn btn-block btn-danger">Batal</button>
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
@stop

@section('footer')
@include('partials.footerAdmin')
@stop

@section('js')
<script src="{{ asset('js/imgPreview.js') }}"></script>
@stop