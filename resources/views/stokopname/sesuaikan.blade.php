@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Stok Opname
@endsection

@section('stokopnameStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah User </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('user.store')}}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nama" class="bmd-label-floating">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="form-group">
            <label for="username" class="bmd-label-floating">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <label class="bmd-label force-top mt-1">Role User <small
              class="text-danger align-text-top">*wajib</small></label>
          <select id="role" name="role" class="selectpicker form-control" data-size="7"
            data-style="btn btn-primary btn-round" title="Pilih Role">
            <option disabled selected>Pilih Role</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="member">Member</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-link text-primary">Simpan</button>
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  End Modal Tambah -->

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
      <form action="{{route('sesuai.store')}}" method="POST">
      @csrf
        <div class="card">
          <div class="card-header card-header-tabs card-header-primary">
            <div class="subtitle-wrapper">
              <h4 class="card-title">Penyesuaian</h4>
            </div>
          </div>
          <div class="card-body" id="index-container">

            <!-- <div class="toolbar row">
            <div class="col">
              <a href="{{route('stokopname.index')}}" class="btn btn-sm btn-dark">Kembali</a>
            </div>
            <div class="col text-right">
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah</button>
            </div>
          </div> -->
            <input type="hidden" value="{{$stok->id}}" name="id">
            <div class="row">
              <label class="col-sm-2 col-form-label">No. Penyesuaian</label>
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="nopenyesuaian" readonly value="{{isset($stok->nopenyesuaian) ? $stok->nopenyesuaian : ''}}">
                </div>
              </div>
              <label class="col-sm-2 col-form-label">No. Stok Opname</label>
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="nostokopname" readonly value="{{$stok->nostokopname}}">
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <label class="col-sm-2 col-form-label">Tanggal Penyesuaian</label>
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="date" class="form-control" name="tglpenyesuaian" 
                    value="{{isset($stok->tglpenyesuaian) ? $stok->tglpenyesuaian : $stok->tglstokopname}}" 
                    {{isset($stok->tglpenyesuaian) ? 'readonly' : ''}} required>
                  <span class="bmd-help">Masukkan Tanggal Penyesuaian.</span>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <label class="col-sm-2 col-form-label">Nama Petugas</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="petugaspenyesuaian" value="{{isset($stok->petugaspenyesuaian) ? $stok->petugaspenyesuaian : $stok->petugasstokopname}}" 
                    {{isset($stok->petugaspenyesuaian) ? 'readonly' : ''}} required>
                  <span class="bmd-help">Masukkan Nama Petugas.</span>
                </div>
              </div>
            </div>
            <div class="anim slide" id="table-container">
              <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" width="100%"
                  style="width:100%">
                  <thead>
                    <th style="width:5%;">No</th>
                    <th>Barang</th>
                    <th style="width:13%;">Selisih</th>
                    <th style="width:20%;">Hasil Penyesuaian</th>
                    <th style="width:13%;">Status</th>
                    <!-- <th style="width:5%;">Aksi</th> -->
                  </thead>
                  <tbody>
                    @foreach($detail as $key=>$unit)
                    <tr>
                      <td style="width:5%;">{{$key+1}}</td>
                      <td>{{$unit->getBarang->namabarang}}</td>
                      <td>{{$unit->selisih}}</td>
                      <td>{{$unit->stok}} &rarr; {{$unit->stokreal}}</td>
                      <td>
                        @if($stok->status=='draft') <span class="tag badge bg-warning">Draft</span>
                        @elseif($stok->status=='final') <span class="tag badge bg-info">Final</span>
                        @endif
                      </td>
                      <!-- <td style="width:5%;">
                    <a href="#" class="btn btn-link btn-warning btn-just-icon edit btn-sm" onclick="onEdit(this)"><i class="material-icons">edit_square</i></a>
                  </td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <div class="card-footer">
            <a href="{{route('stokopname.index')}}" class="btn btn-sm btn-dark">Kembali</a>
            <button type="submit" class="btn btn-sm btn-primary" {{$stok->status=='final' ? 'disabled' : ''}}>Sesuaikan</button>
          </div>

          <!--  end card  -->
        </div>
      </form>
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
      url: "{{ route('stokopname.detail',['id'=>'']) }}" + '/' + data.id,
      type: "GET",
      dataType: "JSON",
      success: function (data) {

        data.forEach(e => {
          $('#detail_brg_msk').append(
            '<tr>' +
            '<td>' + e.get_barang.namabarang + '</td>' +
            '<td>' + e.stok + '</td>' +
            '<td>' + e.stokreal + '</td>' +
            '<td>' + e.selisih + '</td>' +
            '</tr>'
          );
        })

      },
      error: function () {
        alert("No Data");
      }
    });

    $modal.modal('show')
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