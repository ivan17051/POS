@include('layouts.sidebar')

@php
$role = Auth::user()->role;
$role = explode(', ', $role);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('public/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>SDMK | @yield('title')</title>
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
  <!-- DateTimePicker Tempus Dominus -->
  <!-- <link rel="stylesheet" href="{{asset('public/vendor/datetimepicker-tempus-dominus/css/tempus-dominus.min.css')}}"> -->

  <!-- jquery photo viewer -->
  <link href="{{asset('public/vendor/viewerjs/viewer.min.css')}}" rel="stylesheet" />

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

      <div class="content mt-0" style="height:90vh;">
        <div class="row">
          <div class="col-md-6">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" style="height:90vh;">
                <div class="carousel-item active">
                  <img src="https://images.pexels.com/photos/699459/pexels-photo-699459.jpeg" class="d-block w-100"
                    alt="..." style="overflow:hidden;">
                </div>
                <div class="carousel-item">
                  <img
                    src="https://images.pexels.com/photos/3778619/pexels-photo-3778619.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="..." class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">

              <div class="card mt-0">
                <div class="card-header text-center">
                  <div class="row justify-content-between">
                    <div class="col-md-4 text-start">
                      <img class="mb-2 w-25 p-2" src="../../../assets/img/logo-ct-dark.png" alt="Logo">
                      <h6>
                        KPRI Sekda Prov. Jatim
                      </h6>
                      <!-- <p class="d-block text-secondary">tel: +4 (074) 1090873</p> -->
                    </div>
                    <div class="col-lg-3 col-md-7 text-md-end text-start mt-5">
                      <h6 class="d-block mt-2 mb-0">Nama : John Doe</h6>
                      <p class="text-secondary">4006 Locust View Drive</p>
                    </div>
                  </div>
                  <br>
                  <div class="row justify-content-md-between">
                    <div class="col-md-4 ">
                      <h6 class="mb-0 text-start text-secondary font-weight-normal">
                        Invoice no
                      </h6>
                      <h5 class="text-start mb-0">
                        #0453119
                      </h5>
                    </div>
                    <div class="col-lg-5 col-md-7">
                      <div class="row text-start">
                        <div class="col-md-6">
                          <h6 class="text-secondary font-weight-normal mb-0">Invoice date:</h6>
                        </div>
                        <div class="col-md-6">
                          <h6 class="text-dark mb-0">06/03/2019</h6>
                        </div>
                      </div>
                      <div class="row text-md-end text-start">
                        <div class="col-md-6">
                          <h6 class="text-secondary font-weight-normal mb-0">Due date:</h6>
                        </div>
                        <div class="col-md-6">
                          <h6 class="text-dark mb-0">11/03/2019</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table text-right">
                          <thead>
                            <tr>
                              <th scope="col" class="pe-2 text-start ps-2">Item</th>
                              <th scope="col" class="pe-2">Qty</th>
                              <th scope="col" class="pe-2" colspan="2">Rate</th>
                              <th scope="col" class="pe-2">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-start">Premium Support</td>
                              <td class="">1</td>
                              <td class="" colspan="2">$ 9.00</td>
                              <td class="">$ 9.00</td>
                            </tr>
                            <tr>
                              <td class="text-start">Soft UI Design System PRO</td>
                              <td class="">3</td>
                              <td class="" colspan="2">$ 100.00</td>
                              <td class="">$ 300.00</td>
                            </tr>
                            <tr>
                              <td class="text-start">Parts for service</td>
                              <td class="">1</td>
                              <td class="" colspan="2">$ 89.00</td>
                              <td class="">$ 89.00</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th></th>
                              <th></th>
                              <th class="" colspan="2">Total</th>
                              <th colspan="1" class="text-right h5">$ 698</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer mt-md-5 mt-4">
                  
                </div>
              </div>

          </div>
        </div>
        @yield('content')
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <!-- <ul>
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
            </ul> -->
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by IT Dinkes Surabaya.
            <!-- <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web. -->
          </div>
        </div>
      </footer>
    </div>
  </div>
  <template id="modal-template">
    <div class="modal modal-custom-1 fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Modal title</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
          </div>
        </div>
      </div>
    </div>
  </template>

  <!--   Core JS Files   -->
  <script src="{{asset('public/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('public/js/core/popper.min.js')}}"></script>
  <script src="{{asset('public/js/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{asset('public/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{asset('public/js/plugins/moment.min.js')}}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{asset('public/js/plugins/sweetalert2.js')}}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{asset('public/js/plugins/jquery.validate.min.js')}}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{asset('public/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{asset('public/js/plugins/bootstrap-selectpicker.js')}}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{asset('public/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{asset('public/js/plugins/jquery.dataTables.min.js')}}"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{asset('public/js/plugins/bootstrap-tagsinput.js')}}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{asset('public/js/plugins/jasny-bootstrap.min.js')}}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{asset('public/js/plugins/fullcalendar.min.js')}}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{asset('public/js/plugins/jquery-jvectormap.js')}}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('public/js/plugins/nouislider.min.js')}}"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{asset('public/js/plugins/arrive.min.js')}}"></script>
  <!-- Chartist JS -->
  <script src="{{asset('public/js/plugins/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('public/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('public/js/material-dashboard.js?v=2.2.2')}}" type="text/javascript"></script>
  <!-- Jquery Validation -->
  <script src="{{asset('public/vendor/jqueryvalidation/jquery.validate.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/vendor/jqueryvalidation/localization/messages_id.min.js')}}"
    type="text/javascript"></script>
  <!-- myFormAndToggle -->
  <script src="{{asset('public/js/myformandtoggle.js')}}" type="text/javascript"></script>
  <!-- Moment JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"
    integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- jquery photo viewer -->
  <script src="{{asset('public/vendor/viewerjs/viewer.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('public/vendor/viewerjs/jquery-viewer.min.js')}}" type="text/javascript"></script>
  <!-- TypeHead JS -->
  <script src="{{asset('public/vendor/jquery-typeahead-2.11.0/jquery.typeahead.min.js')}}"></script>
  <!-- Popper Js -->
  <!-- <script src="{{asset('public/vendor/popperjs/popper.min.js')}}"></script> -->
  <!-- DateTimePicker Tempus Dominus -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script> -->

  <!-- <script src="{{asset('public/js/app.js')}}" ></script> -->

  <script>
    // tempusDominus.extend(moment, 'DD/MM/yyyy hh:mm a');
    window['_token'] = "{{ csrf_token() }}"
    window['BASEURL'] = "{{url('/')}}"
  </script>

  <!-- custom script -->
  <script src="{{asset('public/js/custom.js')}}" type="text/javascript"></script>

  <script>

  </script>

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