@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>
              <p>Berita</p>
            </div>
            <div class="icon">
              <i class="fas fa-edit"></i>
            </div>
            <a href="/admin/berita" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53</h3>
              <p>Program Desa</p>
            </div>
            <div class="icon">
              <i class="far fa-handshake"></i>
            </div>
            <a href="/admin/program" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>
              <p>Potensi desa</p>
            </div>
            <div class="icon">
              <i class="fa fa-universal-access"></i>
            </div>
            <a href="/admin/potensi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>
              <p>Produk Unggulan</p>
            </div>
            <div class="icon">
              <i class="far fa fa-shopping-basket"></i>
            </div>
            <a href="/admin/produk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>
              <p>Album</p>
            </div>
            <div class="icon">
              <i class="far fa-image"></i>
            </div>
            <a href="/admin/album" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>
              <p>Pengurus</p>
            </div>
            <div class="icon">
              <i class="far fa fa-users"></i>
            </div>
            <a href="/admin/pengurus" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
      </div>
    </div>
  </section>
@stop

@section('footer')
@include('partials.footer')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop