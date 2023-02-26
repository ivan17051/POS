@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Detil STR
@endsection

@section('modal')
@php
$date = Carbon\Carbon::now()->format('Y-m-d');

@endphp
<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Tambah STR </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="material-icons">clear</i>
        </button>
    </div>
    <form class="form-horizontal input-margin-additional" method="POST" action="{{route('str.store')}}">
    @csrf
    <div class="modal-body">
      <input type="hidden" name="idpegawai" value="{{$pegawai->id}}">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nomor" class="bmd-label-floating">Nama</label>
              <input type="text" class="form-control" value="{{$pegawai->nama}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="nomor" class="bmd-label-floating">Nomor</label>
              <input type="text" class="form-control" id="nomor" name="nomor" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="nomorrekom" class="bmd-label-floating">Nomor Rekom</label>
              <input type="text" class="form-control" id="nomorrekom" name="nomorrekom" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="nohp" class="bmd-label-floating">Tanggal Penetapan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$date}}" required>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama" class="bmd-label-floating">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="since" name="since" value="{{$date}}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggallahir" class="bmd-label-floating">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="expiry" name="expiry" value="{{$date}}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
          <label for="alamat" class="bmd-label-floating">Pekerjaan</label>
          <input type="text" class="form-control" id="peruntukan" name="peruntukan" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-link text-primary">Simpan</button>
        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
    </div>
    </form>
    </div>
  </div>
</div>
<!--  End Modal Tambah -->

<!-- Modal Edit -->
<div class="modal fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Sunting Pegawai </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="material-icons">clear</i>
        </button>
    </div>
    <form class="form-horizontal input-margin-additional" method="POST" action="{{route('str.store')}}">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="id">
        <input type="hidden" name="idpegawai">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nomor" class="bmd-label-floating">Nama</label>
              <input type="text" class="form-control" value="{{$pegawai->nama}}" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="nomor" class="bmd-label-floating">Nomor</label>
              <input type="text" class="form-control" id="nomor" name="nomor" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="nomorrekom" class="bmd-label-floating">Nomor Rekom</label>
              <input type="text" class="form-control" id="nomorrekom" name="nomorrekom" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="nohp" class="bmd-label-floating">Tanggal Penetapan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama" class="bmd-label-floating">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="since" name="since" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggallahir" class="bmd-label-floating">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="expiry" name="expiry" required>
                </div>
            </div>
        </div>
        <div class="form-group">
          <label for="alamat" class="bmd-label-floating">Pekerjaan</label>
          <input type="text" class="form-control" id="peruntukan" name="peruntukan" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-link text-primary">Simpan</button>
        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
    </div>
    </form>
    </div>
  </div>
</div>
<!-- End Modal Edit -->

<!-- Modal Hapus -->
<div class="modal fade modal-mini modal-primary" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        </div>
        <form class="" method="POST" action="">
            @method('DELETE')
            @csrf
        <div class="modal-body text-center">
            <p>Yakin ingin menghapus?</p>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-danger btn-link">Ya, Hapus
                <div class="ripple-container"></div>
            </button>
        </div>
        </form>
        </div>
    </div>
</div>
<!--  end modal Hapus -->
@endsection

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Nakes</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">STR</a></li>
            <li class="breadcrumb-item active" aria-current="page">SIP</li>
        </ol>
    </nav>
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">badge</i>
            </div>
            <h4 class="card-title">
              <div class="row">
                <div class="col">Detil STR</div>
                <div class="col text-right"><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambah">Tambah</button></div>
              </div>
            </h4>
        </div>
        <div class="card-body">
        <div class="toolbar row">    
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                      <tr>
                        <th hidden>id</th>
                        <th hidden>nomor</th>
                        <th data-priority="1">Nomor Rekom</th>
                        <th data-priority="3">Tanggal Penetapan</th>
                        <th data-priority="2">Masa Berlaku</th>
                        <th hidden>since</th>
                        <th hidden>expiry</th>
                        <th hidden>peruntukan</th>
                        <th style="width:15%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($str as $unit)
                      <tr>
                        <td hidden>{{$unit->id}}</td>
                        <td hidden>{{$unit->nomor}}</td>
                        <td>{{$unit->nomorrekom}}</td>
                        <td>{{date_format(date_create($unit->tanggal), "d-m-Y")}}</td>
                        <td>{{date_format(date_create($unit->since), "d-m-Y")}} -> {{date_format(date_create($unit->expiry), "d-m-Y")}}</td>
                        <td hidden>{{$unit->since}}</td>
                        <td hidden>{{$unit->expiry}}</td>
                        <td hidden>{{$unit->peruntukan}}</td>
                        <td hidden>{{$unit->tanggal}}</td>
                        <td><a href="{{url('/sip/'.$unit->id)}}" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i></a>&nbsp
                          <button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp
                          <button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">close</i></button></td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection

@section('script')
<script>
  function edit(self){
    var $modal=$('#sunting');
    var tr = $(self).closest('tr');
    
    var id=tr.find("td:eq(0)").text().trim(); 
    var idpegawai='{{$pegawai->id}}';
    var nomor=tr.find("td:eq(1)").text().trim(); 
    var nomorrekom=tr.find("td:eq(2)").text().trim(); 
    var since=tr.find("td:eq(5)").text().trim();
    var expiry=tr.find("td:eq(6)").text().trim(); 
    var peruntukan=tr.find("td:eq(7)").text().trim(); 
    var tanggal=tr.find("td:eq(8)").text().trim();
    
    $modal.find('input[name=id]').val(id).change();
    $modal.find('input[name=idpegawai]').val(idpegawai).change();
    $modal.find('input[name=nomor]').val(nomor).change();
    $modal.find('input[name=nomorrekom]').val(nomorrekom).change();
    $modal.find('input[name=since]').val(since).change();
    $modal.find('input[name=expiry]').val(expiry).change();
    $modal.find('input[name=peruntukan]').val(peruntukan).change();
    $modal.find('input[name=tanggal]').val(tanggal).change();

    $modal.modal('show');
}

function hapus(self){
  $modal=$('#hapus');
  var tr = $(self).closest('tr');
  var id=tr.find("td:eq(0)").text().trim(); 
  
  $modal.find('form').attr('action', "{{route('str.destroy', ['id'=>''])}}/"+id);
  $modal.modal('show');
}
  var oTable;
  var now = moment();

  $(document).ready(function(){

  });
</script>
@endsection