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
                      <input class="form-check-input" type="radio" name="jenislaporan" value="1"> Data Barang Masuk
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="jenislaporan" value="2"> Laporan Pemasukan
                      <span class="circle">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                  
                </div>
              </div>
              
              <div class="row text-right mt-3">
                <div class="col">
                  <button type="button" class="btn btn-primary">Lihat</button>
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