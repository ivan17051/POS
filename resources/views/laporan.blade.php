@extends('layouts.layout')
@extends('layouts.sidebar')

@php
$role=Auth::user()->role;
@endphp

@section('title')
Laporan
@endsection

@section('laporanStatus')
active
@endsection

@section('modal')
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <div class="subtitle-wrapper">
            <h4 class="card-title">Laporan</h4>
          </div>
        </div>
        
        <div class="card-body">
          <div class="toolbar row">
            <!-- Here you can write extra buttons/actions for the toolbar -->
          </div>
            <form method="post" action="{{route('data.download')}}" class="form-horizontal" id="formlaporan" target="_blank">
            @csrf
              <div class="row">
                <label class="col-md-2 col-form-label label-checkbox">Jenis Laporan</label>
                <div class="col-md-5 checkbox-radios">
                  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="1"> Laporan Penjualan Barang
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="2"> Laporan Pendapatan / Pemasukkan
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="7"> Laporan Pendapatan / Pemasukkan Per Metode Pembayaran
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="3"> Laporan Laba / Rugi
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="4"> Laporan Stok
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="5"> Laporan Barang Mendekati / Sudah Expired
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="6"> Laporan Barang Paling Laku & Tidak Laku
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="8"> Laporan Harga Jual Barang
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row" id='tanggal' hidden>
                <label class="col-sm-2 col-form-label">Pilih Periode</label>
                <div class="col-sm-5">
                  <div class="form-group">
                    <input type="text" name="tglawal" class="form-control monthyearpicker" placeholder="Awal">
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="form-group">
                    <input type="text" name="tglakhir" class="form-control monthyearpicker" placeholder="Akhir">
                  </div>
                </div>
              </div>
              <div class="row" id="lokasi" hidden>
                <label class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <select name="lokasi" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true" title="Lokasi">
                      <option value="semua">Semua Lokasi</option>
                      @foreach($lokasi as $unit)
                      <option value="{{$unit->lokasi}}">{{$unit->lokasi}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row text-right mt-3">
                <div class="col">
                  <button type="submit" class="btn btn-primary">Lihat</button>
                  <!-- <button type="submit" class="btn btn-success">Download</button>                   -->
                </div>
              </div>
            </form>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
  </div>
  <!-- end row -->
</div>
@endsection
@section('script')
<script>
  $('#formlaporan [name=jenislaporan]').change(function(e){
    // console.log(e.target.value);
    var lokasi = $('#lokasi');
    var tanggal = $('#tanggal');
    
    if(e.target.value==4 ){
      lokasi.attr('hidden', false)
      lokasi.find('select').attr('required', true);
      tanggal.attr('hidden', true)
    }else if(e.target.value==5 || e.target.value==8) {
      lokasi.attr('hidden', true)
      lokasi.find('select').attr('required', false);
      tanggal.attr('hidden', true)
    }else {
      lokasi.attr('hidden', true)
      lokasi.find('select').attr('required', false);
      tanggal.attr('hidden', false)
    }
  })

  $(function () {
    $('.monthyearpicker').datetimepicker({
      // viewMode: 'years',
      format: 'DD/MM/YYYY',
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });
  });

  
</script>
@endsection