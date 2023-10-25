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
<!-- Modal Retur -->
<div class="modal fade modal-mini modal-primary" id="retur" tabindex="-1" role="dialog"
  aria-labelledby="myDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Retur Barang Masuk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
            class="material-icons">clear</i></button>
      </div>
      <form class="" method="POST" action="">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id_barangmasuk">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
          </div>
          <div class="table-full-width table-hover mt-5">
            <div class="table-responsive" style="overflow:visible;">
              <table class="table" id="datatables2">
                <thead class="">
                  <th style="width:5%;">ID</th>
                  <th>Nama Barang</th>
                  <th style="width:10%;">QTY</th>
                  <th style="width:15%;">Harga Satuan</th>
                  <th style="width:10%;">QTY Retur</th>
                </thead>
                <tbody id="detailRetur">
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary btn-link">Simpan
            <div class="ripple-container"></div>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  End Modal Retur  -->
@endsection
@section('content')
<div class="container-fluid">
  <div class="row" id="formRetur">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Tambah Retur Barang</h4>
          </div>
        </div>
        <form method="POST" action="{{route('retur.store')}}" class="form-horizontal">
        @csrf
        <div class="card-body">

          <!-- <div class="toolbar row">
            <div class="col"></div>

          </div> -->
          <div class="anim slide">
            <input type="hidden" name="id_barangmasuk" value="{{$barang[0]->idtransaksi}}">
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
              
              <div class="card-body table-full-width table-hover mt-5">
                <div class="table-responsive" style="overflow:visible;">
                  <table class="table">
                    <thead class="">
                      <th style="width:5%;">ID</th>
                      <th>Nama Barang</th>
                      <th style="width:10%;">QTY</th>
                      <th style="width:15%;">Harga Satuan</th>
                      <th style="width:10%;">QTY Retur</th>
                      <th style="width:5%;">Aksi</th>
                    </thead>
                    <tbody id="detailBrgRetur">
                      <tr class="">
                        <td>#</td>
                        <td>
                          <select class="selectpicker form-control" name="addBrg" data-style="select-with-transition" title="--Pilih Barang--" data-size="3" data-live-search="true" id="selectBarang" onchange="setqty(this)">
                            @foreach($barang as $unit)
                            <option value="{{$unit->id}}" data-nama="{{$unit->getBarang->namabarang}}" data-qty="{{$unit->qty}}" data-h_sat="{{$unit->h_sat}}">{{$unit->getBarang->kodebarang}} | {{$unit->getBarang->namabarang}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td><input type="text" id="qty" name="qty" class="form-control" placeholder="QTY" readonly></td>
                        <td><input type="text" id="h_sat" name="h_sat" class="form-control" placeholder="Harga Satuan" readonly></td>
                        <td><input type="text" id="qtyretur" name="qtyretur" class="form-control" placeholder="QTY Retur"></td>
                        <td class="text-right"><button type="button" class="btn btn-sm btn-primary" onclick="addPengadaan()"
                            style="padding:5px;"><span class="material-icons">add</span></button></td>
                      </tr>

                    </tbody>
                  </table>

                  <!-- <div class="row">
                    <div class="col-sm-6"></div>
                    
                    <label class="col-sm-2 col-form-label">PPN</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="ppn">
                        <span class="bmd-help">Masukkan Nominal PPN.</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6"></div>
                    <label class="col-sm-2 col-form-label">Disc</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="disc">
                        <span class="bmd-help">Masukkan Nominal Diskon.</span>
                      </div>
                    </div>
                  </div> -->

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
    
    $('#detailRetur').empty();
    $.ajax({
        url: "{{ route('barang_masuk.detail',['id'=>'']) }}" + '/' + id ,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          var total = 0;
          
          data.forEach(e => {
            $('#detailRetur').append(
              '<tr>'+
              '<td>' + e.id + '</td>' +
              '<td>' + e.get_barang.namabarang + '</td>' +
              '<td>' + e.qty + '</td>' +
              '<td>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(e.h_sat) + '</td>' +
              '<td><input type="number" class="form-control" name="stok[]" value="0" min="0" max="'+ e.qty +'" data-hsat="'+ e.h_sat +'" onchange="hitungTotal(this);"></td>'+
              '</tr>'
            );
            
          });
          
          totretur = 0;
          $('#jumretur').val('0').change();
          // $("#datatables2").DataTable({
          //   paging: false,
          // });
        },
        error : function() {
            // alert("No Data");
        }
    });

    $modal.modal('show');
  }

  function setqty(self) {
    var qty = $('#selectBarang option:selected').data('qty');
    var nama = $('#selectBarang option:selected').data('nama');
    var h_sat = $('#selectBarang option:selected').data('h_sat');
    
    $('#qty').val(qty).change();
    $('#h_sat').val(h_sat).change();
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
    var idbrg = $('#selectBarang option:selected').val();
    var nama = $('#selectBarang option:selected').data('nama');
    var qty = $('[name=qty]').val();
    var h_sat = $('[name=h_sat]').val();
    var qtyretur = $('[name=qtyretur]').val();
    
    if (idbrg == '') {
      alert('Pilih Barang');
      $('[name=addBrg]').focus();
    } else if (qtyretur == '' || qtyretur <= 0) {
      alert("Qty harus valid");
    } else if (qtyretur > qty) {
      alert("Qty tidak boleh lebih dari stok");
    } else {
      jumDetailMasuk++;
      $('#detailBrgRetur').append(
        '<tr class="table-info">'+
        '<input type="hidden" readonly name="detail[]" value="' + idbrg + ',' + qtyretur + '">' +
        '<td>' + jumDetailMasuk + '</td>' +
        '<td>' + nama + '</td>' +
        '<td>' + qty + '</td>' +
        '<td>' + h_sat + '</td>' +
        '<td>' + qtyretur + '</td>' +
        '<td class="text-right"><button class="btn btn-danger btn-link" style="padding:5px;margin:0;" onclick="$(this).parent().parent().remove(); kurangiJumlahMasuk();">' +
        '<span class="material-icons">close</span>' +
        '</button></td></tr>'
      );
      
      $('[name=addBrg]').val('').change();
      $('[name=qty]').val('');
      $('[name=h_sat]').val('');
      $('[name=qtyretur]').val('');
      
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