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
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#link111" role="tablist">
                    <i class="material-icons">image</i> Gambar Tampilan Pembeli
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-9">
              <div class="tab-content">
                <div class="tab-pane active" id="link110">
                  Syarat minimal pembelanjaan untuk mendapatkan 1 poin. Berlaku kelipatan. <i>(Pembaruan terakhir {{$min_belanja->dom}})</i>
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
                      <input type="text" class="form-control" id="min_belanja" name="min_belanja" required="" aria-required="true" style="font-size:25px;font-weight:bold;letter-spacing:2px;" value="{{$min_belanja->value}}">
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <button type="submit" class="btn btn-success btn-round btn-just-icon"><i class="material-icons">done</i></button>
                      </span>
                    </div>
                  </div>
                  </form>
                </div>
                <div class="tab-pane" id="link111">
                  <form action="{{route('gambar.upload')}}" method="post" enctype="multipart/form-data" id="photo-form" style="display: none;">
                      @csrf
                      <input type="file" id="photo-1" name="gambar_kasir_1">
                      <input type="file" id="photo-2" name="gambar_kasir_2">
                      <input type="file" id="photo-3" name="gambar_kasir_3">
                  </form>
                  <div class="row">
                    <div class="col-md-4 col-sm-4">
                      <h4 class="title mt-0">Gambar Kasir 1</h4>
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="{{isset($gambar_1->value) ? $gambar_1->value : 'https://images.pexels.com/photos/13572116/pexels-photo-13572116.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'}}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <button class="btn btn-primary" type="button" id="trigger-photo-1">Upload Foto</button>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4">
                      <h4 class="title mt-0">Gambar Kasir 2</h4>
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="{{isset($gambar_2->value) ? $gambar_2->value : 'https://images.pexels.com/photos/3778619/pexels-photo-3778619.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'}}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <button class="btn btn-primary" type="button" id="trigger-photo-2">Upload Foto</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <h4 class="title mt-0">Gambar Kasir 3</h4>
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                          <img src="{{isset($gambar_2->value) ? $gambar_2->value : 'https://images.pexels.com/photos/6115040/pexels-photo-6115040.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'}}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                          <button class="btn btn-primary" type="button" id="trigger-photo-3">Upload Foto</button>
                        </div>
                      </div>
                    </div>
                  </div>
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
$("#trigger-photo-1").click(function(){
    $("#photo-1").click();
});
$("#trigger-photo-2").click(function(){
    $("#photo-2").click();
});
$("#trigger-photo-3").click(function(){
    $("#photo-3").click();
});

document.getElementById("photo-1").onchange = async function() {
    file=$(this)[0].files[0];

    try {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        var newfile = await my.noMoreBigFile(file);
        formData.append('file', newfile);
        const res = await myRequest.upload( "{{route('gambar.upload')}}" , formData);
        window.location.reload();
    } catch (err) {
        console.log('ayee'+err);
        myAlert('Terjadi kesalahan, pastikan file berupa gambar.');
    }
};
document.getElementById("photo-2").onchange = async function() {
    file=$(this)[0].files[0];

    try {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        var newfile = await my.noMoreBigFile(file);
        formData.append('file', newfile);
        const res = await myRequest.upload( "{{route('gambar.upload')}}" , formData);
        window.location.reload();
    } catch (err) {
        console.log('ayee'+err);
        myAlert('Terjadi kesalahan, pastikan file berupa gambar.');
    }
};
document.getElementById("photo-3").onchange = async function() {
    file=$(this)[0].files[0];

    try {
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        var newfile = await my.noMoreBigFile(file);
        formData.append('file', newfile);
        const res = await myRequest.upload( "{{route('gambar.upload')}}" , formData);
        window.location.reload();
    } catch (err) {
        console.log('ayee'+err);
        myAlert('Terjadi kesalahan, pastikan file berupa gambar.');
    }
};
</script>
@endsection