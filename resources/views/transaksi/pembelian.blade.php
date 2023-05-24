@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Tampilan Kasir
@endsection

@section('transaksiShow')
show
@endsection

@section('pembelianStatus')
active
@endsection


@section('content')
<div class="container-fluid">
  <form action="{{route('barang_keluar.store')}}" method="POST">
  @csrf
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Barang</h4>
          </div>
        </div>
        <div class="card-body" id="searchbarang">
          
          <div class="toolbar row">
            <!-- <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#tambah">Tambah</button></div> -->
          
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="typeahead__container ">
                <div class="typeahead__field">
                  <div class="form-group typeahead__query">
                    <input type="text" class="form-control" id="qty" placeholder="Qty">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="typeahead__container ">
                <div class="typeahead__field">
                  <div class="form-group typeahead__query">
                    <input class="form-control js-typeahead" name="q" id="querybarang" autocomplete="off" onclick="$('#searchbarang .js-typeahead').val('');" placeholder="Cari Barang">
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
        </div>
        <!--  end card  -->
      </div>
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Checkout</h4>
          </div>
        </div>
        <div class="card-body row">
          <div class="col-md-6">
            <div class="form-group">
              <!-- <label for="metode" class="bmd-label-floating">Metode Pembayaran</label> -->
              <!-- <input type="text" class="form-control" id="metode" name="metode"> -->
              <select class="selectpicker" name="metode" data-style="select-with-transition" required onchange="show(this)">
                <option value="" selected disabled>Metode Pembayaran</option>  
                <option value="cash">Cash</option>
                <option value="debit/kredit">Debit/Kredit</option>
                <option value="qris">QRIS</option>
              </select>
            </div>
            
          </div>
          <div class="col-md-6" id="showPeriode" hidden>
            <div class="form-group">
              <!-- Periode muncul jika metode = kredit -->
              <!-- <label for="periode" class="bmd-label-floating">Periode Kredit</label> -->
              <select class="selectpicker" name="periode" data-style="select-with-transition" >
                <option value="" selected disabled>Periode Kredit</option>
                <option value="1">1 Bulan</option>
                <option value="2">2 Bulan</option>
                <option value="3">3 Bulan</option>
              </select>
            </div>
          </div>
          <div class="col-md-6" id="showBayar" hidden>
            <div class="form-group">
              <label for="bayar" class="bmd-label-floating">Uang Dibayarkan</label>
              <input type="text" class="form-control" name="bayar" onkeyup="hitungKembali(this)"/>
            </div>
          </div>
          <div class="col-md-12" id="showKembali" hidden>
            <div class="form-group">
              <label for="kembali" class="bmd-label-floating">Uang Kembali</label>
              <input type="text" class="form-control" name="kembali" readonly/>
            </div>
          </div>
          
        </div>
        <div class="card-footer">
          <button class="btn btn-primary">Konfirmasi</button>
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
            <div class="col-md-12" id="showMember">
              <div class="form-group" id="searchmember">
                <div class="typeahead__container ">
                  <div class="typeahead__field">
                    <div class="form-group typeahead__query">
                      <input class="form-control js-typeahead" name="member" autocomplete="off" placeholder="Cari Member">
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Barang</th>  
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th> </th>
              </thead>
              <tbody id="detailBrg">
                
              </tbody>
              <tfoot class=" text-secondary" style="font-size:20px;">
                <th colspan="3">Total</th>  
                <th id="total">Rp 0</th>
                <input type="hidden" id="jumlah" name="jumlah">
                <th> </th>
              </tfoot>
            </table>
          </div>
          
        </div>
        <!--  end card  -->
      </div>
    </div>
  </div>
  </form>
</div>
@endsection

@section('script')
<script>
    const channel = new BroadcastChannel('cashier');
    var now = moment();
    var total = 0;

    function hapus(id){
      $modal=$('#hapus');
      $modal.find('form').attr('action', "{{route('barang_masuk.destroy', ['id'=>''])}}/"+id);
    
      $modal.modal('show');
    }

    function kurangiTotal(jumlah){
      total = total - jumlah;
      $('#total').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
      $('#jumlah').val(total);
    }

    function hitungKembali(e){
      $('input[name=kembali]').val(e.value-total).change();
    }

    function show(con){
      if(con.value=='kredit'){
        $('#showPeriode').attr('hidden', false);
        $('input[name=periode]').attr('required', true);
        $('#showBayar').attr('hidden', true);
        $('input[name=bayar]').attr('required', false);
        $('#showKembali').attr('hidden', true);
      } else if(con.value=='cash') {
        $('#showPeriode').attr('hidden', true);
        $('input[name=periode]').attr('required', false);
        $('#showBayar').attr('hidden', false);
        $('input[name=bayar]').attr('required', true);
        $('#showKembali').attr('hidden', false);
      } else {
        $('#showPeriode').attr('hidden', true);
        $('input[name=periode]').attr('required', false);
        $('#showBayar').attr('hidden', true);
        $('input[name=bayar]').attr('required', false);
        $('#showKembali').attr('hidden', true);
      }
    }

    function closeMember(){
      $('#searchmember .js-typeahead').val('').change();
      channel.postMessage('removemember||');
      $('#searchmember').show();
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
            var cmd = '<td>' + item.namabarang + '</td>' +
              '<td>' + qty + '</td>' +
              '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(h_sat) + '</td>' +
              '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(jumlah) + '</td>';
            
              $('#detailBrg').append(
              '<tr>'+
              '<input type="hidden" readonly name="detail[]" value="' + item.id + '||' + qty + '||' + h_sat +'||' + jumlah +'">' +
              cmd +
              '<td class="text-right"><button class="btn btn-danger btn-link" style="padding:5px;margin:0;" onclick="$(this).parent().parent().remove();kurangiTotal(' + jumlah + ')">' +
              '<span class="material-icons">close</span>' +
              '</button></td></tr>'
            );
            channel.postMessage('addbarang||'+'<tr>'+cmd+'</tr>||'+new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
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

    $('#searchmember .js-typeahead').typeahead({
        input: ".js-typeahead",
        dynamic: true, 
        hint: true,
        order: "asc",
        display: ["nama","alamat"],
        template: function (query, item) {return item.nama+' ('+item.alamat+')'},
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
              
              $('#showMember').append(
                '<div class="alert alert-primary">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeMember()">' +
                '<i class="material-icons">close</i>' +
                '</button>' +
                '<span><b style="font-size:18px;">'+ item.nama +'</b></span>' +
                '<span>'+ item.alamat +'</span>' +
                '<input type="hidden" name="idmember" value="'+ item.id +'">' +
                '</div>'
              );
              channel.postMessage('addmember||'+item.nama+'||'+item.alamat+'||'+item.poin);
              $('#searchbarang .js-typeahead').val('').change();
              $('#searchmember').hide();
              // $('#total').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
            }
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });


    $(document).ready(function () {

      $('select[name=metode]').val("").change();
      show('');
      $('select[name=periode]').val("").change();
      $('input[name=bayar]').val("").change();
      $('input[name=kembali]').val("").change();

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
<script src="https://cdn.jsdelivr.net/npm/broadcast-channel@5.1.0/dist/lib/index.es5.min.js"></script>
<script>
  
  // channel.postMessage('I am not alone');
</script>
@endsection
