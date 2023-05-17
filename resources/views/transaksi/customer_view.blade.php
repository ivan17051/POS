@include('layouts.sidebar')

@php
$role = Auth::user()->role;
$role = explode(', ', $role);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public/img/favicon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('public/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Koperasi POS</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <meta content="{{ csrf_token() }}" name="csrf-token">
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{asset('public/css/material-dashboard.css')}}" rel="stylesheet" />
  <!-- TypeHead CSS -->
  <link href="{{asset('public/vendor/jquery-typeahead-2.11.0/jquery.typeahead.min.css')}}" rel="stylesheet" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.3/leaflet.min.css" />
  <link href="{{asset('public/css/custom.css')}}" rel="stylesheet" />
</head>

<body class="">
  @yield('modal')

  <div id="modal-bottom-bound"></div> <!-- batas bawah section modal -->
  <div id="loading">
    <span><progress class="pure-material-progress-circular" /></span>
  </div>
  <div class="wrapper ">

    <div class="main-panel" style="width:100%;">

      <div class="content mt-0" style="height:100vh;overflow:auto;">
        <div class="row">
          <div class="col-md-6">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" style="height:90vh;">
                <div class="carousel-item active">
                  <img src="https://images.pexels.com/photos/699459/pexels-photo-699459.jpeg" class="d-block w-100"
                    alt="..." >
                </div>
                <div class="carousel-item">
                  <img
                    src="https://images.pexels.com/photos/3778619/pexels-photo-3778619.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="https://images.pexels.com/photos/6115040/pexels-photo-6115040.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                  class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">

            <div class="card mt-0" style="height:100%;">
              <div class="card-header">
                <div class="row ">
                  <div class="col-md-8">
                    <span style="font-size:20px;font-weight:bold;">
                    <img class="mb-2 p-2" style="width:80px;" src="{{asset('public/img/koperasi.png')}}" alt="Logo">
                    KPRI Sekda Prov Jatim
                    </span>
                    
                    <!-- <p class="d-block text-secondary">tel: +4 (074) 1090873</p> -->
                  </div>
                  <div class="col-md-4 text-right mt-3">
                    <h5 class="d-block mt-2 mb-0">Tanggal : {{date('d-m-Y')}}</h5>
                  </div>
                </div>
                <div class="pl-2" id="member"></div>
                
              </div>
              <div class="card-body" style="height:50vh;overflow:auto;">
                <div class="row">
                  <div class="col-12">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Barang</th>  
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                      </thead>
                      <tbody id="detailBrg">
                      </tbody>
                      
                    </table>
                  </div>
                  </div>
                </div>
              </div>
              <div class="card-footer p-2 mb-4">
                <table style="width:100%;">
                  <thead class=" text-secondary" style="font-size:18px;">
                    <th style="width:50%;">Total</th>  
                    <th style="width:5%;"></th>
                    <th id="total">Rp 0</th>
                  </thead>
                </table>
              </div>
            </div>

          </div>
        </div>
        @yield('content')
      </div>
      <!-- <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="https://creative-tim.com/presentation">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by D I A Corp.
          </div>
        </div>
      </footer> -->
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="{{asset('public/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('public/js/core/popper.min.js')}}"></script>
  <script src="{{asset('public/js/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{asset('public/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{asset('public/js/plugins/moment.min.js')}}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('public/js/plugins/nouislider.min.js')}}"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{asset('public/js/plugins/arrive.min.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('public/js/material-dashboard.js?v=2.2.2')}}" type="text/javascript"></script>
  
  <script>
    // tempusDominus.extend(moment, 'DD/MM/yyyy hh:mm a');
    window['_token'] = "{{ csrf_token() }}"
    window['BASEURL'] = "{{url('/')}}"
  </script>

  <!-- custom script -->
  <script src="{{asset('public/js/custom.js')}}" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/broadcast-channel@5.1.0/dist/lib/index.es5.min.js"></script>


  <!-- Script untuk notifikasi -->
  <script>
    @if (session() -> exists('alert'))
      $(document).ready(function () {
        notification = @json(session() -> pull("alert"));
        md.showNotification(notification.icon, notification.status, notification.message);
        @php
        session() -> forget('alert');
        @endphp
      });
    @endif
  </script>
  @yield('script')
  @stack('script2')
  <script>
    const channel = new BroadcastChannel('cashier');
    channel.onmessage = msg => {
      // console.dir(msg)
      var message = msg.data.split('||');
      console.log(message);
      if(message[0]=='addmember') {
        $('#member').append('Member:<p class="mb-0" style="font-size:18px;font-weight:bold;">'+message[1]+'</p><p class="mb-0">'+message[2]+'</p>');
      }
      else if(message[0]=='removemember') $('#member').empty();
      else if(message[0]=='addbarang') {
        $('#detailBrg').append(message[1]);
        $('#total').html(message[2]);
      }
    };

    var LOADING;
    $(function () {
      LOADING = $('#loading');
      setTimeout(() => {
        LOADING.hide();
      }, 300);
    })

    const myRequest = {
      get: function (url) {
        return $.ajax({
          url: url,
          type: 'GET',
        });
      },
      post: function (url, data) {
        data["_token"] = "{{ csrf_token() }}"
        return $.ajax({
          url: url,
          method: 'POST',
          data: data,
        });
      },
      delete: function (url) {
        const data = { "_token": "{{ csrf_token() }}" }
        return $.ajax({
          url: url,
          method: 'DELETE',
          data: data,
        });
      },
      put: function (url, data) {
        data["_token"] = "{{ csrf_token() }}"
        return $.ajax({
          url: url,
          method: 'PUT',
          data: data,
        });
      },

    }

    
  </script>
</body>

</html>