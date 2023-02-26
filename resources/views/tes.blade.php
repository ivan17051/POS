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
                <input type="hidden" name="idstr" value="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nomor STR</label>
                                <input type="text" class="form-control" name="nomorstr" value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tanggal Exp.</label>
                                <input type="text" class="form-control datepicker" name="tanggal" value="" disabled>
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
                                <input type="text" class="form-control" name="nomorstr" value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tanggal Exp.</label>
                                <input type="text" class="form-control datepicker" name="tanggal" value="" disabled>
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
            <h4 class="card-title">TES</h4>
        </div>
        <div class="card-body">
            <ul>
                <li><router-link class="nav-link" to="/component1" >COMPONENT 1</router-link></li>
                <li><router-link class="nav-link" to="/component2" >COMPONENT 2</router-link></li>
                <li><router-link class="nav-link" to="/component3" >COMPONENT 3</router-link></li>
            </ul>
            <div id="app">
                
            </div>
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection

@section('script')

@endsection