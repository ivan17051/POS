@extends('layouts.layout')
@extends('layouts.sidebar')

@php
$role = Auth::user()->role;
@endphp

@section('title')
Member
@endsection

@section('masterShow')
show
@endsection

@section('memberStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Supplier</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form class="form-horizontal input-margin-additional" method="POST" action="{{route('member.store')}}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat" class="bmd-label-floating">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="notelp" class="bmd-label-floating">No. Telepon</label>
                <input type="text" class="form-control" id="notelp" name="notelp">
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Sunting Data Supplier</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form class="form-horizontal input-margin-additional" method="POST" action="{{route('member.store')}}">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat" class="bmd-label-floating">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="notelp" class="bmd-label-floating">No. Telepon</label>
                <input type="text" class="form-control" id="notelp" name="notelp">
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
<div class="modal fade modal-mini modal-primary" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
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
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Data Member</h4>
          </div>
        </div>
        <div class="card-body">
            <div class="toolbar text-right">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">Tambah</button>
            </div>
            
            <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                <tr>
                    <th hidden>id</th>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Nama</th>
                    <th data-priority="3">Alamat</th>
                    <th data-priority="3">No Telp</th>
                    <th data-priority="2" class="disabled-sorting text-right">Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th hidden>id</th>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th class="disabled-sorting text-right">Actions</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($member as $key=>$unit)
                <tr>
                    <td hidden>{{$unit->id}}</td>
                    <td>{{$key+1}}</td>
                    <td>{{$unit->nama}}</td>
                    <td>{{$unit->alamat}}</td>
                    <td>{{$unit->notelp}}</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-link btn-warning btn-just-icon edit btn-sm" key="{{$key}}" onclick="onEdit(this)"><i class="material-icons">edit</i></a>
                        <a href="#" class="btn btn-link btn-danger btn-just-icon remove btn-sm" key="{{$key}}" onclick="onDelete(this)"><i class="material-icons">delete</i></a>
                    </td>
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
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('public/js/plugins/bootstrap-tagsinput.js')}}"></script>
<script>
var table;
var myUsers = @json($member);

//ketika klik edit
function onEdit(self) {
    var key = $(self).attr('key');
    var j = myUsers[key];
    
    $modal=$('#modalEdit');
    
    $modal.find('[name=id]').val(j['id']).change();
    $modal.find('[name=nama]').val(j['nama']).change();
    $modal.find('[name=alamat]').val(j['alamat']).change();
    $modal.find('[name=notelp]').val(j['notelp']).change();
    
    $modal.find('form').attr('action', "{{route('member.update', ['id'=>''])}}/"+j['id']);
    $modal.modal('show');
} 

//ketika klik delete
function onDelete(self) {
    var key = $(self).attr('key');
    var j = myUsers[key];
    $modal=$('#modalDelete');

    $modal.find('form').attr('action', "{{route('member.destroy', ['id'=>''])}}/"+j['id']);
    $modal.modal('show');
} 

$(document).ready(function() {
    my.initFormExtendedDatetimepickers();
    if ($('.slider').length != 0) {
        md.initSliders();
    }

    table = $('#datatables').DataTable({
        responsive:{
            details: false
        },
        columnDefs: [
            {   
                class: "details-control",
                orderable: false,
                targets: 0
            }
        ]
    });

} );
</script>
@endsection