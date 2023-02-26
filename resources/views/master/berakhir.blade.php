@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Keterangan Berakhir
@endsection

@section('masterShow')
show
@endsection

@section('berakhirStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah Berakhir -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Keterangan Berakhir </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('berakhir.store')}}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label class="bmd-label force-top">Profesi <small class="text-danger align-text-top">*wajib</small></label>
              <select name="idprofesi" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" title="Profesi" required>
                <option disabled selected value="">Pilih Profesi</option>
                @foreach($profesi as $unit)
                <option value="{{$unit->id}}">{{$unit->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mt-3">
              <div class="form-group">
                <label for="keterangan" class="bmd-label-floating">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="tanggal" class="bmd-label-floating">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-link text-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  End Modal Tambah Berakhir -->

<!-- Modal Edit Berakhir -->
<div class="modal fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sunting Keterangan Berakhir </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" id="formedit" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" name="id">
          <div class="row">
            <div class="col-md-12">
              <label class="bmd-label force-top">Profesi <small class="text-danger align-text-top">*wajib</small></label>
              <select name="idprofesi" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" title="Profesi">
                <option disabled selected>Pilih Profesi</option>
                @foreach($profesi as $unit)
                <option value="{{$unit->id}}">{{$unit->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mt-3">
              <div class="form-group">
                <label for="keterangan" class="bmd-label-floating">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="tanggal" class="bmd-label-floating">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-link text-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Edit Berakhir -->

<!-- Modal Hapus Berakhir -->
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
<!--  end modal Hapus Berakhir -->
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Data Keterangan Berakhir</h4>
          </div>
        </div>
        
        <div class="card-body">
          <div class="toolbar row">
            <!-- Here you can write extra buttons/actions for the toolbar -->
            <div class="col">
              <button type="button" id="btnkembali" class="btn btn-sm btn-warning" onclick="back()" hidden>Kembali</button>
            </div>
            <div class="col">
              <div class="text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                    data-target="#tambah">Tambah</button></div>
            </div>
            
          </div>
          <div class="anim slide" id="table-container">
            <div class="material-datatables">
              <table id="datatables1" class="table table-striped table-no-bordered table-hover" cellspacing="0"
                width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th data-priority="3" style="width:30px;" class="disabled-sorting">No</th>
                    <th data-priority="1">Profesi</th>
                    <th data-priority="1">Keterangan Berakhir</th>
                    <th data-priority="2">Kode Tanggal</th>
                    <th data-priority="3" class="disabled-sorting text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($berakhir as $key=>$unit)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$unit->profesi->nama}}</td>
                    <td>{{$unit->keterangan}}</td>
                    <td>{{$unit->tanggal}}</td>
                    <td class="text-right">
                      <button type="button" class="btn btn-warning btn-link" style="padding:5px;"
                        onclick="edit({{$unit}})"><i class="material-icons">edit</i></button>
                      
                      <button type="button" class="btn btn-danger btn-link" style="padding:5px;"
                        onclick="hapus({{$unit->id}})"><i class="material-icons">delete</i></button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
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
  function edit(data){
      var $modal=$('#sunting');
      
      $('#formedit').attr('action', '{{route("berakhir.update", ["id"=>""])}}/'+data['id']);
      $modal.find('input[name=id]').val(data['id']);
      $modal.find('select[name=idprofesi]').val(data['idprofesi']).change().blur();
      $modal.find('input[name=keterangan]').val(data['keterangan']).change();
      $modal.find('input[name=tanggal]').val(data['tanggal']).change();
      $modal.modal('show');
  }

  function hapus(id){
    $modal=$('#hapus');
    $modal.find('form').attr('action', "{{route('berakhir.destroy', ['id'=>''])}}/"+id);
  
    $modal.modal('show');
  }

  $(document).ready(function(){
      
      table = $('#datatables1').DataTable({
        responsive:{
            details: false
        },
        columnDefs: [
            {   
                orderable: false,
                targets: 3
            }
        ]
    });
    
  });
</script>
@endsection