@extends('adminlte::page')

@section('title', 'Add New Post')

@section('content_header')
    <h1>Create New Post</h1>
@stop

@section('content')
  <form action="/admin/posts/insert" method="post" enctype="multipart/form-data">
    @csrf
    title: <input type="text" name="title" id=""><br>
    description: <input type="textarea" name="description" id=""><br>
    category: <input type="text" name="category" id=""><br>
    author: <input type="text" name="author" id=""><br>
    <input type="submit" value="submit" name="submit">
  </form>
  <a href="/admin/posts">kembali</a>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop