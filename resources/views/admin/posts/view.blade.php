@extends('adminlte::page')

@section('title', 'Berita')

@section('content_header')
<h1>Daftar Berita</h1>
@stop

@section('content')
  <h1>{{ $postsView->title }}</h1>
  <h2>{{ $postsView->category }}</h2>
  <h2>{{ $postsView->author }}</h2>
  <p>{{ $postsView->description }}</p>
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script>
    console.log('Hi!'); 
  </script>
@stop