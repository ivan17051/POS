@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Data Nakes
@endsection

@section('nakesStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Tambah Nakes </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="material-icons">clear</i>
        </button>
    </div>
    <form class="form-horizontal input-margin-additional" method="POST" action="{{route('nakes.store')}}">
    @csrf
    <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div class="form-check float-right" style="transform: scale(0.8);">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="isauto" checked> auto
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
              <label class="bmd-label force-top">NOMOR REGIS <small class="text-danger align-text-top">*wajib</small></label>
              <input type="text" class="form-control" id="nomorregis" name="nomorregis" maxlength="4" value="DIISI OLEH SISTEM" pattern="[0-9]{1,4}" required disabled>
            </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <label for="nama" class="bmd-label-floating">Nama <small class="text-danger align-text-top">*wajib</small></label>
                  <input type="text" class="form-control" id="nama" name="nama" maxlength="150" required>
              </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="nik" class="bmd-label-floating">NIK <small class="text-danger align-text-top">*wajib</small></label>
              <input type="text" class="form-control" id="nik" name="nik" maxlength="16" required>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label force-top">Jenis Kelamin <small class="text-danger align-text-top">*wajib</small></label>
              <select class="selectpicker" data-style="btn btn-primary btn-round" id="jeniskelamin" title="Jenis Kelamin" name="jeniskelamin" required>
                <option value="L">L</option>
                <option value="P">P</option>
              </select>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <label for="tempatlahir" class="bmd-label-floating" >Tempat Lahir</label>
                  <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" maxlength="20" >
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <label for="tanggallahir" class="bmd-label-floating">Tanggal Lahir</label>
                  <input name="tanggallahir" type="date" id="tanggallahir"  class="form-control" value="{{date('Y-m-d')}}" />
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                  <label for="nohp" class="bmd-label-floating">No. HP</label>
                  <input type="text" class="form-control" id="nohp" name="nohp" maxlength="30" >
              </div>
          </div>
      </div>
      <div class="form-group">
        <label for="alamatktp" class="bmd-label-floating">Alamat KTP</label>
        <input type="text" class="form-control" id="alamatktp" name="alamatktp" maxlength="250" >
      </div>
      <div class="form-group">
        <label for="alamat" class="bmd-label-floating">Alamat Domisili</label>
        <input type="text" class="form-control" id="alamat" name="alamat" maxlength="250" >
      </div>
      <div class="form-group">
        <label class="bmd-label force-top">Peruntukan <small class="text-danger align-text-top">*wajib</small></label>
        <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Single Select" name="idprofesi" data-size="7" data-live-search="true" required>
          <option value="" >Peruntukan</option>
          @foreach($profesi as $p)
          <option value="{{$p->id}}" data-isparent="{{$p->isparent}}" >{{$p->nama}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group spesialisasi-wrapper" hidden >
        <label class="bmd-label force-top">Spesialisasi <small class="text-danger align-text-top">*wajib</small></label>
        <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Spesialisasi" name="idspesialisasi" data-size="7" data-live-search="true" required>
        </select>
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
            <h4 class="modal-title">Edit Nakes </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form class="form-horizontal input-margin-additional" method="POST" action="{{route('nakes.update')}}" onsubmit="onSubmitUpdateForm(event)">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-check float-right" style="transform: scale(0.8);">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="isauto"> auto
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>
                    <label class="bmd-label force-top">NOMOR REGIS <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="text" class="form-control" id="nomorregis" name="nomorregis" maxlength="4" pattern="[0-9]{1,4}" required>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama" class="bmd-label-floating">Nama <small class="text-danger align-text-top">*wajib</small></label>
                        <input type="text" class="form-control" name="nama" maxlength="150" required>
                    </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nik" class="bmd-label-floating">NIK <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="text" class="form-control" name="nik" maxlength="16" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <label class="bmd-label force-top">Jenis Kelamin <small class="text-danger align-text-top">*wajib</small></label>
                      <select class="selectpicker" data-style="btn btn-primary btn-round" title="Jenis Kelamin" name="jeniskelamin" required>
                        <option value="L">L</option>
                        <option value="P">P</option>
                      </select>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama" class="bmd-label-floating" >Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempatlahir" maxlength="20" >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tanggallahir" class="bmd-label-floating">Tanggal Lahir</label>
                        <input type="date" class="form-control" value="{{date('Y-m-d')}}"  name="tanggallahir" >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nohp" class="bmd-label-floating">No. HP</label>
                        <input type="text" class="form-control" name="nohp" maxlength="30" >
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label for="alamatktp" class="bmd-label-floating">Alamat KTP</label>
              <input type="text" class="form-control" name="alamatktp" maxlength="250" >
            </div>
            <div class="form-group">
              <label for="alamat" class="bmd-label-floating">Alamat Domisili</label>
              <input type="text" class="form-control" name="alamat" maxlength="250" >
            </div>
            <div class="form-group">
              <label class="bmd-label force-top">Peruntukan <small class="text-danger align-text-top">*wajib</small></label>
              <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Single Select" name="idprofesi" data-size="7" data-live-search="true" required>
                <option value="" >Peruntukan</option>
                @foreach($profesi as $p)
                <option value="{{$p->id}}" data-isparent="{{$p->isparent}}" >{{$p->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group spesialisasi-wrapper" hidden >
              <label class="bmd-label force-top">Spesialisasi <small class="text-danger align-text-top">*wajib</small></label>
              <select class="selectpicker form-control" data-style="btn btn-primary btn-round" title="Spesialisasi" name="idspesialisasi" data-size="7" data-live-search="true" required>
              </select>
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
          <p class="mb-0">Yakin ingin menghapus?</p>
          <small style="color:grey">Data STR dan SIP nakes akan ikut dihapus</small>
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
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <i class="material-icons">group</i>
          </div>
          <h4 class="card-title">
            <div class="row">
              <div class="col">Data Nakes</div>
              <div class="col text-right"><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">Tambah</button></div>
            </div>
          </h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <div class="filter-tags" data-select="#selectrole" data-tags="#tagsinput" data-col="3">
              <div class="form-group d-inline-block" style="width: 150px;">
                  <div class="row">
                      <div class="col">
                      <select id="selectrole" class="selectpicker" data-style2="btn-default btn-round btn-sm text-white" data-style="select-with-transition" multiple title="Filter Profesi" data-size="7" data-live-search="true">
                          <optgroup label="Profesi">
                            @foreach($profesi as $unit)
                              <option value="{{$unit->nama}}">{{$unit->nama}}</option>
                            @endforeach
                          </optgroup>
                      </select>
                      </div>
                  </div>
              </div>
              <div class="h-100 d-inline-block">
                  <input id="tagsinput" hidden type="text" value="" class="form-control tagsinput" data-role="tagsinput" data-size="md" data-color="primary" data-role="filter">
              </div>
            </div>
          </div>
          <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
              </thead>
              <tbody>
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
  function show(self){
      var $modal=$('#sunting');
      var tr = $(self).closest('tr');
      let idx = oTable.row(tr)[0]
      var data = oTable.data()[idx];
      
      window.location.href = "{{url('/str')}}/"+data['id'];
  }

  function edit(self){
      var $modal=$('#sunting');
      var tr = $(self).closest('tr');
      let idx = oTable.row(tr)[0]
      var data = oTable.data()[idx];
    
      $modal.find('input[name=nomorregis]').data('value', data['nomorregis']);
      $modal.find('[name=isauto]').prop('checked', true).change();

      $modal.find('input[name=id]').val(data['id']);
      $modal.find('input[name=nik]').val(data['nik']).change();
      $modal.find('input[name=nama]').val(data['nama']).change();
      $modal.find('input[name=tempatlahir]').val(data['tempatlahir']).change();
      $modal.find('input[name=tanggallahir]').val( data['tanggallahir'].substr(0,10) ).change();
      $modal.find('select[name=jeniskelamin]').val(data['jeniskelamin']).change();
      $modal.find('input[name=alamatktp]').val(data['alamatktp']).change();
      $modal.find('input[name=alamat]').val(data['alamat']).change();
      $modal.find('input[name=nohp]').val(data['nohp']).change();

      $modal.find('select[name=idspesialisasi]').data( "value" , data['idspesialisasi']);
      let $inputprofesi = $modal.find('select[name=idprofesi]')
      $inputprofesi.data('value',data['idprofesi'])
      $inputprofesi.val(data['idprofesi']).change();

      $modal.modal('show');
  }

  function hapus(self){
    $modal=$('#hapus');
    var tr = $(self).closest('tr');
    let idx = oTable.row(tr)[0]
    var data = oTable.data()[idx];
    
    $modal.find('form').attr('action', "{{route('nakes.delete', ['id'=>''])}}/"+data['id']);
    $modal.modal('show');
  }

  function onSubmitUpdateForm(e){
    e.preventDefault()
    let $self = $(e.target)
    let selfDOM = $self[0]
    let $inputprofesi = $self.find('select[name=idprofesi]')

    if($inputprofesi.data('value') != $inputprofesi.val()){
      swal({
        title: 'Yakin mengubah profesi?',
        text: "nomor regis akan berubah secara otomatis",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        buttonsStyling: false
      }).then( function(isConfirm){
        if(isConfirm) selfDOM.submit();
      }).catch(swal.noop)
    }else{
      selfDOM.submit();
    }
  }

  $(document).ready(function(){
      my.initFormExtendedDatetimepickers()

      // toggle onchange profesi
      $('[name=idprofesi]').change(function(e){
        let $wrapper = $(e.target).closest('.form-group').siblings('.spesialisasi-wrapper')
        my.toggleSpesialisasi(e, $wrapper)
      })
      // end toggle onchange profesi

      // toggle onchange isauto nomor regis
      $('[name=isauto]').change(function(e){
        let $wrapper = $(e.target).closest('.form-group')
        let $input = $wrapper.find('[name=nomorregis]')
        if(e.target.checked){
          $input.prop("disabled", true) 
          $input.val($input.data('value') || 'DIISI OLEH SISTEM');
        }else{
          $input.prop("disabled", false) 
          $input.val($input.data('value') || '');
        }
        
      })
      // end toggle onchange isauto nomor regis

      oTable = $("#datatables").DataTable({
          bAutoWidth: false, 
          select:{
              className: 'dataTable-selector form-select'
          },
          responsive: true,
          processing: true,
          serverSide: true,
          ajax: {type: "POST", url: '{{route("nakes.data")}}', data:{'_token':@json(csrf_token())}},
          columns: [
              { data:'id', title:'ID', visible: false},
              { data:'nik', title:'NIK'},
              { data:'nama', title:'Nama'},
              { data:'profesi', title:'Profesi'},
              { data:'jeniskelamin', title:'JenisKelamin', visible: false},
              { data:'tempatlahir', title:'TempatLahir'},
              { data:'tanggallahir', title:'TanggalLahir',render: function(e, d, row){
                return new Date(e).toLocaleDateString('id',{ day: 'numeric', month: 'long',year: 'numeric'})
              }},
              { data:'nohp', title:'No. HP'},
              { data:'action', title:'Aksi', width:'10%'},
          ],
      });

      //event pada tags filter
      $(".filter-tags").each(function(){
            var sel= $($(this).data('select'));
            var put=$($(this).data('tags'));
            var col=parseInt($(this).data('col'));
            put.tagsinput('input').attr('hidden',true);
            
            // filter selectpicker on change
            sel.change(function(){
                put.tagsinput('removeAll');

                for (const opt of sel[0].selectedOptions) {
                    put.tagsinput('add', opt.textContent);
                }

                //search nya pakai regex misal "Pusat|Spesial" artinya boleh Pusat atau Spesial
                if(!sel.val().length){
                    oTable.column(col).search( '' ).draw();
                }
                else{
                    var searchStr='^('+sel.val().join('|')+')$';
                    oTable.column(col).search( searchStr , true, false).draw();
                }
            });

            // filter tags input on removed
            put.on('itemRemoved', function(event) {
                let text = event.item;
                let items = []
                for (const opt of sel[0].selectedOptions) {
                    if(opt.textContent != text){
                        items.push(opt.value)
                    }
                }
                sel.selectpicker('val', items);
            });
        });
  });
</script>
@endsection