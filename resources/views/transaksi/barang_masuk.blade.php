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

<!-- Modal Hapus -->
<div class="modal fade modal-mini modal-primary" id="retur" tabindex="-1" role="dialog"
  aria-labelledby="myDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-small">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
            class="material-icons">clear</i></button>
      </div>
      <form class="" method="POST" action="">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id_barangmasuk">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control">
          </div>
          <div class="form-group">
            <label for="jumlah">Nominal</label>
            <input type="text" name="jumlah" class="form-control">
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary btn-link">Simpan
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
  <div class="row" id="indexMasuk">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Transaksi Barang Masuk</h4>
          </div>
        </div>
        <div class="card-body" id="index-container">

          <div class="toolbar row">
            <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary"
                onclick="showform(1)">Tambah</button></div>

          </div>
          <div class="anim slide" id="table-container">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" width="100%"
                style="width:100%">
                <thead>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <div class="card-body" id="form-container" hidden>

          <div class="toolbar row">
            <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#tambah">Tambah</button></div>

          </div>
          <div class="anim slide" id="table-container">
            <div class="material-datatables">

            </div>
          </div>

        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
  </div>
  <div class="row" id="formMasuk" hidden>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Tambah Transaksi Barang Masuk</h4>
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
                    <input type="date" class="form-control" name="tanggal" required>
                    <span class="bmd-help">Masukkan Tanggal Transaksi.</span>
                  </div>
                </div>

                <label class="col-sm-2 col-form-label">No. Transaksi</label>
                <div class="col-sm-4">
                  <div class="form-group">
                    <input type="text" class="form-control" name="nomor" readonly>
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

                    </tbody>
                  </table>
                </div>
              </div>
            
          </div>

        </div>
        <div class="card-footer">
          <button class="btn btn-sm btn-dark" onclick="showform(0)">Kembali</button>
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

  function view(self) {
    var tr = $(self).closest('tr');
    var data = oTable.row(tr).data();
    // console.log(data);

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

  function retur(id){
    $modal = $('#retur');
    $modal.find('form').attr('action', "{{route('retur.store')}}");
    $modal.find('input[name=id_barangmasuk]').val(id);

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
        { data: 'id', title: 'ID', width: '5%' },
        { data: 'nomor', title: 'Nomor Transaksi', width: '18%' },
        { data: 'tanggal', title: 'Tanggal', width: '15%' },
        { data: 'get_supplier.nama', title: 'Supplier', searchable: false },
        {
          data: 'jumlah', title: 'Total', width: '15%', render: function (e, d, r) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR'}).format(e);
          }
        },
        { data: 'action', title: 'Aksi', width: '10%', orderable: false },
      ],
      columnDefs: [
        { responsivePriority: 2, targets: 0 },
        { className: "text-right", targets: 5 }
      ],
      createdRow: function (row, data, dataIndex) {
        var date1 = moment().toDate();
        var date2 = moment(data['tgljatuhtempo'],"Y-MM-DD");
        var diff = date2.diff(date1,"days");
        
        if(data['metode']=='kredit' && data['islunas']==0){
          if(diff>30){
            $(row).addClass('bg-success');
          } else if(diff>15){
            $(row).addClass('bg-warning');
          } else if(diff>=0){
            $(row).addClass('bg-danger');
          } 
        } else if(data['metode']=='kredit' && data['islunas']==1){
          $(row).addClass('bg-info');
        }
        
        
      },
    });
  }

  function hitungTotal(e) {
    var qty = $('#addQty').val();
    var harga = $('#h_sat').val();
    var total = qty * harga;
    $('#jumlah').val(total).change();
  }

  $(document).ready(function () {
    showTable();
    $('input[name=kecamatan]').val(" ").change();

    //event pada tags filter
    $(".filter-tags").each(function () {
      var sel = $($(this).data('select'));
      var put = $($(this).data('tags'));
      var col = parseInt($(this).data('col'));
      put.tagsinput('input').attr('hidden', true);

      // filter selectpicker on change
      sel.change(function () {
        put.tagsinput('removeAll');

        for (const opt of sel[0].selectedOptions) {
          put.tagsinput('add', opt.textContent);
        }

        //search nya pakai regex misal "Pusat|Spesial" artinya boleh Pusat atau Spesial
        if (!sel.val().length) {
          oTable.column(col).search('').draw();
        }
        else {
          var searchStr = '^(' + sel.val().join('|') + ')$';
          oTable.column(col).search(searchStr, true, false).draw();
        }
      });

      // filter tags input on removed
      put.on('itemRemoved', function (event) {
        let text = event.item;
        let items = []
        for (const opt of sel[0].selectedOptions) {
          if (opt.textContent != text) {
            items.push(opt.value)
          }
        }
        sel.selectpicker('val', items);
      });
    });
  });

</script>
@endsection