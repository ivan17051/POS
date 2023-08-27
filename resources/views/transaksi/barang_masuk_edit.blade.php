@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Transaksi Barang Masuk
@endsection

@section('transaksiShow')
show
@endsection

@section('barangMasukStatus')
active
@endsection

@section('modal')
<!-- Modal View Barang Masuk -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Barang Masuk </h4>
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
              <tbody id="detail_brg_msk">

              </tbody>
            </table>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
        </div>
      
    </div>
  </div>
</div>
<!--  End Modal View Barang Masuk -->

<!-- Modal Pembayaran -->
<div class="modal fade" id="pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pembayaran Barang Masuk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <table class="table" style="font-size:14px;">
                <thead class="text-primary">
                  <th style="width:30%;font-size:15px;">No. Kwitansi</th>
                  <th style="width:30%;font-size:15px;">Tanggal</th>
                  <th style="width:40%;font-size:15px;">Jumlah</th>
                </thead>
                <tbody id="detail_pembayaran">

                </tbody>
              </table>
            </div>
              <div class="col-md-4" style="border:1px solid black;border-radius:10px;padding:10px;">
                <form action="{{route('pembayaran.store')}}" method="POST">
                @csrf
                  <div class="bg-secondary text-white" style="padding:5px 5px 0 5px;">
                    <small>Sisa Pembayaran</small>
                    <h5 style="padding-bottom:5px;" id="sisaBayar">Rp 0</h5>
                  </div>
                  <input type="hidden" name="idbarangmasuk" id="idbarangmasuk">
                  <div class="form-group" style="margin-top:25px;">
                    <label for="nokwitansi" class="bmd-label-floating">No. Kwitansi</label>
                    <input type="text" class="form-control" id="nokwitansi" name="nokwitansi" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggal" class="bmd-label-floating">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                  </div>
                  <div class="form-group">
                    <label for="jumbayar" class="bmd-label-floating">Jumlah Bayar</label>
                    <input type="text" class="form-control" id="jumbayar" name="jumbayar" required>
                  </div>

                  <button type="submit" class="btn btn-primary btn-block" id="btnBayar">Simpan</button>
                </form>
              </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
        </div>
      
    </div>
  </div>
</div>
<!--  End Modal Pembayaran -->

