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
        <form method="POST" action="{{route('barang_masuk.update', ['id'=>$barang_masuk->id])}}" class="form-horizontal">
        @csrf
        @method('PUT')
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
                    <option value="{{$unit->id}}" @if($unit->id==$barang_masuk->idsupplier) selected @endif>{{$unit->nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <label class="col-sm-2 col-form-label">Metode Pembayaran</label>
                <div class="col-sm-10">
                  <select class="selectpicker form-control" name="metode" data-style="select-with-transition" title="--Pilih Metode Pembayaran--" required onchange="toggleTglJatuhTempo(this)">
                    <option value="cash" @if($barang_masuk->metode=='cash') selected @endif>Cash</option>
                    <option value="kredit" @if($barang_masuk->metode=='kredit') selected @endif>Kredit/Termin</option>
                  </select>
                  
                </div>
              </div>
              <div class="row mt-3" id="fieldTglJatuhTempo" style="display:none;">
                <label class="col-sm-2 col-form-label">Tanggal Jatuh Tempo</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="tgljatuhtempo">
                </div>
              </div>
              <input type="hidden" name="list_hapus" id="list_hapus">
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
                        <td class="text-right"><button type="button" class="btn btn-sm btn-danger" onclick="delBarang(this, {{$unit->id}})"
                            style="padding:5px;"><span class="material-icons">close</span></button></td>
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
          <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
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

  function delBarang(self, id) {
   var tr = $(self).closest('tr');
   tr.remove();
   
   $('#list_hapus').val($('#list_hapus').val()+'|'+id);
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