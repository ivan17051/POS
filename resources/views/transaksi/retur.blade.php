@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Transaksi Retur
@endsection

@section('transaksiShow')
show
@endsection

@section('returStatus')
active
@endsection

@section('modal')
<!-- Modal Tambah Barang Retur -->
<div class="modal modal-custom-1 fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 style="display: none;" aria-hidden="true">
 <div class="modal-dialog mt-5">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Tambah Retur</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
     <i class="material-icons">clear</i>
    </button>
   </div>
   <div class="modal-body">
    <div class="row">
     <div class="col-md-6">
      <div class="form-group">
       <input type="date" class="form-control" name="tanggal">
      </div>
     </div>
     <div class="col-md-6">
      <div class="form-group">
       <input type="text" class="form-control" name="nomor" placeholder="Nomor Transaksi">
      </div>
     </div>
    </div>
    
    <div class="form-group">
     <label for="id_barangmasuk">Barang Masuk</label>
     <select name="id_barangmasuk" id="id_barangmasuk" class="form-control selectpicker" data-size="7"
       data-style="select-with-transition" onchange="cari(this)" required>
       <option value="" disabled selected> Barang Masuk </option>
       @foreach($barang_masuk as $unit)
       <option value="{{$unit->id}}">{{$unit->nomor}} | Rp. {{number_format($unit->jumlah)}}</option>
       @endforeach
     </select>
    </div>

    <div class="form-group">
     <label for="id_detailbarangmasuk">Barang Retur</label>
     <select name="id_barangmasuk" id="id_detailbarangmasuk" class="form-control selectpicker" data-size="7"
       data-style="select-with-transition" required>
       <option value="" disabled selected> Barang Retur </option>
     </select>
    </div>

    <div class="form-group mt-3">
     <label for="jumlah">Jumlah</label>
     <input type="text" name="jumlah" class="form-control" disabled>
    </div>
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
    <!-- <button type="submit" class="btn btn-link text-primary">Simpan</button> -->
   </div>
  </div>
 </div>
</div>
<!-- End Modal Tambah Barang Retur -->

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
 <div class="row">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header card-header-tabs card-header-primary">
     <div class="subtitle-wrapper">
      <h4 class="card-title">Transaksi Barang Retur</h4>
     </div>
    </div>
    <div class="card-body">

     <div class="toolbar row">
      <!-- <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
        data-target="#tambah">Tambah</button></div> -->

     </div>
     <div class="anim slide" id="table-container">
      <div class="material-datatables">
       <table id="datatables" class="table table-striped table-no-bordered table-hover" width="100%" style="width:100%">
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
</div>
@endsection

@section('script')
<script>
 var oTable;
 var now = moment();

 function cari(self) {
  var tr = $(self).closest('tr');
  var data = oTable.row(tr).data();
  // console.log(data, self.value);

  var $modal = $('#tambah');
  $('#id_detailbarangmasuk').empty();
  $.ajax({
   url: "{{ route('retur.detail',['id'=>'']) }}" + '/' + self.value,
   type: "GET",
   dataType: "JSON",
   success: function (data) {
    data.forEach(e => {
     console.log(e.get_barang.namabarang);
     $('#id_detailbarangmasuk').append(
      '<option value="'+e.id+'">' + e.get_barang.namabarang + '|' + e.qty +
      '</option>'
     );
    })

   },
   error: function () {
    alert("No Data");
   }
  });

  $modal.modal('show')
 }

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

 function hapus(id) {
  $modal = $('#hapus');
  $modal.find('form').attr('action', "{{route('retur.destroy', ['id'=>''])}}/" + id);

  $modal.modal('show');
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
    url: '{{route("retur.data")}}',
    data: {
     '_token': @json(csrf_token())
    }
   },
   columns: [
    { data: 'id', title: 'ID', width: '5%' },
    { data: 'nomor', title: 'Nomor Transaksi' },
    { data: 'tanggal', title: 'Tanggal', width: '12%' },
    {
     data: 'id_barangmasuk', title: 'Barang Masuk', render: function (e, d, r) {
      if (e) return r.get_nomor.nomor;
      else return '';
     }
    },
    {
     data: 'jumretur', title: 'Total', width: '20%', render: function (e, d, r) {
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(e);
     }
    },
   ],
   columnDefs: [
    { responsivePriority: 2, targets: 0 },
    { className: "text-right", targets: 4 }
   ]

  });
 }

 function hitungTotal(e) {
  var qty = $('#qty').val();
  var harga = $('#harga_satuan').val();
  var total = qty * harga;
  $('#total').val(total).change();
 }

 $(document).ready(function () {
  showTable();


 });

</script>
@endsection