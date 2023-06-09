@extends('layouts.layout')
@extends('layouts.sidebar')

@php
$role=Auth::user()->role;
@endphp

@section('title')
Riwayat Transaksi
@endsection

@section('masterShow')
show
@endsection

@section('memberStatus')
active
@endsection

@section('modal')
@endsection

@section('content')
<div class="container-fluid">
 <div class="row">
   <div class="col-md-8">
     <div class="card">
       <div class="card-header card-header-icon card-header-rose">
         <div class="card-icon">
           <i class="material-icons">perm_identity</i>
         </div>
         <h4 class="card-title">Riwayat Transaksi</h4>
       </div>
       <div class="card-body">
       <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                <tr>
                    <th hidden>id</th>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Tanggal</th>
                    <th data-priority="3">Total</th>
                    <th data-priority="2">Poin</th>
                    <!-- <th data-priority="2" class="disabled-sorting text-right">Actions</th> -->
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th hidden>id</th>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Poin</th>
                    <!-- <th class="disabled-sorting text-right">Actions</th> -->
                </tr>
                </tfoot>
                <tbody>
                @foreach($transaksi as $key=>$unit)
                <tr>
                    <td hidden>{{$unit->id}}</td>
                    <td>{{$key+1}}</td>
                    <td>{{$unit->tanggal}}</td>
                    <td>Rp {{number_format($unit->jumlah)}}</td>
                    <td>{{$unit->poin}}</td>
                    <!-- <td class="text-right">
                        <a href="#" class="btn btn-link btn-warning btn-just-icon edit btn-sm" key="{{$key}}" onclick="onEdit(this)"><i class="material-icons">edit</i></a>
                        <a href="#" class="btn btn-link btn-danger btn-just-icon remove btn-sm" key="{{$key}}" onclick="onDelete(this)"><i class="material-icons">delete</i></a>
                    </td> -->
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
       </div>
     </div>
   </div>
   <div class="col-md-4">
     <div class="card card-profile">
       <div class="card-avatar">
         <a href="#pablo">
           <img class="img" src="https://cdn-icons-png.flaticon.com/512/727/727399.png?w=740&t=st=1685457675~exp=1685458275~hmac=262d4d6290f6ae7e4c562a3818ebcc76958747e25301a5bed3b72863538f99bd" />
         </a>
       </div>
       <div class="card-body">
         <h6 class="card-category text-gray">Nama Member</h6>
         <h4 class="card-title">{{$member->nama}}</h4>
         <p class="card-description">
            {{$member->alamat}} <br>
            {{$member->notelp}}
         </p>
         <button type="button" class="btn btn-primary btn-round" disabled>Poin<div style="font-size:25px;">{{$member->poin}}<div></button>
       </div>
     </div>
   </div>
 </div>
</div>

@endsection
@section('script')
<script>
  
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