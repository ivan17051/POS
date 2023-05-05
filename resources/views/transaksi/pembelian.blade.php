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
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Cari Barang</h4>
          </div>
        </div>
        <div class="card-body" id="searchbarang">
          
          <div class="toolbar row">
            <!-- <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#tambah">Tambah</button></div> -->
          
          </div>
          <div class="typeahead__container ">
            <div class="typeahead__field">
              <div class="form-group typeahead__query">
                <input class="form-control js-typeahead" name="q" autocomplete="off">
              </div>
            </div>
          </div>
          
        </div>
        <!--  end card  -->
      </div>
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" />
          </div>
          <div class="form-group" id="searchmember">
            <label for="member" class="bmd-label-floating">Member</label>
            <!-- <input type="text" class="form-control" name="member"/> -->
            <div class="typeahead__container ">
              <div class="typeahead__field">
                <div class="form-group typeahead__query">
                  <input class="form-control js-typeahead" name="q" autocomplete="off">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="metode" class="bmd-label-floating">Metode Pembayaran</label>
            <input type="text" class="form-control" id="metode" name="metode">
          </div>
        </div>
      </div>
      <!-- end col-md-12 -->
    </div>
    <div class="col-md-6">
      <div class="card">
        
        <div class="card-body">
          
          <div class="toolbar row">
            <!-- <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#tambah">Tambah</button></div> -->
            
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>ID</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Subtotal</th>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Dakota Rice</td>
                  <td>2</td>
                  <td>$36,738</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Minerva Hooper</td>
                  <td>5</td>
                  <td>$23,789</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Sage Rodriguez</td>
                  <td>1</td>
                  <td>$56,142</td>
                </tr>
                
              </tbody>
            </table>
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
               console.log(item);

            }
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });

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
                        url: '{{route("data.searchmember")}}',
                        data: {'query':query}
                    }
                }
            }
        },
        callback: {
            onClick: function(node, a, item, event){
               console.log(item);

            }
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });

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
