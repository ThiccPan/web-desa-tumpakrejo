@extends('layouts.main')
@section('container')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Detail Galeri</h1>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data</h3>
        <div class="card-tools">
          <a href="/tambah_galeri">
            <div class="input-group input-group-sm" style="width: 150px;">
              <button type="button" class="btn btn-block btn-success">Tambah Gambar</button>
            </div>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="col-sm-12">
          <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
            <thead>
              <tr role="row">
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Album</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Gambar</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1; ?>
              <tr class="odd">
                <td><?php echo $no++ ?></td>
                <td>17 agustus</td>
                <td><img src="20220718_115146.jpg" alt="" style="width:100px;height:50px;"></td>
                <td>
                  <a href="/edit_galeri">
                    <div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>
                  </a>
                  <div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>
                </td>
              </tr>
              <tr class="even">
                <td><?php echo $no++ ?></td>
                <td>17 agustus</td>
                <td><img src="20220718_115146.jpg" alt="" style="width:100px;height:50px;"></td>
                <td>
                  <a href="/edit_galeri">
                    <div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>
                  </a>
                  <div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection