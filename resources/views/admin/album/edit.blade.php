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
<h1>Edit Data Album</h1>
@stop

@section('content')
<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Data album</h3>
  </div>
  <div class="card-body">
    <form action="/admin/album/{{ $album->slug }}/update" method="post" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Nama Album</label>
            <input class="form-control" type="text" placeholder="nama album" value="{{ $album->nama }}" name="nama">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Keterangan</label>
            <input class="form-control" type="text" placeholder="keterangan" value="{{ $album->keterangan }}" name="keterangan">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="file">Sampul</label>
        <input class="box__file" type="file" name="sampul" id="gambar1" />
        <br>
        <img src="#" id="preview-tag" style="max-height: 300px; max-width: 300px;" class="img-responsive"/>
      </div>
      <div>
        <p><strong>Sampul Lama</strong></p>
        <img src="{{ asset('storage/' . $album->sampul) }}" alt="" style="max-height: 300px; max-width: 300px;"
          class="img-responsive" id="sampul-lama">
      </div>
      <div class="d-flex flex-row justify-content-end">
        <div class="mr-2">
          <input type="submit" value="Edit" name="submit" class="btn btn-success">
        </div>
        <div class="mr-2">
          <a href="/admin/album">
            <button type="button" class="btn btn-block btn-danger">Batal</button>
          </a>
        </div>
      </div>
  </div>
  </form>
</div>
@stop

@section('footer')
@include('partials.footer')
@stop


@section('js')
<script src="/js/imgPreview.js"></script>
@stop