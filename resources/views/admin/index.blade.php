@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
  <h1>Daftar Berita</h1>
@stop

@section('content')
  <a href="/admin/posts/create">Tambah berita baru</a>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Category</th>
      <th>Author</th>
      <th>Action</th>
    </tr>
    @foreach ($posts as $post)
      <tr>
        <td>{{ $post['id'] }}</td>
        <td>{{ $post['title'] }}</td>
        <td>{{ $post['category'] }}</td>
        <td>{{ $post['author'] }}</td>
        <td><a href="/admin/posts/{{ $post->id }}">view</a> 
          <br/>
          <a href="/admin/posts/{{ $post->id }}/edit">edit</a> 
          <form action="/admin/posts/{{ $post->id }}/destroy" method="post">
            @csrf
            @method('delete')
            <x-adminlte-button class="btn-flat" type="submit" name="submit" value="delete" label="delete" theme="danger" icon="fas fa-md fa-trash"/>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop