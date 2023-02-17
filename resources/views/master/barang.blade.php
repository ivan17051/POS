@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Master Barang
@endsection

@section('masterShow')
show
@endsection

@section('barangStatus')
active
@endsection

@section('modal')
@if(isset($d['kategori']))
<!-- Modal Tambah Faskes -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog mt-5">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form class="form-horizontal input-margin-additional" method="POST" action="{{route('barang.store')}}">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Nama Faskes</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
              </div>  
            </div>
            
          </div>
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Koordinat X</label>
                <input type="text" class="form-control" id="coord_x" name="coord_x">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama" class="bmd-label-floating">Koordinat Y</label>
                <input type="text" class="form-control" id="coord_y" name="coord_y">
              </div>  
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-link text-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  End Modal Tambah Faskes -->

<!-- Modal Sunting Faskes -->
<div class="modal modal-custom-1 fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sunting Faskes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <form id="formedit" class="form-horizontal input-margin-additional" method="POST" action="">
            @csrf
            @method('PUT')
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Nama Faskes</label>
                      <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>  
                  </div>
                  
                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Koordinat X</label>
                      <input type="text" class="form-control" id="coord_x" name="coord_x">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Koordinat Y</label>
                      <input type="text" class="form-control" id="coord_y" name="coord_y">
                    </div>  
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
                  <button type="submit" class="btn btn-link text-primary">Simpan</button>
              </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Sunting Faskes -->
@endif
<!-- Modal Hapus -->
<div class="modal fade modal-mini modal-primary" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
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
            <h4 class="card-title">Data Fasilitas Kesehatan</h4>
          </div>
        </div>
        <div class="card-body">
          @if(isset($d['kategori']))
          <div class="filter-tags" data-select="#selectrole" data-tags="#tagsinput" data-col="2">
              <div class="form-group d-inline-block" style="width: 150px;">
                  <div class="row">
                      <div class="col">
                      <select id="selectrole" class="selectpicker" data-style2="btn-default btn-round btn-sm text-white" data-style="select-with-transition" multiple title="Filter Kategori" data-size="7" data-live-search="true">
                          <optgroup label="Kategori">
                            @foreach($d['kategori'] as $unit)
                              <option value="{{$unit->id}}">{{$unit->nama}}</option>
                            @endforeach
                          </optgroup>
                      </select>
                      </div>
                  </div>
              </div>
              <div class="h-100 d-inline-block">
                  <input id="tagsinput" hidden type="text" value="" class="form-control tagsinput" data-role="tagsinput" data-size="md" data-color="primary" data-role="filter">
              </div>
          </div>
          @endif
          <div class="toolbar row">
            <div class="col text-right"><button id="btntambah" class="btn btn-sm btn-primary" data-toggle="modal"
                  data-target="#tambah">Tambah</button></div>
          </div>
          <div class="anim slide" id="table-container">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover"
                width="100%" style="width:100%">
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

    function sunting(self) {
        var tr = $(self).closest('tr');
        var data = oTable.row(tr).data();
        
        var $modal = $('#sunting');
        
        $modal.find('input[name=nib]').val(data['nib']).change();
        $modal.find('input[name=no_sertif]').val(data['no_sertif']).change();
        $modal.find('input[name=nama]').val(data['nama']).change();
        $modal.find('input[name=alamat]').val(data['alamat']).change();
        $modal.find('select[name=kelurahan]').val(data['kelurahan']+','+data['kecamatan']).change();
        if(data['kecamatan']) $modal.find('input[name=kecamatan]').val(data['kecamatan']).change();
        else $modal.find('input[name=kecamatan]').val(" ").change();
        $modal.find('select[name=idkategori]').val(data['kategori']['id']).change();
        $modal.find('input[name=coord_x]').val(data['coord_x']).change();
        $modal.find('input[name=coord_y]').val(data['coord_y']).change();

        $('#formedit').attr('action', '{{route("barang.update", ["barang"=>"'+data['id']+'"])}}');
        $modal.modal('show')
    }

    function back() {
        $('#nakes-container').addClass('hidden')
        $('#table-container').removeClass('hidden')
        $('#btnkembali').attr('hidden', true);
        $('#btntambah').attr('hidden', false);

        if ($.fn.dataTable.isDataTable('#datatables2')) {
          $('#datatables2').DataTable().clear();
          $('#datatables2').DataTable().destroy();
          $('#datatables2').empty();
        }
    }

    function hapus(id){
      $modal=$('#hapus');
      $modal.find('form').attr('action', "{{route('barang.destroy', ['barang'=>'"+id+"'])}}");
    
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
                url: '{{route("barang.data")}}',
                data: {
                    '_token': @json(csrf_token())
                }
            },
            @if(isset($d['kategori']))
            columns: [{ data: 'id', title: 'ID'},{
                    data: 'nama',
                    title: 'Faskes'
                },
                {
                    data: 'idkategori',
                    title: 'Tingkat',
                    render: function (e, d, r) {
                        return r['kategori']['nama']
                    }
                },
                {
                    data: 'alamat',
                    title: 'Alamat'
                },
                {
                    data: 'id',
                    title: 'Aksi',
                    class: "text-center",
                    width: 1,
                    orderable: false,
                    render: function (e, d, r) {
                        return '<span class="nav-item dropdown ">' +
                            '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            '<i class="material-icons">more_vert</i>' +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-left" >' +
                            @if(Auth::user()->role=='Saralkes')
                            '<a class="dropdown-item" href="#" onclick="sunting(this)" >Sunting</a>' +
                            '<a class="dropdown-item" href="faskes/'+e+'">Detail</a>' +
                            @endif
                            '<a class="dropdown-item" href="#" onclick="daftarNakes(this)">Nakes Terkait</a>' +
                            @if(Auth::user()->role=='Saralkes')
                            '<div class="dropdown-divider"></div>' +
                            '<a class="dropdown-item" href="#" onclick="hapus('+e+')">Hapus</a>' +
                            @endif
                            '</div>' +
                            '</span>'
                    }
                },
            ],
            columnDefs: [{
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    orderable: false,
                    responsivePriority: 2,
                    targets: 3
                }
            ]
            @else
            columns: [{
                    data: 'pegawai.nama',
                    title: 'Nama Pemohon'
                },
                {
                    data: 'pegawai.profesi',
                    title: 'Profesi'
                },
                {
                    data: 'alamatfaskes',
                    title: 'Alamat'
                },
                {
                    data: 'puskesmas.nama',
                    title: 'Puskesmas',
                    render: function (e,d,r) {
                      if(e){
                        return e;
                      }
                      return '';
                    }
                },
                {
                    data: 'idpegawai',
                    title: 'Aksi',
                    class: "text-center",
                    width: 1,
                    orderable: false,
                    render: function (e, d, r) {
                        return '<a href="?nakes='+ e +'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i></a>';
                    }
                },
            ]
            @endif
            
        });
    }

    $('select[name=kelurahan]').change(function(){
      var nama_kel = $(this).val();
      if(nama_kel){
        var kecamatan = nama_kel.split(",");
        $('input[name=kecamatan]').val(kecamatan[1]).change();
      }
    });

    $(document).ready(function () {
        showTable();
        $('input[name=kecamatan]').val(" ").change();

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
@endsection
