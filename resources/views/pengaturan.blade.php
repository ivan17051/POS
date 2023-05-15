@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Pengaturan
@endsection

@section('pengaturanStatus')
active
@endsection

@section('modal')
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card ">
          <div class="card-header ">
            <h4 class="card-title">Pengaturan
              <!-- <small class="description">Vertical Tabs</small> -->
            </h4>
          </div>
          <div class="card-body ">
            <div class="row">
              <div class="col-md-3">

                <!-- color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger" -->                           
                <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#link110" role="tablist">
                      <i class="material-icons">timeline</i> Poin Member
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#link111" role="tablist">
                      <i class="material-icons">schedule</i> Settings
                    </a>
                  </li> -->
                </ul>
              </div>
              <div class="col-md-9">
                <div class="tab-content">
                  <div class="tab-pane active" id="link110">
                    Syarat minimal pembelanjaan untuk mendapatkan 1 poin. Berlaku kelipatan. <i>(Pembaruan terakhir {{$pengaturan->dom}})</i>
                    <form method="post" action="{{route('pengaturan.store')}}">
                    @csrf
                    <div class="input-group form-control-lg mt-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Rp
                        </span>
                      </div>
                      <div class="form-group bmd-form-group">
                        <label for="minBelanja" class="bmd-label-floating">Minimal Pembelanjaan</label>
                        <input type="text" class="form-control" id="min_belanja" name="min_belanja" required="" aria-required="true" style="font-size:25px;font-weight:bold;letter-spacing:2px;" value="{{$pengaturan->value}}">
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <button type="submit" class="btn btn-success btn-round btn-just-icon"><i class="material-icons">done</i></button>
                        </span>
                      </div>
                    </div>
                    </form>
                  </div>
                  <!-- <div class="tab-pane" id="link111">
                    Efficiently unleash cross-media information without cross-media value. Quickly maximize timely
                    deliverables for real-time schemas.
                    <br>
                    <br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
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


</script>
@endsection