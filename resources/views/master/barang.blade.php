@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Master Barang
@endsection

@section('masterShow')
show
@endsection

@section('barangStatus')
active
@endsection

@section('modal')
@if(isset($kategori))
<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('barang.store')}}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <select name="idkategori" id="idkategori" class="selectpicker" data-size="7" data-style="select-with-transition" required>
                  <option value="" disabled selected> Kategori </option>
                  @foreach($kategori as $unit)
                  <option value="{{$unit->id}}">{{$unit->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="expired" class="bmd-label-floating">Tanggal Expired</label>
                <input type="date" class="form-control" id="expired" name="expired">
              </div>  
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="namabarang" class="bmd-label-floating">Nama Barang</label>
                <input type="text" class="form-control" id="namabarang" name="namabarang" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Kode Barang (Barcode)</label>
                <input type="text" class="form-control" id="kodebarang" name="kodebarang" required>
              </div>  
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="harga_1" class="bmd-label-floating">Harga Satuan</label>
                <input type="text" class="form-control" id="harga_1" name="harga_1" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="harga_3" class="bmd-label-floating">Harga 3</label>
                <input type="text" class="form-control" id="harga_3" name="harga_3" required>
              </div>  
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="harga_6" class="bmd-label-floating">Harga 6</label>
                <input type="text" class="form-control" id="harga_6" name="harga_6" required>
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
<!--  End Modal Tambah Barang -->

<!-- Modal Sunting Barang -->
<div class="modal modal-custom-1 fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sunting Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <form id="formedit" class="form-horizontal input-margin-additional" method="POST" action="">
            @csrf
            @method('PUT')
              <div class="modal-body">
              <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <select name="idkategori" id="idkategori" class="form-control selectpicker" data-size="7" data-style="select-with-transition" required>
                    <option value="" disabled selected> Kategori </option>
                    @foreach($kategori as $unit)
                    <option value="{{$unit->id}}">{{$unit->nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="expired" class="bmd-label-floating">Tanggal Expired</label>
                  <input type="date" class="form-control" id="expired" name="expired">
                </div>  
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="namabarang" class="bmd-label-floating">Nama Barang</label>
                  <input type="text" class="form-control" id="namabarang" name="namabarang" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nama" class="bmd-label-floating">Kode Barang (Barcode)</label>
                  <input type="text" class="form-control" id="kodebarang" name="kodebarang" required>
                </div>  
              </div>
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="harga_1" class="bmd-label-floating">Harga Satuan</label>
                  <input type="text" class="form-control" id="harga_1" name="harga_1" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="harga_3" class="bmd-label-floating">Harga 3</label>
                  <input type="text" class="form-control" id="harga_3" name="harga_3" required>
                </div>  
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="harga_6" class="bmd-label-floating">Harga 6</label>
                  <input type="text" class="form-control" id="harga_6" name="harga_6" required>
                </div>  
              </div>
              </div>
                
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
                  <button type="submit" class="btn btn-link text-primary">Simpan</button>
              </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Sunting Barang -->
@endif
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
<!--  End Modal Hapus  -->
<!-- Modal Hapus -->
<div class="modal fade modal-mini modal-primary" id="view" tabindex="-1" role="dialog" aria-labelledby="myViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
          </div>
          <div class="modal-body text-center">
            <svg id="barcode"></svg>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
                <div class="ripple-container"></div>
            </button>
            <button type="button" class="btn btn-outline-primary">Cetak</button><div class="ripple-container"></div>
            </button>
          </div>
        </div>
    </div>
</div>
<!--  End Modal Hapus  -->
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Data Barang</h4>
          </div>
        </div>
        <div class="card-body">
          @if(isset($d['kategori']))
          <div class="filter-tags" data-select="#selectrole" data-tags="#tagsinput" data-col="2">
              <div class="form-group d-inline-block" style="width: 150px;">
                  <div class="row">
                      <div class="col">
                      <select id="selectrole" class="selectpicker" data-style2="btn-default btn-round btn-sm text-white" data-style="select-with-transition" multiple title="Filter Kategori" data-size="7" data-live-search="true">
                          <optgroup label="Kategori">
                            @foreach($d['kategori'] as $unit)
                              <option value="{{$unit->id}}">{{$unit->nama}}</option>
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
          @endif
          <div class="toolbar row">
            <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                  data-target="#tambah">Tambah</button></div>
          </div>
          <div class="anim slide" id="table-container">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover"
                width="100%" style="width:100%">
                <thead>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
<script>
    var oTable;
    var now = moment();

    function view(self) {
      var tr = $(self).closest('tr');
      var data = oTable.row(tr).data();
      console.log(data);
      
      // let text = document.getElementById("text").value;
      JsBarcode("#barcode", data.kodebarang);
      

      var $modal = $('#view');
      
      // $modal.find('input[name=id]').val(data['id']).change();
      // $modal.find('select[name=idkategori]').val(data['idkategori']).change().blur();
      
      $modal.modal('show')
    }

    function sunting(self) {
      var tr = $(self).closest('tr');
      var data = oTable.row(tr).data();
      
      var $modal = $('#sunting');
      
      $modal.find('input[name=id]').val(data['id']).change();
      $modal.find('select[name=idkategori]').val(data['idkategori']).change().blur();
      $modal.find('input[name=namabarang]').val(data['namabarang']).change();
      $modal.find('input[name=kodebarang]').val(data['kodebarang']).change();
      $modal.find('input[name=harga_1]').val(data['harga_1']).change();
      $modal.find('input[name=harga_3]').val(data['harga_3']).change();
      $modal.find('input[name=harga_6]').val(data['harga_6']).change();
      $modal.find('input[name=expired]').val(data['expired']).change();
      
      $('#formedit').attr('action', '{{route("barang.update", ["barang"=>''])}}/'+data['id']);
      $modal.modal('show')
    }

    function back() {
        $('#nakes-container').addClass('hidden')
        $('#table-container').removeClass('hidden')
        $('#btnkembali').attr('hidden', true);
        $('#btntambah').attr('hidden', false);

        if ($.fn.dataTable.isDataTable('#datatables2')) {
          $('#datatables2').DataTable().clear();
          $('#datatables2').DataTable().destroy();
          $('#datatables2').empty();
        }
    }

    function hapus(id){
      $modal=$('#hapus');
      $modal.find('form').attr('action', "{{route('barang.destroy', ['barang'=>''])}}/"+id);
    
      $modal.modal('show');
    }

    // Datatable
    function showTable() {

        if ($.fn.dataTable.isDataTable('#datatables')) {
            $('#datatables').DataTable().clear();
            $('#datatables').DataTable().destroy();
            $('#datatables').empty();
        }

        oTable = $("#datatables").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                type: "POST",
                url: '{{route("barang.data")}}',
                data: {
                    '_token': @json(csrf_token())
                }
            },
            
            columns: [
              { data: 'id', title: 'ID'},
              { data: 'get_kategori.nama', title: 'Kategori' },
              { data: 'kodebarang', title: 'Kode Barang' },
              { data: 'namabarang', title: 'Nama Barang' },
              { data: 'id', title: 'Aksi', class: "text-center", width: 1, orderable: false, render: function (e, d, r) {
                return '<span class="nav-item dropdown ">' +
                  '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                  '<i class="material-icons">more_vert</i>' +
                  '</a>' +
                  '<div class="dropdown-menu dropdown-menu-left" >' +
                  '<a class="dropdown-item" href="#" onclick="sunting(this)" >Sunting</a>' +
                  '<a class="dropdown-item" href="#" onclick="view(this)">Lihat Barcode</a>' +
                  '<div class="dropdown-divider"></div>' +
                  '<a class="dropdown-item" href="#" onclick="hapus('+e+')">Hapus</a>' +
                  '</div>' +
                  '</span>'
              }},
            ],
            columnDefs: [{
                    responsivePriority: 2,
                    targets: 0
                },{
                    orderable: false,
                    responsivePriority: 2,
                    targets: 3
                }
            ]
            
        });
    }

    $('select[name=kelurahan]').change(function(){
      var nama_kel = $(this).val();
      if(nama_kel){
        var kecamatan = nama_kel.split(",");
        $('input[name=kecamatan]').val(kecamatan[1]).change();
      }
    });

    $(document).ready(function () {
        showTable();
        $('input[name=kecamatan]').val(" ").change();

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
