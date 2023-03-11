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
  <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
          <img src="https://images.pexels.com/photos/699459/pexels-photo-699459.jpeg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://images.pexels.com/photos/3778619/pexels-photo-3778619.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
    </div>
  </div> -->
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="card card-stats bg-warning">
          <div class="card-header card-header-warning card-header-icon pt-3 pb-3">
            <span class="float-left"><i class="material-icons">group</i></span>
            <p class="card-category text-white "><strong>Akan Expired</strong></p>
            <h3 class="card-title text-white font-weight-bold"><strong>120</strong></h3>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="card card-stats bg-danger">
          <div class="card-header card-header-warning card-header-icon pt-3 pb-3">
            <span class="float-left"><i class="material-icons">group_off</i></span>
            <p class="card-category text-white "><strong>Expired</strong></p>
            <h3 class="card-title text-white font-weight-bold"><strong>120</strong></h3>
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