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
                  @if($role=='Bidang')
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="3" checked> Data Tenaga Kesehatan di Fasyankes
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  @else
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="1" checked> Data Nakes Teregistrasi/Tersertifikasi
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="2"> Data Cetak Persetujuan Teknis
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="3"> Data Tenaga Kesehatan di Fasyankes
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="4"> Data Nakes per Profesi
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="5"> Data Nakes Praktik Mandiri
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="6"> Data Expiry Nakes 5 Tahunan
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="13"> Data Nakes MOU Limbah Medis dengan Pihak Ke-3
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </div>
                <div class="col-md-5 checkbox-radios">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="7"> Data Nakes per Spesialisasi
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="8"> Laporan 9 Nakes
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="9"> Laporan Jumlah Nakes Per Kategori Faskes
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="10"> Data Nakes Terverifikasi per Periode
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="11"> Data Penambahan Nakes Secara Periodik
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="12"> Data Nakes Praktik Mandiri Per Wilayah
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="14"> Laporan PIH
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  @endif
                </div>
              </div>
              <div class="row" id="faskes" @if($role!='Bidang') hidden @endif>
                <label class="col-sm-2 col-form-label">Nama Fasyankes</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <select name="idfaskes" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true" title="Fasyankes">
                      <option value="" disabled selected>Pilih Fasyankes</option>
                      @foreach($d['fasyankes'] as $unit)
                      <option value="{{$unit->id}}">{{$unit->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row" id="profesi" hidden>
                <label class="col-sm-2 col-form-label">Profesi</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <select name="idprofesi" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true" title="Profesi">
                      <option value="" disabled selected>Pilih Profesi</option>
                      @foreach($d['profesi'] as $unit)
                      <option value="{{$unit->id}}">{{$unit->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row" id="profesiman" hidden>
                <label class="col-sm-2 col-form-label">Profesi</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <select name="idprofesiman" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true" title="Profesi">
                      <option value="" disabled selected>Pilih Profesi</option>
                      <option value="0">Semua Profesi</option>
                      @foreach($d['profesiman'] as $unit)
                      <option value="{{$unit->id}}">{{$unit->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row" id="spesialisasi" hidden>
                <label class="col-sm-2 col-form-label">Profesi</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <select name="idspesialisasi" class="selectpicker form-control" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true" title="Profesi">
                      <option value="" disabled selected>Pilih Profesi</option>
                      @foreach($d['spesialisasi'] as $unit)
                      <option value="{{$unit->id}}">{{$unit->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row" id='tanggal' hidden>
                <label class="col-sm-2 col-form-label">Pilih Range Tanggal</label>
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
    var profesi = $('#profesi');
    var profesiman = $('#profesiman');
    var faskes = $('#faskes');
    var tgl = $('#tanggal');
    var spesialisasi = $('#spesialisasi');
    
    if(e.target.value==1 || e.target.value==6 || e.target.value==8 || e.target.value==9 || e.target.value==12 || e.target.value==13){
      profesi.attr('hidden', true)
      profesi.find('select').attr('required', false);
      profesiman.attr('hidden', true)
      profesiman.find('select').attr('required', false);
      spesialisasi.attr('hidden', true)
      spesialisasi.find('select').attr('required', false);
      faskes.attr('hidden', true)
      faskes.find('select').attr('required', false);
      tgl.attr('hidden', true)
      tgl.find('input').attr('required', false);
    }else if(e.target.value==2 || e.target.value==10 || e.target.value==11 || e.target.value==14){
      profesi.attr('hidden', true)
      profesi.find('select').attr('required', false);
      profesiman.attr('hidden', true)
      profesiman.find('select').attr('required', false);
      spesialisasi.attr('hidden', true)
      spesialisasi.find('select').attr('required', false);
      faskes.attr('hidden', true)
      faskes.find('select').attr('required', false);
      tgl.attr('hidden', false)
      tgl.find('input').attr('required', true);
    }else if(e.target.value==3){
      profesi.attr('hidden', true)
      profesi.find('select').attr('required', false);
      profesiman.attr('hidden', true)
      profesiman.find('select').attr('required', false);
      spesialisasi.attr('hidden', true)
      spesialisasi.find('select').attr('required', false);
      faskes.attr('hidden', false)
      faskes.find('select').attr('required', true);
      tgl.attr('hidden', true)
      tgl.find('input').attr('required', false);
    }else if(e.target.value==4){
      profesi.attr('hidden', false)
      profesi.find('select').attr('required', true);
      profesiman.attr('hidden', true)
      profesiman.find('select').attr('required', false);
      spesialisasi.attr('hidden', true)
      spesialisasi.find('select').attr('required', false);
      faskes.attr('hidden', true)
      faskes.find('select').attr('required', false);
      tgl.attr('hidden', true)
      tgl.find('input').attr('required', false);
    }else if(e.target.value==5){
      profesi.attr('hidden', true)
      profesi.find('select').attr('required', false);
      profesiman.attr('hidden', false)
      profesiman.find('select').attr('required', true);
      spesialisasi.attr('hidden', true)
      spesialisasi.find('select').attr('required', false);
      faskes.attr('hidden', true)
      faskes.find('select').attr('required', false);
      tgl.attr('hidden', false)
      tgl.find('input').attr('required', true);
    }else if(e.target.value==7){
      profesi.attr('hidden', true)
      profesi.find('select').attr('required', false);
      profesiman.attr('hidden', true)
      profesiman.find('select').attr('required', false);
      spesialisasi.attr('hidden', false)
      spesialisasi.find('select').attr('required', true);
      faskes.attr('hidden', true)
      faskes.find('select').attr('required', false);
      tgl.attr('hidden', true)
      tgl.find('input').attr('required', false);
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