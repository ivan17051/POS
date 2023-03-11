@section('sidebar')
@php
$role = Auth::user()->role;
@endphp
<div class="sidebar" data-color="purple" data-background-color="black"
    data-image="{{asset('public/img/sidebar-1.jpg')}}">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
        -->
    <div class="logo">
        <a href="{{url('/')}}" class="simple-text logo-mini">K</a>
        <a href="{{url('/')}}" class="simple-text logo-normal">SDMK</a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{asset('public/img/logo.png')}}" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>{{ucwords(Auth::user()->nama)}}</span>
                </a>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item @yield('dashboardStatus') ">
                <a class="nav-link" href="{{url('/dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#sidebar-master">
                    <i class="material-icons">assignment</i>
                    <p> Data Master
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @yield('masterShow')" id="sidebar-master">
                    <ul class="nav">
                        <li class="nav-item @yield('kategoriStatus')">
                            <a class="nav-link" href="{{route('kategori.index')}}">
                                <span class="sidebar-mini"> K </span>
                                <span class="sidebar-normal"> Kategori </span>
                            </a>
                        </li>
                        <li class="nav-item @yield('barangStatus')">
                            <a class="nav-link" href="{{route('barang.index')}}">
                                <span class="sidebar-mini"> B </span>
                                <span class="sidebar-normal"> Barang </span>
                            </a>
                        </li>
                        <li class="nav-item @yield('userStatus')">
                            <a class="nav-link" href="{{route('user.index')}}">
                                <span class="sidebar-mini"> U </span>
                                <span class="sidebar-normal"> User </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item @yield('barangMasukStatus')">
                <a class="nav-link" href="{{route('barang_masuk.index')}}">
                    <i class="material-icons">archive</i>
                    <p> Barang Masuk </p>
                </a>
            </li>
            <li class="nav-item @yield('nakesStatus')">
                <a class="nav-link" href="{{url('/')}}">
                    <i class="material-icons">people</i>
                    <p> Transaksi </p>
                </a>
            </li>
            <li class="nav-item @yield('bioStatus')">
                <a class="nav-link" href="{{url('/')}}">
                    <i class="material-icons">account_box</i>
                    <p> Stok </p>
                </a>
            </li>
            <li class="nav-item @yield('laporanStatus')">
                <a class="nav-link" href="{{url('/data/laporan')}}">
                    <i class="material-icons">summarize</i>
                    <p> Laporan </p>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-background"></div>
</div>
@endsection