<!-- Modal Hapus -->
<div class="modal fade modal-mini modal-primary" id="hapus" tabindex="-1" role="dialog"
  aria-labelledby="myDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
            class="material-icons">clear</i></button>
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
  <div class="row" id="formMasuk">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Edit Transaksi Barang Masuk</h4>
          </div>
        </div>
        <form method="POST" action="{{route('barang_masuk.store')}}" class="form-horizontal">
        @csrf
        <div class="card-body">

          <!-- <div class="toolbar row">
            <div class="col"></div>

          </div> -->
          <div class="anim slide">
            
              <div class="row">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-4">
                  <div class="form-group">
                    <input type="date" class="form-control" name="tanggal" required value="{{$barang_masuk->tanggal}}">
                    <span class="bmd-help">Masukkan Tanggal Transaksi.</span>
                  </div>
                </div>

                <label class="col-sm-2 col-form-label">No. Transaksi</label>
                <div class="col-sm-4">
                  <div class="form-group">
                    <input type="text" class="form-control" name="nomor" readonly value="{{$barang_masuk->nomor}}">
                    <span class="bmd-help">Masukkan Nomor Transaksi.</span>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <label class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                  <select class="selectpicker form-control" name="idsupplier" data-style="select-with-transition" title="--Pilih Supplier--" data-size="5" data-live-search="true" required>
                    @foreach($supplier as $unit)
                    <option value="{{$unit->id}}">{{$unit->nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <label class="col-sm-2 col-form-label">Metode Pembayaran</label>
                <div class="col-sm-10">
                  <select class="selectpicker form-control" name="metode" data-style="select-with-transition" title="--Pilih Metode Pembayaran--" required onchange="toggleTglJatuhTempo(this)">
                    <option value="cash">Cash</option>
                    <option value="kredit">Kredit/Termin</option>
                  </select>
                  
                </div>
              </div>
              <div class="row mt-3" id="fieldTglJatuhTempo" style="display:none;">
                <label class="col-sm-2 col-form-label">Tanggal Jatuh Tempo</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="tgljatuhtempo">
                </div>
              </div>
              <!-- <div class="row">
                <label class="col-sm-2 col-form-label label-checkbox">Inline checkboxes</label>
                <div class="col-sm-10 checkbox-radios">
                  <div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value=""> a
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value=""> b
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value=""> c
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </div>
              </div> -->
              <div class="card-body table-full-width table-hover mt-5">
                <div class="table-responsive" style="overflow:visible;">
                  <table class="table">
                    <thead class="">
                      <th style="width:5%;">ID</th>
                      <th>Nama Barang</th>
                      <th style="width:15%;">Tgl Expired</th>
                      <th style="width:5%;">QTY</th>
                      <th style="width:15%;">Harga Satuan</th>
                      <th style="width:15%;">Total</th>
                      <th style="width:5%;">Aksi</th>
                    </thead>
                    <tbody id="detailBrgMasuk">
                      <tr class="">
                        <td>#</td>
                        <td>
                          <select class="selectpicker form-control" name="addBrg" data-style="select-with-transition" title="--Pilih Barang--" data-size="3" data-live-search="true">
                            @foreach($barang as $unit)
                            <option value="{{$unit->id}}|{{$unit->namabarang}}">{{$unit->kodebarang}} | {{$unit->namabarang}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td><input type="date" id="tglExp" name="tglExp" class="form-control" placeholder="Tgl Exp"></td>
                        <td><input type="text" id="addQty" name="addQty" class="form-control" placeholder="QTY" onkeyup="hitungTotal()"></td>
                        <td><input type="text" id="h_sat" name="h_sat" class="form-control" placeholder="Harga Satuan" onkeyup="hitungTotal()"></td>
                        <td><input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Total" readonly></td>
                        <td class="text-right"><button type="button" class="btn btn-sm btn-primary" onclick="addPengadaan()"
                            style="padding:5px;"><span class="material-icons">add</span></button></td>
                      </tr>
                      @foreach($detail as $unit)
                      <tr>
                        <td>#</td>
                        <td>{{$unit->getBarang->namabarang}}</td>
                        <td>{{$unit->tglexp}}</td>
                        <td>{{$unit->qty}}</td>
                        <td>{{number_format($unit->h_sat)}}</td>
                        <td>{{number_format($unit->jumlah)}}</td>
                        <td class="text-right"></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            
          </div>

        </div>
        <div class="card-footer">
          <a href="{{route('barang_masuk.index')}}" class="btn btn-sm btn-dark">Kembali</a>
          <!-- <button type="submit" class="btn btn-sm btn-primary">Simpan</button> -->
        </div>
        </form>
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

    $('#formedit').attr('action', '{{route("barang_masuk.update", ["id"=>""])}}/' + data['id']);
    $modal.modal('show')
  }

  function view(self) {
    var tr = $(self).closest('tr');
    var data = oTable.row(tr).data();
    console.log(data);

    var $modal = $('#view');
    $('#detail_brg_msk').empty();
    $.ajax({
        url: "{{ route('barang_masuk.detail',['id'=>'']) }}" + '/' + data.id ,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          
          data.forEach(e => {
            $('#detail_brg_msk').append(
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
  
  function cetak(id) {
    
    var url = "{{route('barang_masuk.cetak', ['id'=>''])}}/" + id;
    window.open(url, '_blank');
  }

  function hapus(id) {
    $modal = $('#hapus');
    $modal.find('form').attr('action', "{{route('barang_masuk.destroy', ['id'=>''])}}/" + id);

    $modal.modal('show');
  }

  function pembayaran(self) {
    var tr = $(self).closest('tr');
    var data = oTable.row(tr).data();
    var jumlah = data.jumlah;
    $('#idbarangmasuk').val(data.id);

    var $modal = $('#pembayaran');
    $('#detail_pembayaran').empty();
    $.ajax({
        url: "{{ route('pembayaran.data',['id'=>'']) }}" + '/' + data.id ,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          var total = 0;
          data.forEach(e => {
            $('#detail_pembayaran').append(
              '<tr>'+
              '<td>' + e.nokwitansi + '</td>' +
              '<td>' + e.tanggal + '</td>' +
              '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(e.jumbayar) + '</td>' +
              '</tr>'
            );
            total = parseInt(total) + parseInt(e.jumbayar);
          });
          total = jumlah - total;
          if(total == 0) {
            $('#sisaBayar').html('Lunas');
            $('#nokwitansi').attr('disabled', true);
            $('#tanggal').attr('disabled', true);
            $('#jumbayar').attr('disabled', true);
            $('#btnBayar').attr('disabled', true);
          } else {
            $('#sisaBayar').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
            $('#nokwitansi').attr('disabled', false);
            $('#tanggal').attr('disabled', false);
            $('#jumbayar').attr('disabled', false);
            $('#btnBayar').attr('disabled', false);
          } 
        },
        error : function() {
            // alert("No Data");
        }
    });
        
    $modal.modal('show')
  }

  function showform(con) {
    if (con == 1) {
      $('#indexMasuk').attr('hidden', true)
      $('#formMasuk').attr('hidden', false)
    } else {
      $('#indexMasuk').attr('hidden', false)
      $('#formMasuk').attr('hidden', true)
    }

  }
  var jumDetailMasuk=0;
  
  function addPengadaan() {
    var brg = $('[name=addBrg]').val();
    var namaBrg = brg.split('|');
    var tglExp = $('[name=tglExp]').val();
    var qty = $('[name=addQty]').val();
    var h_sat = $('[name=h_sat]').val();
    var jumlah = $('[name=jumlah]').val();
    
    if (brg == '') {
      alert('Pilih Barang');
      $('[name=addBrg]').focus();
    } else if (qty == '' || qty <= 0) {
      alert("Qty harus valid");
    } else if (h_sat == '' || h_sat <= 0) {
      alert("Harga harus valid");
    } else if (h_sat.indexOf(',') >= 0) {
      alert("Untuk Harga, Gunakan Titik ('.') Bukan Koma (',')");
    } else if ((h_sat.match(/\./g) || []).length > 1) {
      alert("Untuk Harga, Titik ('.') Hanya Digunakan Untuk Pecahan Desimal");
    } else {
      jumDetailMasuk++;
      $('#detailBrgMasuk').append(
        '<tr class="table-info">'+
        '<input type="hidden" readonly name="detail[]" value="' + namaBrg[0] + '||' + tglExp + '||' + qty + '||' + h_sat +'||' + jumlah +'">' +
        '<td>' + jumDetailMasuk + '</td>' +
        '<td>' + namaBrg[1] + '</td>' +
        '<td>' + tglExp + '</td>' +
        '<td>' + qty + '</td>' +
        '<td>' + h_sat + '</td>' +
        '<td>' + jumlah + '</td>' +
        '<td class="text-right"><button class="btn btn-danger btn-link" style="padding:5px;margin:0;" onclick="$(this).parent().parent().remove(); kurangiJumlahMasuk();">' +
        '<span class="material-icons">close</span>' +
        '</button></td></tr>'
      );
      $('[name=tglExp]').val('');
      $('[name=addBrg]').val('').change();
      $('[name=addQty]').val('');
      $('[name=h_sat]').val('');
      $('[name=jumlah]').val('');
      
      $('.select').selectpicker('refresh');
    }
  }

  function kurangiJumlahMasuk() {
    jumDetailMasuk--;
  }

  function toggleTglJatuhTempo(self) {
    // console.log(self.value);
    var modal = $('#fieldTglJatuhTempo');
    if(self.value=='kredit'){
      modal.show();
      modal.find('input[name=tgljatuhtempo]').attr('required',true);
    } else if(self.value=='cash'){
      modal.hide();
      modal.find('input[name=tgljatuhtempo]').attr('required',false);
    }
  }

  
  function hitungTotal(e) {
    var qty = $('#addQty').val();
    var harga = $('#h_sat').val();
    var total = qty * harga;
    $('#jumlah').val(total).change();
  }

</script>
@endsection