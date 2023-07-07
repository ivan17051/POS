@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Stok Opname
@endsection

@section('stokopnameStatus')
active
@endsection

@section('modal')
<!-- Modal Camera -->
<div class="modal fade" id="camera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Stok Opname </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
        </div>
      
    </div>
  </div>
</div>
<!--  End Modal Camera -->

<!-- Modal View Stok Opname -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Stok Opname </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table" style="font-size:14px;">
              <thead class="text-primary">
                <th style="width:55%;font-size:15px;">Nama Barang</th>
                <th style="width:15%;font-size:15px;">Stok</th>
                <th style="width:15%;font-size:15px;">Stok Asli</th>
                <th style="width:15%;font-size:15px;">Selisih</th>
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
<!--  End Modal View Stok Opname -->

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
            <div class="col">
              <a href="{{route('stok.index')}}" class="btn btn-sm btn-dark">Kembali</a>
            </div>
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
        <form method="POST" action="{{route('stokopname.store')}}" class="form-horizontal">
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
                    <input type="date" class="form-control" name="tglstokopname" required>
                    <span class="bmd-help">Masukkan Tanggal Transaksi.</span>
                  </div>
                </div>

                <label class="col-sm-2 col-form-label">No. Transaksi</label>
                <div class="col-sm-4">
                  <div class="form-group">
                    <input type="text" class="form-control" name="nostokopname" readonly>
                    <span class="bmd-help">Masukkan Nomor Transaksi.</span>
                  </div>
                </div>
              </div>
              
              <div class="row mt-3">
                <label class="col-sm-2 col-form-label">Nama Petugas</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" class="form-control" name="petugasstokopname">
                    <span class="bmd-help">Masukkan Nama Petugas.</span>
                  </div>
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
              <div class="input-group">
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Cari Kode Barang/ Barcode">
              </div>
              <div id="qr-reader" style="width: 100%"></div>
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#camera">Scan</button>
              <div class="card-body table-full-width table-hover mt-5">
                <div class="table-responsive" style="overflow:visible;">
                  <table class="table">
                    <thead class="">
                      <th style="width:5%;">ID</th>
                      <th>Barang</th>
                      <th style="width:15%;">Stok</th>
                      <th style="width:15%;">Stok Asli</th>
                      <th style="width:15%;">Selisih</th>
                      <th style="width:5%;">Aksi</th>
                    </thead>
                    <tbody id="detailBrgMasuk">
                      <tr class="">
                        <td>#</td>
                        <td>
                          <select class="selectpicker form-control" name="addBrg" data-style="select-with-transition" title="--Pilih Barang--" data-size="3" data-live-search="true" onchange="cekStok(this)">
                            @foreach($barang as $unit)
                            <option value="{{$unit->idbarang}}" data-nama="{{$unit->namabarang}}" data-stok="{{$unit->stok}}">Stok {{$unit->stok}} | {{$unit->namabarang}} [{{$unit->kodebarang}}]</option>
                            @endforeach
                          </select>
                        </td>
                        <td><input type="text" id="stok" name="stok" class="form-control" placeholder="Stok" readonly onchange="hitungTotal(this)"></td>
                        <td><input type="text" id="stokreal" name="stokreal" class="form-control" placeholder="Stok Real" onkeyup="hitungTotal(this)"></td>
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
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<script>
  
  const html5QrCode = new Html5Qrcode("qr-reader");
  const qrCodeSuccessCallback = (decodedText, decodedResult) => {
      /* handle success */
      // console.log(`Scan result: ${decodedText}`, decodedResult);
      document.getElementById('kode_barang').value=decodedText;
      $('#formMasuk').find('select[name=addBrg]').val(decodedText).change().blur();
      // ...
      html5QrcodeScanner.clear();
      html5QrCode.stop();
  };
  const config = { fps: 10, qrbox: 250 };// Select front camera or fail with `OverconstrainedError`.
  html5QrCode.start({ facingMode: { exact: "environment"} }, config, qrCodeSuccessCallback);
  // html5QrCode.start({ facingMode: { exact: "user"} }, config, qrCodeSuccessCallback);

