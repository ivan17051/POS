@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Stok Barang
@endsection

@section('stokStatus')
active
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Stok Barang</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="toolbar row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
              <a href="{{route('stokopname.index')}}" class="btn btn-info btn-sm">Stok Opname</a>
            </div>
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
</div>
@endsection

@section('script')
<script>
  var oTable;
  var now = moment();

  function view(self) {
    var tr = $(self).closest('tr');
    var data = oTable.row(tr).data();

    var $modal = $('#view');
    $('#detail_brg_msk').empty();
    $.ajax({
        url: "{{ route('stok.data') }}",
        type: "POST",
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
        url: '{{ route("stok.data") }}',
        data: {
          '_token': @json(csrf_token())
        }
      },
      columns: [
        { data: 'id', title: 'ID' }, 
        { data: 'get_barang.namabarang', title: 'Barang' },
        { data: 'get_supplier.nama', title: 'Supplier' },
        { data: 'qtyin', title: 'Qty In' },
        { data: 'qtyout', title: 'Qty Out' },
        { data: 'penyesuaian', title: 'Penyesuaian' },
        { data: 'stok', title: 'Stok' },
        
        
      ],
      columnDefs: [
        { responsivePriority: 2, targets: 0 },
        { orderable: false, searchable: false, targets: 1 },
        { orderable: false, searchable: false, targets: 2 },
      ]

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