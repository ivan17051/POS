@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Dashboard
@endsection

@section('dashboardStatus')
active
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="card card-stats bg-warning">
          <div class="card-header card-header-warning card-header-icon pt-3 pb-3">
            <span class="float-left"><i class="material-icons">group</i></span>
            <p class="card-category text-white "><strong>Akan Expired</strong></p>
            <h3 class="card-title text-white font-weight-bold"><strong>{{$stats['0']->total}}</strong></h3>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="card card-stats bg-danger">
          <div class="card-header card-header-warning card-header-icon pt-3 pb-3">
            <span class="float-left"><i class="material-icons">group_off</i></span>
            <p class="card-category text-white "><strong>Expired</strong></p>
            <h3 class="card-title text-white font-weight-bold"><strong>{{$stats['-1']->total}}</strong></h3>
          </div>
        </div>
      </div>
      
    <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection

@section('script')
<script>
    
</script>
@endsection