</script>
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
        url: "{{ route('stokopname.detail',['id'=>'']) }}" + '/' + data.id ,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          
          data.forEach(e => {
            $('#detail_brg_msk').append(
              '<tr>'+
              '<td>' + e.get_barang.namabarang + '</td>' +
              '<td>' + e.stok + '</td>' +
              '<td>' + e.stokreal + '</td>' +
              '<td>' + e.selisih + '</td>' +
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
    
    var url = "{{route('cetak.stokopname', ['id'=>''])}}/" + id;
    window.open(url, '_blank');
  }

  function hapus(id) {
    $modal = $('#hapus');
    $modal.find('form').attr('action', "{{route('stokopname.destroy', ['id'=>''])}}/" + id);

    $modal.modal('show');
  }

  function showform(con) {
    if (con == 1) {
      $('#indexMasuk').attr('hidden', true)
      $('#formMasuk').attr('hidden', false)
    } else {
      $('#indexMasuk').attr('hidden', false)
      $('#formMasuk').attr('hidden', true);
      $('#stok').val('');
      $('#stokreal').val('');
      $('#selisih').val('');
    }

  }

  function cekStok(self){
    var brg = $('[name=addBrg]').find("option:selected").data('stok');;
    $('#stok').val(brg);
    
  }
  var jumDetailMasuk=0;
  
  function addPengadaan() {
    var brg = $('[name=addBrg]').val();
    var namaBrg = $('[name=addBrg]').find("option:selected").data('nama');
    var stok = $('[name=addBrg]').find("option:selected").data('stok');
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
        '<input type="hidden" readonly name="detail[]" value="' + brg + '||' + stok + '||' + stokreal + '||' + selisih +'">' +
        '<td>' + jumDetailMasuk + '</td>' +
        '<td>' + namaBrg + '</td>' +
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
        url: '{{route("stokopname.data")}}',
        data: {
          '_token': @json(csrf_token())
        }
      },
      columns: [
        { data: 'id', title: 'ID', width: '5%' },
        { data: 'nostokopname', title: 'Nomor Transaksi' },
        { data: 'tglstokopname', title: 'Tanggal', width: '15%' },
        { data: 'status', title: 'Status', width: '15%', render: function (e, d, r) {
            if(e == 'final') return '<span class="tag badge bg-info">Final</span>';
            else if(e == 'draft') return '<span class="tag badge bg-warning">Draft</span>';
          }
        },
        {
          data: 'id', title: 'Aksi', class: "text-center", width: 1, orderable: false, render: function (e, d, r) {
            var where = '';
            if(r.status=='draft'){
              where = '<a class="dropdown-item" href="#" onclick="sunting(this)" >Sunting</a>';
            }
            var action = '<span class="nav-item dropdown ">' +
              '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
              '<i class="material-icons">more_vert</i>' +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-left" >' +
              '<a class="dropdown-item" href="#" onclick="view(this)">Lihat</a>' + where +
              '<a class="dropdown-item" href="#" onclick="cetak(this)">Cetak</a>' +
              '<a class="dropdown-item" href="{{route("stokopname.sesuai",["id"=>''])}}/'+e+'" ">Sesuaikan</a>' +
              '<div class="dropdown-divider"></div>' +
              '<a class="dropdown-item" href="#" onclick="hapus(' + e + ')">Hapus</a>' +
              '</div>' +
              '</span>'
            return action;
          }
        },
      ],
      columnDefs: [
        { responsivePriority: 2, targets: 0 },
        { className: "text-right", targets: 4 }
      ],
      
    });
  }

  function hitungTotal(e) {
    
    var stok = $('#stok').val();
    var stokreal = $('#stokreal').val();
    var selisih = stokreal - stok;
    $('#selisih').val(selisih).change();
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