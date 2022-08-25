@extends('layouts.main')

@section('container')

<h1 class="text-center">{{ $name }}</h1>
    <div class="row mb-4 mt-4">
        <h3 class="text-center border-3 border-bottom border-top border-danger">Aparatur Desa</h3>
    </div>

<div class="row mb-4">

  @if($aparaturs->count())

  @foreach ($aparaturs as $aparatur)

  <div class="col-md-6">
    <div class="card mb-3" style="max-width: 100%;">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="{{ asset('storage/' . $aparatur->gambar)}}" class="img-fluid" alt="{{ asset('storage/' . $aparatur->gambar)}}">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{ $aparatur->nama }}</h5>
            <p class="card-text">{{ $aparatur->jabatan }}</p>
            <div class="col align-self-end">
              <p class="card-text">
                <small class="text-muted">NIP : {{ $aparatur->NIP }}</small> <br>
                <small class="text-muted">Tanggal Menjabat : {{ $aparatur->tanggal_menjabat }}</small>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endforeach

  @else
    <p class="text-center fs-4">Belum ada data.</p>
  @endif

</div>

@endsection