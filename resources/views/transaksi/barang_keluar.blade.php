@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Transaksi Barang Keluar
@endsection

@section('transaksiShow')
show
@endsection

@section('barangKeluarStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah Barang Masuk -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang Keluar </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('barang_masuk.store')}}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 mb-4">
              <select name="idbarang" id="idbarang" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true">
                <option value="" disabled selected>Pilih Barang</option>
                @foreach($barang as $unit)
                <option value="{{$unit->id}}">{{$unit->namabarang}}</option>
                @endforeach
              </select>
            </div>
            <!-- <div class="col-md-12 mb-4">
              <select name="idbarang" id="idbarang" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true">
                <option value="" disabled selected>Pilih Barang</option>
                @foreach($barang as $unit)
                <option value="{{$unit->id}}">{{$unit->namabarang}}</option>
                @endforeach
              </select>
            </div> -->
            <div class="col-md-4">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">QTY</label>
                <input type="text" class="form-control" id="qty" name="qty" onkeyup="hitungTotal(this)" required>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Harga Satuan</label>
                <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" onkeyup="hitungTotal(this)" required>
              </div>  
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Total</label>
                <input type="text" class="form-control" id="total" name="total" required readonly>
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
<!--  End Modal Tambah Barang Masuk -->

<!-- Modal Sunting Faskes -->
<div class="modal modal-custom-1 fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sunting Barang Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <form id="formedit" class="form-horizontal input-margin-additional" method="POST" action="">
            @csrf
            @method('PUT')
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <select name="idbarang" id="idbarang" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true">
                      <option value="" disabled selected>Pilih Barang</option>
                      @foreach($barang as $unit)
                      <option value="{{$unit->id}}">{{$unit->namabarang}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- <div class="col-md-12 mb-4">
                    <select name="idbarang" id="idbarang" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true">
                      <option value="" disabled selected>Pilih Barang</option>
                      @foreach($barang as $unit)
                      <option value="{{$unit->id}}">{{$unit->namabarang}}</option>
                      @endforeach
                    </select>
                  </div> -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">QTY</label>
                      <input type="text" class="form-control" id="qty" name="qty" onkeyup="hitungTotal(this)" required>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Harga Satuan</label>
                      <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" onkeyup="hitungTotal(this)" required>
                    </div>  
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Total</label>
                      <input type="text" class="form-control" id="total" name="total" required readonly>
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
<!-- End Modal Sunting Faskes -->

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
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Transaksi Barang Keluar</h4>
          </div>
        </div>
        <div class="card-body">
          
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
<script>
    var oTable;
    var now = moment();

    function edit(self) {
        var tr = $(self).closest('tr');
        var data = oTable.row(tr).data();
        
        var $modal = $('#sunting');
        
        $modal.find('input[name=id]').val(data['id']).change();
        $modal.find('select[name=idbarang]').val(data['idbarang']).change().blur();
        $modal.find('input[name=qty]').val(data['qty']).change();
        $modal.find('input[name=harga_satuan]').val(data['harga_satuan']).change();
        $modal.find('input[name=total]').val(data['total']).change();

        $('#formedit').attr('action', '{{route("barang_masuk.update", ["id"=>""])}}/'+data['id']);
        $modal.modal('show')
    }

    function hapus(id){
      $modal=$('#hapus');
      $modal.find('form').attr('action', "{{route('barang_masuk.destroy', ['id'=>''])}}/"+id);
    
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
                url: '{{route("barang_masuk.data")}}',
                data: {
                    '_token': @json(csrf_token())
                }
            },
            columns: [
              { data: 'id', title: 'ID', width:'5%'},
              { data: 'get_barang.namabarang', title: 'Nama Barang' },
              { data: 'qty', title: 'QTY', width:'10%' },
              { data: 'harga_satuan', title: 'Harga Satuan', width:'20%', render: function(e,d,r){
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(e);
              }},
              { data: 'action', title: 'Aksi', width:'10%', orderable: false },
            ],
            columnDefs: [
              { responsivePriority: 2, targets: 0 },
              { orderable: false, responsivePriority: 2, targets: 3 },
              { className: "text-right", targets: 4 }
            ]
            
        });
    }

    function hitungTotal(e) {
      var qty = $('#qty').val();
      var harga = $('#harga_satuan').val();
      var total = qty*harga;
      $('#total').val(total).change();
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
