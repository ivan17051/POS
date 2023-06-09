@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Stok Opname
@endsection

@section('stokStatus')
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
  <div class="row" id="indexMasuk">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Stok Opname</h4>
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
            <h4 class="card-title">Tambah Stok Opname</h4>
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
                      <th style="width:10%;">Stok</th>
                      <th style="width:10%;">Stok Real</th>
                      <th style="width:10%;">Selisih</th>
                      <th style="width:5%;">Aksi</th>
                    </thead>
                    <tbody id="detailBrgMasuk">
                      <tr class="">
                        <td>#</td>
                        <td>
                          <select class="selectpicker form-control" name="addBrg" data-style="select-with-transition" title="--Pilih Barang--" data-size="3" data-live-search="true" onchange="cekStok(this)">
                            @foreach($barang as $unit)
                            <option value="{{$unit->idbarang}}|{{$unit->namabarang}}|{{$unit->stok}}">Stok {{$unit->stok}} | {{$unit->namabarang}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td><input type="text" id="stok" name="stok" class="form-control" placeholder="Stok" readonly onchange="hitungTotal()"></td>
                        <td><input type="text" id="stokreal" name="stokreal" class="form-control" placeholder="Stok Real" onkeyup="hitungTotal()"></td>
                        <td><input type="text" id="selisih" name="selisih" class="form-control" placeholder="Selisih" readonly></td>
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

    var $modal = $('#view');
    $('#detail_brg_msk').empty();
    $.ajax({
        url: "{{ route('barang_masuk.detail',['nomor'=>'']) }}" + '/' + data.nomor ,
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

  function showform(con) {
    if (con == 1) {
      $('#indexMasuk').attr('hidden', true)
      $('#formMasuk').attr('hidden', false)
    } else {
      $('#indexMasuk').attr('hidden', false)
      $('#formMasuk').attr('hidden', true)
    }

  }

  function cekStok(self){
    var brg = self.value.split('|');
    console.log(brg);
  }
  var jumDetailMasuk=0;
  
  function addPengadaan() {
    var brg = $('[name=addBrg]').val();
    var namaBrg = brg.split('|');
    var stok = $('[name=stok]').val();
    var stokreal = $('[name=stokreal]').val();
    var selisih = $('[name=selisih]').val();
    
    if (brg == '') {
      alert('Pilih Barang');
      $('[name=addBrg]').focus();
    } else if (stokreal == '' || stokreal <= 0) {
      alert("Stok Real harus valid");
    } else if (stokreal.indexOf(',') >= 0 || stokreal.indexOf('.') >= 0) {
      alert("Stok Real harus bilangan bulat");
    } else {
      jumDetailMasuk++;
      $('#detailBrgMasuk').append(
        '<tr class="table-info">'+
        '<input type="hidden" readonly name="detail[]" value="' + namaBrg[0] + '||' + stok + '||' + stokreal + '||' + selisih +'">' +
        '<td>' + jumDetailMasuk + '</td>' +
        '<td>' + namaBrg[1] + '</td>' +
        '<td>' + stok + '</td>' +
        '<td>' + stokreal + '</td>' +
        '<td>' + selisih + '</td>' +
        '<td class="text-right"><button class="btn btn-danger btn-link" style="padding:5px;margin:0;" onclick="$(this).parent().parent().remove(); kurangiJumlahMasuk();">' +
        '<span class="material-icons">close</span>' +
        '</button></td></tr>'
      );
      $('[name=stok]').val('');
      $('[name=addBrg]').val('').change();
      $('[name=stokreal]').val('');
      $('[name=selisih]').val('');
      
      $('.select').selectpicker('refresh');
    }
  }

  function kurangiJumlahMasuk() {
    jumDetailMasuk--;
  }

  function toggleTglJatuhTempo(self) {
    console.log(self.value);
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
        url: '{{route("stokopname.data")}}',
        data: {
          '_token': @json(csrf_token())
        }
      },
      columns: [
        { data: 'id', title: 'ID', width: '5%' },
        { data: 'get_barang.namabarang', title: 'Nama Barang', width: '18%' },
        { data: 'tanggal', title: 'Tanggal', width: '15%' },
        { data: 'stok', title: 'Stok' },
        { data: 'stokreal', title: 'Stok Real' },
        { data: 'selisih', title: 'Selisih' },
        {
          data: 'id', title: 'Aksi', class: "text-center", width: 1, orderable: false, render: function (e, d, r) {
            return '<span class="nav-item dropdown ">' +
              '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
              '<i class="material-icons">more_vert</i>' +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-left" >' +
              '<a class="dropdown-item" href="#" onclick="sunting(this)" >Sunting</a>' +
              '<a class="dropdown-item" href="#" onclick="view(this)">Lihat Barcode</a>' +
              '<div class="dropdown-divider"></div>' +
              '<a class="dropdown-item" href="#" onclick="hapus(' + e + ')">Hapus</a>' +
              '</div>' +
              '</span>'
          }
        },
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
    console.log(e);
    var stok = $('#addQty').val();
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