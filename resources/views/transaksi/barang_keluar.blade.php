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
<!-- Modal View Barang Keluar -->
<div class="modal modal-custom-1 fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Barang Keluar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table" style="font-size:14px;">
                  <thead class="text-primary">
                    <th style="width:50%;font-size:15px;">Nama Barang</th>
                    <th style="width:10%;font-size:15px;">QTY</th>
                    <th style="width:20%;font-size:15px;">Harga Satuan</th>
                    <th style="width:20%;font-size:15px;">Total</th>
                  </thead>
                  <tbody id="detail_brg_kel">

                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
                <!-- <button type="submit" class="btn btn-link text-primary">Simpan</button> -->
            </div>
        </div>
    </div>
</div>
<!-- End Modal View Barang Keluar -->

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
  </div>
</div>
@endsection

@section('script')
<script>
    var oTable;
    var now = moment();

    function view(self){
      var tr = $(self).closest('tr');
      var data = oTable.row(tr).data();

      var $modal = $('#view');
      $('#detail_brg_kel').empty();
      $.ajax({
          url: "{{ route('barang_keluar.detail',['id'=>'']) }}" + '/' + data.id ,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            
            data.forEach(e => {
              $('#detail_brg_kel').append(
                '<tr>'+
                '<td>' + e.get_barang.namabarang + '</td>' +
                '<td>' + e.qty + '</td>' +
                '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(e.h_sat) + '</td>' +
                '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(e.jumlah) + '</td>' +
                '</tr>'
              );
            })

          },
          error : function() {
              alert("No Data");
          }
      });
          
      $modal.modal('show')
    }

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
      $modal.find('form').attr('action', "{{route('barang_keluar.destroy', ['id'=>''])}}/"+id);
    
      $modal.modal('show');
    }

    $('#searchbarang .js-typeahead').typeahead({
        input: ".js-typeahead",
        dynamic: true, 
        hint: true,
        order: "asc",
        display: ["kodebarang", "namabarang"],
        template: function (query, item) {return '['+item.kodebarang+'] '+item.namabarang},
        emptyTemplate: "Tidak ditemukan",
        source: {
            faskes: {
                // Ajax Request
                ajax: function (query) {
                    return {
                        type: 'GET',
                        url: '{{route("data.searchbarang")}}',
                        data: {'query':query}
                    }
                }
            }
        },
        callback: {
          onClick: function(node, a, item, event){
            
            var qty = $('#qty').val();
            var h_sat = 0;

            if(!qty) qty = 1;
            if(qty >= 6) h_sat = item.harga_6;
            else if(qty >= 3) h_sat = item.harga_3;
            else h_sat = item.harga_1;

            var jumlah = qty * h_sat;
            total = total + jumlah;
            $('#detailBrg').append(
              '<tr>'+
              '<input type="hidden" readonly name="detail[]" value="' + item.id + '||' + qty + '||' + h_sat +'||' + jumlah +'">' +
              '<td>' + item.namabarang + '</td>' +
              '<td>' + qty + '</td>' +
              '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(h_sat) + '</td>' +
              '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(jumlah) + '</td>' +
              '<td class="text-right"><button class="btn btn-danger btn-link" style="padding:5px;margin:0;" onclick="$(this).parent().parent().remove();kurangiTotal(' + jumlah + ')">' +
              '<span class="material-icons">close</span>' +
              '</button></td></tr>'
            );
            
            $('#searchbarang .js-typeahead').val('').change();
            $('#qty').val('');
            $('#total').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
            $('#jumlah').val(total);
          }          
          
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });

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
                url: '{{route("barang_keluar.data")}}',
                data: {
                    '_token': @json(csrf_token())
                }
            },
            columns: [
              { data: 'id', title: 'ID', width:'5%'},
              { data: 'nomor', title: 'Nomor Transaksi', width:'15%' },
              { data: 'tanggal', title: 'Tanggal', width:'12%' },
              { data: 'namamember', title: 'Member', width: '25%'},
              { data: 'metode', title: 'Metode', width:'13%' },
              { data: 'jumlah', title: 'Total', width:'20%', render: function(e,d,r){
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(e);
              }},
              { data: 'action', title: 'Aksi', width:'10%', orderable: false },
            ],
            columnDefs: [
              { responsivePriority: 2, targets: 0 },
              { orderable: false, responsivePriority: 2, targets: 3 },
              { className: "text-right", targets: 6 }
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
