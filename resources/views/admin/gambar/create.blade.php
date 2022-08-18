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

    <form action="/admin/album/{{ $album->slug }}/store" method="post" enctype="multipart/form-data">
      @csrf

      <div>
        <label>Gambar</label>
        <input class="box__file" type="file" name="gambars[]" id="gambars" data-multiple-caption="{count} files selected"
          multiple />
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
    <div class="col-md-12">
      <div class="images-preview-div"> </div>
    </div>
  </div>
</div>
@stop

@section('footer')
@include('partials.footerAdmin')
@stop

@section('css')
<style>
  .invalid-feedback {
    display: block;
  }
  .images-preview-div img
  {
      padding: 10px;
      max-width: 150px;
  }
</style>
@stop

@section('js')
<script src="{{ asset('/js/imgMultiPreview.js') }}"></script>
@stop