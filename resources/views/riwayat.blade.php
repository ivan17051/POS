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
         <h4 class="card-title">Edit Profile -
           <small class="category">Complete your profile</small>
         </h4>
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
                    <th data-priority="2" class="disabled-sorting text-right">Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th hidden>id</th>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Poin</th>
                    <th class="disabled-sorting text-right">Actions</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($transaksi as $key=>$unit)
                <tr>
                    <td hidden>{{$unit->id}}</td>
                    <td>{{$key+1}}</td>
                    <td>{{$unit->tanggal}}</td>
                    <td>{{$unit->jumlah}}</td>
                    <td>{{$unit->poin}}</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-link btn-warning btn-just-icon edit btn-sm" key="{{$key}}" onclick="onEdit(this)"><i class="material-icons">edit</i></a>
                        <a href="#" class="btn btn-link btn-danger btn-just-icon remove btn-sm" key="{{$key}}" onclick="onDelete(this)"><i class="material-icons">delete</i></a>
                    </td>
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
           <img class="img" src="../../assets/img/faces/marc.jpg" />
         </a>
       </div>
       <div class="card-body">
         <h6 class="card-category text-gray">CEO / Co-Founder</h6>
         <h4 class="card-title">Alec Thompson</h4>
         <p class="card-description">
           Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
         </p>
         <a href="#pablo" class="btn btn-rose btn-round">Follow</a>
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