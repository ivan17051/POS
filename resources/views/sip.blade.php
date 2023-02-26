@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Detil SIP
@endsection

@section('modal')
<!-- Classic Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah SIP</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
            </div>
            <form class="form-horizontal input-margin-additional" method="POST" action="{{route('sip.store')}}">
                <input type="hidden" name="idstr" value="{{$str->id}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nomor STR</label>
                                <input type="text" class="form-control" name="nomorstr" value="{{$str->nomor}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tanggal Exp.</label>
                                <input type="text" class="form-control datepicker" name="tanggal" value="{{$str->expiry}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nomor SIP</label>
                                <input type="text" class="form-control" name="nomor" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tanggal SIP</label>
                                <input type="date" class="form-control datepicker" name="since" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Sarana Praktik</label>
                                <input type="text" class="form-control" name="idfaskes" value="" required>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Alamat Praktik</label>
                                <input type="text" class="form-control" name="alamatpraktik" value="" required disabled>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link text-primary">Simpan</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  End Modal -->
<!-- Classic Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit SIP</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
            </div>
            <form class="form-horizontal input-margin-additional" method="POST" action="{{route('sip.store')}}">
                <input type="hidden" name="id" >
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nomor STR</label>
                                <input type="text" class="form-control" name="nomorstr" value="{{$str->nomor}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tanggal Exp.</label>
                                <input type="text" class="form-control datepicker" name="tanggal" value="{{$str->expiry}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nomor SIP</label>
                                <input type="text" class="form-control" name="nomor" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tanggal SIP</label>
                                <input type="date" class="form-control datepicker" name="since" required>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Sarana Praktik</label>
                                <input type="text" class="form-control" name="idfaskes" value="" required>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Alamat Praktik</label>
                                <input type="text" class="form-control" name="alamatpraktik" value="" required disabled>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link text-primary">Simpan</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  End Modal -->
<!-- Modal Hapus -->
<div class="modal fade modal-mini modal-primary" id="delete" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
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
                <i class="material-icons">account_balance_wallet</i>
            </div>
            <h4 class="card-title">Detil SIP</h4>
        </div>
        <div class="card-body">
        <div class="description">
            <h4 class="info-title">{{$str->pegawai->nama}}</h4>
            <p class="description">
                Nomor STR: {{$str->nomor}} 
            </p>
        </div>
        <div class="toolbar row">
                <div class="col">
                    
                </div>
                <div class="col-2 text-right">
                    <button class="btn btn-sm btn-success" id="#buttontambah" data-toggle="modal" data-target="#tambah" >tambah</button>
                </div>
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Sarana Praktik</th>
                        <th class="disabled-sorting" >Alamat</th>
                        <th>Sejak</th>
                        <th>Hingga</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if( !count($sip) )
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada SIP</td>
                        </tr>
                        @else
                        @foreach($sip as $key => $s)
                        <tr>
                            <td>{{ $s->nomor }}</td>
                            <td>{{ $s->namafaskes }}</td>
                            <td>{{ $s->alamatfaskes }}</td>
                            <td>{{ Carbon\Carbon::parse($s->since)->format('d/m/Y') }}</td>
                            <td>{{ isset($s->expiry) ? $s->expiry : "Mengikuti STR" }}</td>
                            <td class="text-right">
                                <button data-toggle="tooltip" data-placement="left" title="Edit" class="btn btn-link btn-warning btn-just-icon edit btn-sm" data-key="{{$key}}" onclick="onEdit(this)"><i class="material-icons">edit</i></button>
                                <button data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-link btn-danger btn-just-icon remove btn-sm" data-key="{{$key}}" onclick="onDelete(this)"><i class="material-icons">delete</i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                   
                    </tfoot>
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
    var oTable;
    var now = moment();
    var sip = @json($sip);

    function onEdit(self) {
        var key = parseInt(self.dataset.key);
        var data = sip[key];
        var $modal=$('#edit');
        
        $modal.find('[name=id]').val(data['id']);
        $modal.find('[name=nomor]').val(data['nomor']).change();
        $modal.find('[name=since]').val(data['since']).change();
        $modal.find('[name=idfaskes]').val(data['idfaskes']).change();
        $modal.find('[name=alamatpraktik]').val(data['alamatpraktik']).change();
        $modal.modal('show');
    } 

    function onDelete(self) {
        var key = parseInt(self.dataset.key);
        var data = sip[key];
        var $modal=$('#delete');

        $modal.find('form').attr('action', "{{route('sip.destroy', ['idsip'=>''])}}/"+data['id']);
        $modal.modal('show');
    } 

    $(document).ready(function(){

    });
</script>
@endsection