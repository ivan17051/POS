@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Pembelian
@endsection

@section('transaksiShow')
show
@endsection

@section('pembelianStatus')
active
@endsection


@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Barang</h4>
          </div>
        </div>
        <div class="card-body">
          
          <div class="toolbar row">
            <!-- <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#tambah">Tambah</button></div> -->
          
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
    <div class="col-md-5">
      <div class="card">
        
        <div class="card-body">
          
          <div class="toolbar row">
            <!-- <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#tambah">Tambah</button></div> -->
          
          </div>
          
          
        </div>
        <!--  end card  -->
      </div>
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
                url: '{{route("barang.dataPembelian")}}',
                data: {
                    '_token': @json(csrf_token())
                }
            },
            columns: [
              { data: 'id', title: 'ID', visible: false},
              { data: 'nama', title: 'Nama Barang' },
              { data: 'get_kategori.nama', title: 'Kategori', visible: false},
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
