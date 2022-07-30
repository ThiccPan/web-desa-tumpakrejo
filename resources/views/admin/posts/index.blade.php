@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Daftar Berita</h1>
@stop

@section('content')
<a href="/admin/posts/create">Tambah berita baru</a>
<table border="1">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
              <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['category'] }}</td>
                <td>{{ $post['author'] }}</td>
                <td>
                  <a href="/admin/posts/{{ $post->id }}" class="btn btn-primary" icon="fas fa-md fa-trash">Lihat</a>
                  <a href="/admin/posts/{{ $post->id }}/edit" class="btn btn-warning ">Edit</a>
                  <form action="/admin/posts/{{ $post->id }}/destroy" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger mt-1" type="submit" name="submit" value="delete" label="delete">Hapus</button>
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
</table>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  console.log('Hi!'); 
</script>
@stop