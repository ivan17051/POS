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
          <div class="row mb-2">
            <div class="col-md-3">
              <input type="text" class="form-control" id="qty" placeholder="Qty">
            </div>
            <div class="col-md-9">
              <!-- <div class="typeahead__container ">
                <div class="typeahead__field">
                  <div class="form-group typeahead__query">
                    <input class="form-control js-typeahead" name="q" id="querybarang" autocomplete="on" onclick="$('#searchbarang .js-typeahead').val('');" placeholder="Cari Barang">
                  </div>
                </div>
              </div> -->
              <select class="form-control selectpicker" id="selectbarang" data-style="select-with-transition" data-live-search="true" onchange="pilihBarang(this)" data-size="5">
                <option value="" disabled>Cari Barang</option>
                @foreach($barang as $unit)
                <option value="{{$unit->id}}||{{$unit->harga_1}}||{{$unit->harga_3}}||{{$unit->harga_6}}||{{$unit->namabarang}}">{{$unit->kodebarang}} - {{$unit->namabarang}}</option>
                @endforeach
              </select>
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
          <div class="col-md-12">
            <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{date('Y-m-d')}}">
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <!-- <label for="metode" class="bmd-label-floating">Metode Pembayaran</label> -->
              <!-- <input type="text" class="form-control" id="metode" name="metode"> -->
              <select class="selectpicker" name="metode" data-style="select-with-transition" required onchange="show(this)">
                <option value="" selected disabled>Metode Pembayaran</option>  
                <option value="cash">Cash</option>
                <option value="debit/kredit">Kartu Debit/Kredit</option>
                <option value="qris">QRIS</option>
                <option value="transfer">Transfer Bank</option>
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
          <div class="col-md-6" id="showKembali" hidden>
            <div class="form-group">
              <label for="kembali" class="bmd-label-floating">Uang Kembali</label>
              <input type="text" class="form-control" name="kembali" readonly/>
            </div>
          </div>
          <div class="col-md-12" id="showKeterangan" hidden>
            <div class="form-group">
              <label for="keterangan" class="bmd-label-floating" id="labelket">Keterangan</label>
              <input type="text" class="form-control" name="keterangan"/>
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
  @if(isset($struk))
  <a id="cetakStruk" href="{{route('cetak.struk',['id'=>$struk])}}" onclick="window.open(this, '_blank', 'width=,height=');return false;" hidden></a>
  @endif
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
      if(con.value=='debit/kredit'){
        $('#showPeriode').attr('hidden', true);
        $('input[name=periode]').attr('required', false);
        $('#showBayar').attr('hidden', true);
        $('input[name=bayar]').attr('required', false);
        $('#showKeterangan').attr('hidden', false);
        $('input[name=keterangan]').attr('required', true);
        $('#labelket').html("No. Kartu Debit/Kredit");
        $('#showKembali').attr('hidden', true);
      } else if(con.value=='cash') {
        $('#showPeriode').attr('hidden', true);
        $('input[name=periode]').attr('required', false);
        $('#showBayar').attr('hidden', false);
        $('input[name=bayar]').attr('required', true);
        $('#showKeterangan').attr('hidden', true);
        $('input[name=keterangan]').attr('required', false);
        $('#showKembali').attr('hidden', false);
      } else if(con.value=='qris' || con.value=='transfer') {
        $('#showPeriode').attr('hidden', true);
        $('input[name=periode]').attr('required', false);
        $('#showBayar').attr('hidden', true);
        $('input[name=bayar]').attr('required', false);
        $('#showKeterangan').attr('hidden', false);
        $('input[name=keterangan]').attr('required', true);
        $('#labelket').html("Keterangan");
        $('#showKembali').attr('hidden', true);
      } else {
        $('#showPeriode').attr('hidden', true);
        $('input[name=periode]').attr('required', false);
        $('#showBayar').attr('hidden', true);
        $('input[name=bayar]').attr('required', false);
        $('#showKembali').attr('hidden', true);
        $('#showKeterangan').attr('hidden', true);
        $('input[name=keterangan]').attr('required', false);
      }
    }

    function closeMember(){
      $('#searchmember .js-typeahead').val('').change();
      channel.postMessage('removemember||');
      $('#searchmember').show();
    }

    function pilihBarang(self){
      var qty = $('#qty').val();
      var h_sat = 0;
      // id, harga_1, harga_3, harga_6, namabarang
      var barang = self.value.split('||');

      if(!qty) qty = 1;
      if(qty >= 6) h_sat = barang[3];
      else if(qty >= 3) h_sat = barang[2];
      else h_sat = barang[1];

      var jumlah = qty * h_sat;
      total = total + jumlah;
      var cmd = '<td>' + barang[4] + '</td>' +
        '<td>' + qty + '</td>' +
        '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(h_sat) + '</td>' +
        '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(jumlah) + '</td>';
      
        $('#detailBrg').append(
        '<tr>'+
        '<input type="hidden" readonly name="detail[]" value="' + barang[0] + '||' + qty + '||' + h_sat +'||' + jumlah +'">' +
        cmd +
        '<td class="text-right"><button class="btn btn-danger btn-link" style="padding:5px;margin:0;" onclick="$(this).parent().parent().remove();kurangiTotal(' + jumlah + ')">' +
        '<span class="material-icons">close</span>' +
        '</button></td></tr>'
      );
      channel.postMessage('addbarang||'+'<tr>'+cmd+'</tr>||'+new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));

      $('#qty').val('');
      $('#total').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
      $('#jumlah').val(total);
      $('#selectbarang').val('');
      $('#selectbarang').select2('open');
      
    }
    
    // $('#searchbarang .js-typeahead').typeahead({
    //     input: ".js-typeahead",
    //     dynamic: true, 
    //     hint: true,
    //     order: "asc",
    //     display: ["kodebarang", "namabarang"],
    //     template: function (query, item) {return '['+item.kodebarang+'] '+item.namabarang},
    //     emptyTemplate: "Tidak ditemukan",
    //     source: {
    //         faskes: {
    //             // Ajax Request
    //             ajax: function (query) {
    //                 return {
    //                     type: 'GET',
    //                     url: '{{route("data.searchbarang")}}',
    //                     data: {'query':query}
    //                 }
    //             }
    //         }
    //     },
    //     callback: {
    //       onClick: function(node, a, item, event){
            
    //         var qty = $('#qty').val();
    //         var h_sat = 0;

    //         if(!qty) qty = 1;
    //         if(qty >= 6) h_sat = item.harga_6;
    //         else if(qty >= 3) h_sat = item.harga_3;
    //         else h_sat = item.harga_1;

    //         var jumlah = qty * h_sat;
    //         total = total + jumlah;
    //         var cmd = '<td>' + item.namabarang + '</td>' +
    //           '<td>' + qty + '</td>' +
    //           '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(h_sat) + '</td>' +
    //           '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(jumlah) + '</td>';
            
    //           $('#detailBrg').append(
    //           '<tr>'+
    //           '<input type="hidden" readonly name="detail[]" value="' + item.id + '||' + qty + '||' + h_sat +'||' + jumlah +'">' +
    //           cmd +
    //           '<td class="text-right"><button class="btn btn-danger btn-link" style="padding:5px;margin:0;" onclick="$(this).parent().parent().remove();kurangiTotal(' + jumlah + ')">' +
    //           '<span class="material-icons">close</span>' +
    //           '</button></td></tr>'
    //         );
    //         channel.postMessage('addbarang||'+'<tr>'+cmd+'</tr>||'+new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
    //         $('#searchbarang .js-typeahead').val('').change();
    //         $('#qty').val('');
    //         $('#total').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
    //         $('#jumlah').val(total);
    //       }          
          
    //     },
    //     selector:{
    //         result: 'typeahead__result c-typeahead',
    //     }
    // });

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
              var poin = (item.poin === null) ? 0 : item.poin;
              $('#showMember').append(
                '<div class="alert alert-primary">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeMember()">' +
                '<i class="material-icons">close</i>' +
                '</button>' +
                '<div class="row"><div class="col-md-8 pl-0">' +
                '<span><b style="font-size:18px;">'+ item.nama +'</b></span>' +
                '<span>'+ item.alamat +'</span>' +
                '</div><div class="col-md-4">' +
                '<div style="height:100%;padding-top:9px;border:2px solid white;border-radius:5px;text-align:center;"><b style="font-size:30px;">'+ poin +'</b></div>' +
                '</div></div>' +
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
      // window.open('{{ route("cetak.struk",["id"=>"41"]) }}', '_blank', 'width=,height=');
      
      @if(isset($struk))
      document.getElementById('cetakStruk').click();
      @endif

      $('#selectbarang').val('');
      $('select[name=metode]').val("").change();
      show('');
      $('select[name=periode]').val("").change();
      $('input[name=keterangan]').val("").change();
      $('input[name=bayar]').val("").change();
      $('input[name=kembali]').val("").change();
      channel.postMessage('clear');

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
