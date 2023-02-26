@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Profesi
@endsection

@section('masterShow')
show
@endsection

@section('profesiStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah Profesi -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Profesi </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('profesi.store')}}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama Profesi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Maks SIP</label>
                <input type="text" class="form-control" id="makssip" name="makssip" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value=1 id="isparent" name="isparent"> Profesi
                  Memiliki Spesialisasi
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
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
<!--  End Modal Tambah Profesi -->

<!-- Modal Edit Profesi -->
<div class="modal fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sunting Profesi </h4>
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
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama Profesi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Maks SIP</label>
                <input type="text" class="form-control" id="makssip" name="makssip" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" id="isparent" name="isparent"> Profesi
                  Memiliki Spesialisasi
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
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
<!-- End Modal Edit Profesi -->

<!-- Modal Hapus Profesi -->
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
<!--  end modal Hapus Profesi -->

<!-- Modal Tambah Spesialisasi -->
<div class="modal fade" id="tambahsp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Spesialisasi </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('spesialisasi.store')}}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama Spesialisasi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
            </div>
            <div class="col-md-12">
              <input type="hidden" name="idprofesi" value="">
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
<!--  End Modal Tambah Spesialisasi -->

<!-- Modal Edit Spesialisasi -->
<div class="modal fade" id="suntingsp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sunting Spesialisasi </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" id="formeditsp" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" name="id">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama Spesialisasi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
            </div>
            <div class="col-md-12">
              <select name="idprofesi" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Pilih Profesi">
                <option disabled selected>Piih Profesi</option>
                @foreach($profesi as $unit)
                @if($unit->isparent==1)
                <option value="{{$unit->id}}">{{$unit->nama}}</option>
                @endif
                @endforeach
              </select>
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
<!-- End Modal Edit Spesialisasi -->

<!-- Modal Hapus Spesialisasi -->
<div class="modal fade modal-mini modal-primary" id="hapussp" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
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
<!--  end modal Hapus Spesialisasi -->

@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Data Profesi dan Spesialisasi</h4>
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
                    <th data-priority="1">Nama Profesi</th>
                    <th data-priority="2">Maks SIP</th>
                    <th data-priority="2">Total Profesi</th>
                    <th data-priority="3">Punya Spesialisasi</th>
                    <th data-priority="3" class="disabled-sorting text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($profesi as $key=>$unit)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$unit->nama}} <span class="badge badge-pill badge-info">{{$unit->kode}}</span></td>
                    <td>{{$unit->makssip}}</td>
                    <td>{{$unit->total}}</td>
                    <td>
                      @if($unit->isparent == 1)
                      <span class="badge badge-pill badge-success">Spesialisasi</span>
                      @endif
                    </td>
                    <td class="text-right">
                      @if($unit->isparent == 1)
                      <button class="btn btn-info btn-link" style="padding:5px;" onclick="show({{$unit->id}})"><i
                          class="material-icons">launch</i></button>&nbsp
                      @endif
                      <button type="button" class="btn btn-warning btn-link" style="padding:5px;"
                        onclick="edit({{$unit}})"><i class="material-icons">edit</i></button>&nbsp
                      <button type="button" class="btn btn-danger btn-link" style="padding:5px;"
                        onclick="hapus({{$unit->id}})"><i class="material-icons">delete</i></button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="anim slide hidden" id="nakes-container">
            

            <div class="material-datatable">
              <table id="datatables2" class="table table-striped table-no-bordered table-hover">
                <thead>
                  <!-- <tr>
                    <th data-priority="2" style="width:30px;" class="disabled-sorting">No</th>
                    <th data-priority="1">Nama Spesialisasi</th>
                    <th data-priority="2" class="disabled-sorting text-right">Aksi</th>
                  </tr> -->
                </thead>
                <tbody>
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
  $('#isparent').click(function(){
    if($(this).prop("checked") == true){
      
    } else{
      
    }
    
  });
  function back() {
    $('#nakes-container').addClass('hidden');
    $('#btnkembali').attr('hidden', true);
    $('#table-container').removeClass('hidden');
    $('#btntambah').attr('data-target', '#tambah');
    if ($.fn.dataTable.isDataTable('#datatables2')) {
      $('#datatables2').DataTable().clear();
      $('#datatables2').DataTable().destroy();
      $('#datatables2').empty();
    }
  }

  function daftarNakes(self) {
    var tr = $(self).closest('tr');
    var data = oTable.row(tr).data();

    $('#table-container').addClass('hidden')
    $('#nakes-container').removeClass('hidden')
  }

  function show(x){
    $('#table-container').addClass('hidden');
    $('#nakes-container').removeClass('hidden');
    $('#btnkembali').attr('hidden', false);
    $('#btntambah').attr('data-target', '#tambahsp');
    $('#tambahsp').find('input[name=idprofesi]').val(x).change();

    table2 = $('#datatables2').DataTable({
      ajax: {
        url: '{{route("spesialisasi.get", ["id"=>""])}}/'+x,
        dataSrc: ''
      },
      columns: [
        {data: 'id', title: 'ID', width: '10%'},
        {data: 'nama', title: 'Nama Spesialisasi'},
        {data: 'total', title: 'Total', render: function(e,d,row){
          if(e) return e;
          else return 0;
        }},
        {data: 'id', title: 'Aksi', style: 'text-right', render: function(e,d,row){
          return '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="editspesial('+e+',\''+row['nama']+'\','+row['idprofesi']+')"><i class="material-icons">edit</i></button>&nbsp'+
                  '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapusspesial('+e+')"><i class="material-icons">delete</i></button>'
        }}
      ],
      columnDefs: [
        {   
          class: "details-control",
          orderable: false,
          targets: 0
        },
        {
          class: "text-right",
          orderable: false,
          targets: 3
        }
      ]
    });
    
  }

  function edit(data){
      var $modal=$('#sunting');
      
      $('#formedit').attr('action', '{{route("profesi.update", ["id"=>""])}}/'+data['id']);
      $modal.find('input[name=id]').val(data['id']);
      $modal.find('input[name=nama]').val(data['nama']).change();
      $modal.find('input[name=makssip]').val(data['makssip']).change();
      if(data['isparent']==1){
        $modal.find('input[name=isparent]').prop('checked', true);
      } else{
        $modal.find('input[name=isparent]').prop('checked', false);
      }
      
      $modal.modal('show');
  }

  function hapus(id){
    $modal=$('#hapus');
    $modal.find('form').attr('action', "{{route('profesi.destroy', ['id'=>''])}}/"+id);
  
    $modal.modal('show');
  }

  function editspesial(id, nama, idprofesi){
      var $modal=$('#suntingsp');
      
      $('#formeditsp').attr('action', '{{route("spesialisasi.update", ["id"=>""])}}/'+id);
      $modal.find('input[name=id]').val(id).change();
      $modal.find('input[name=nama]').val(nama).change();
      $modal.find('select[name=idprofesi]').val(idprofesi).change().blur();
      
      $modal.modal('show');
  }

  function hapusspesial(id){
    $modal=$('#hapussp');
    $modal.find('form').attr('action', "{{route('spesialisasi.destroy', ['id'=>''])}}/"+id);
  
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