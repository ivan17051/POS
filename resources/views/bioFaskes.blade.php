@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Profil Faskes
@endsection

@section('bioFaskesStatus')
active
@endsection

@section('modal')
@if(isset($data['faskes']))
<div class="modal modal-custom-1 fade" id="sunting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sunting Faskes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <form id="formedit" class="form-horizontal input-margin-additional" method="POST" action="{{route('faskes.update', ['id'=>$data['faskes']->id])}}">
            @csrf
            @method('PUT')
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Nama Faskes</label>
                      <input type="text" class="form-control" id="nama" name="nama" required value="{{$data['faskes']->nama}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Alamat</label>
                      <input type="text" class="form-control" id="alamat" name="alamat" required value="{{$data['faskes']->alamat}}">
                    </div>  
                  </div>
                  <div class="col-md-6 pt-2">
                    <select name="kelurahan" id="kelurahan" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" title="Kelurahan" required>
                      <option value="" disabled selected>Pilih Kelurahan</option>
                      @foreach($data['kelurahan'] as $unit)
                      <option value="{{$unit->nama_kel}},{{$unit->nama_kec}}" @if($unit->nama_kel==$data['faskes']->kelurahan) selected @endif>{{$unit->nama_kel}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="kecamatan" class="bmd-label-floating">Kecamatan</label>
                      <input type="text" class="form-control" id="kecamatan" name="kecamatan" readonly value="{{$data['faskes']->kecamatan}}">
                    </div>  
                  </div>
                  <div class="col-md-12 mt-2">
                    <select name="idkategori" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" title="Kategori Faskes">
                      <option disabled selected>Pilih Kategori Faskes</option>
                      @foreach($data['kategori'] as $unit)
                      <option value="{{$unit->id}}" @if($unit->id==$data['faskes']->idkategori) selected @endif>{{$unit->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Koordinat X</label>
                      <input type="text" class="form-control" id="coord_x" name="coord_x" value="{{$data['faskes']->coord_x}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama" class="bmd-label-floating">Koordinat Y</label>
                      <input type="text" class="form-control" id="coord_y" name="coord_y" value="{{$data['faskes']->coord_y}}">
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
@endif
@endsection
@section('content')
<div class="container-fluid">
    @if(!isset($data['faskes']))
        <div class="text-center">
            <h5>Cari Faskes terlebih dahulu dengan klik tombol di bawah ini</h5>
            <a href="{{url('/faskes')}}" class="btn btn-primary">CARI</a>
        </div>
    @else

    @if(isset($data['nib']))
        @php
            $daydiff = (new DateTime(date('Y-m-d')))->diff(new DateTime($data['nib']->expiry));
        @endphp

        @if( $daydiff->invert )
        @php
            $isstrexpired = TRUE;
        @endphp
        <!-- expired -->
        <div class="alert alert-rose alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <span data-notify="message">NIB TELAH EXPIRED PADA TANGGAL <strong>{{strtoupper(Carbon\Carbon::parse($data['nib']->expiry)->isoFormat('D MMMM Y'))}}</strong> !!!</span>
        </div>
        @elseif( $daydiff->days < 60 )
        <!-- 2 bulan maka sudah masuk expired -->
        <div class="alert alert-rose alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <span data-notify="message">NIB AKAN MEMASUKI MASA EXPIRED PADA TANGGAL <strong>{{strtoupper(Carbon\Carbon::parse($data['nib']->expiry)->isoFormat('D MMMM Y'))}}</strong> !!!</span>
        </div>
        @endif
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="subtitle-wrapper">
                        <h4 class="card-title">PROFIL FASKES</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 text-center"> 
                            <div class="card mb-xl-0 mt-1">
                                <div class="card-body text-center">
                                    <div id = "map" style = "margin-top:0!important;width:100%;height:70vh"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col mt-7">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{$data['faskes']->nama}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($data['faskes']->alamat)? $data['faskes']->alamat : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($data['faskes']->kelurahan)? $data['faskes']->kelurahan : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($data['faskes']->kecamatan)? $data['faskes']->kecamatan : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($data['faskes']->kategori)? $data['faskes']->kategori->nama : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Koord X</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($data['faskes']->coord_x)? $data['faskes']->coord_x : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Koord Y</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($data['faskes']->coord_y)? $data['faskes']->coord_y : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-selengkapnya-wrapper d-absolute w-100 text-right">
                                <button type="button" class="btn btn-primary btn-selengkapnya" data-toggle="modal" data-target="#sunting"><i
                                        class="material-icons">edit_note</i> EDIT FASKES</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title"></span>
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#str" data-toggle="tab">
                                        <i class="material-icons">bug_report</i> NIB
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="str">
                        @include('form.nib')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    @endif
</div>
@endsection

@section('script')
<script src = "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet-src.min.js"></script>
@if(isset($data['faskes']))
<script type="text/javascript">
    @php
    $urlparam = '?faskes='.$data['faskes']->id;
    @endphp
    
    async function openHistoriNIB(idfaskes=null){
        if(!$('#modal-historinib').length){
            LOADING.show();
            try {
                let res = await my.request.get("{{route('raw.historinib').$urlparam}}")
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-historinib')
                $modal.find('.modal-title').text('Histori NIB')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
            } catch (err) {
                console.log(err)
            }
            LOADING.hide();
        }else{
            $('#modal-historinib').modal('show')
        }
    }
   
    $('select[name=kelurahan]').change(function(){
      var nama_kel = $(this).val();
      if(nama_kel){
        var kecamatan = nama_kel.split(",");
        $('input[name=kecamatan]').val(kecamatan[1]).change();
      }
    });

    $(function(){
        $('.myform').myFormAndToggle()
        my.initFormExtendedDatetimepickers()
    })

    // Creating a map object
    var mapOptions = {
        center: [{{isset($data['faskes']->coord_x) ? $data['faskes']->coord_x : -7.2794}}, {{isset($data['faskes']->coord_y) ? $data['faskes']->coord_y : 112.7484}}],
        zoom: 15,
        wheelDebounceTime: 40
    }

    var map = new L.map('map', mapOptions);
    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);
    
    @if(isset($data['faskes']->coord_x) && isset($data['faskes']->coord_y))
    // Creating a marker
    var marker = new L.Marker([{{$data['faskes']->coord_x}}, {{$data['faskes']->coord_y}}]);
    marker.addTo(map);
    marker.bindPopup('{{$data['faskes']->nama}}');
    @endif

</script>
@endif
@endsection
