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
            @if($role=='SDMK')
            <li class="nav-item @yield('dashboardStatus') ">
                <a class="nav-link" href="{{url('/dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            @endif
            @if(in_array($role, ['SDMK','Saralkes']))
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#sidebar-master">
                    <i class="material-icons">assignment</i>
                    <p> Data Master
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @yield('masterShow')" id="sidebar-master">
                    <ul class="nav">
                        <li class="nav-item @yield('faskesStatus')">
                            <a class="nav-link" href="{{route('faskes.index')}}">
                                <span class="sidebar-mini"> F </span>
                                <span class="sidebar-normal"> Faskes </span>
                            </a>
                        </li>
                        @if($role=='Saralkes')
                        <li class="nav-item @yield('kategoriStatus')">
                            <a class="nav-link" href="{{route('kategori.index')}}">
                                <span class="sidebar-mini"> K </span>
                                <span class="sidebar-normal"> Kategori </span>
                            </a>
                        </li>
                        @elseif($role=='SDMK')
                        <li class="nav-item @yield('mandiriStatus')">
                            <a class="nav-link" href="{{route('faskesMandiri.index')}}">
                                <span class="sidebar-mini"> FM </span>
                                <span class="sidebar-normal"> Faskes Mandiri </span>
                            </a>
                        </li>
                        <li class="nav-item @yield('profesiStatus')">
                            <a class="nav-link" href="{{route('profesi.index')}}">
                                <span class="sidebar-mini"> P </span>
                                <span class="sidebar-normal"> Profesi </span>
                            </a>
                        </li>
                        <li class="nav-item @yield('userStatus')">
                            <a class="nav-link" href="{{route('user.index')}}">
                                <span class="sidebar-mini"> U </span>
                                <span class="sidebar-normal"> User </span>
                            </a>
                        </li>
                        <li class="nav-item @yield('berakhirStatus')">
                            <a class="nav-link" href="{{route('berakhir.index')}}">
                                <span class="sidebar-mini"> B </span>
                                <span class="sidebar-normal"> Berakhir </span>
                            </a>
                        </li>
                        <li class="nav-item @yield('ptmouStatus')">
                            <a class="nav-link" href="{{route('ptmou.index')}}">
                                <span class="sidebar-mini"> PM </span>
                                <span class="sidebar-normal"> PT MOU </span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item @yield('pejabatStatus')">
                            <a class="nav-link" href="{{route('pejabat.index')}}">
                                <span class="sidebar-mini"> P </span>
                                <span class="sidebar-normal"> Pejabat </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if(in_array($role,['SDMK','Bidang']))
            <li class="nav-item @yield('strStatus') ">
                <a class="nav-link" href="{{url('/str')}}">
                    <i class="material-icons">list_alt</i>
                    <p> Data SIP </p>
                </a>
            </li>
            @endif
            @if($role=="SDMK")
            <li class="nav-item @yield('nakesStatus')">
                <a class="nav-link" href="{{url('/nakes')}}">
                    <i class="material-icons">people</i>
                    <p> Data Nakes </p>
                </a>
            </li>
            <li class="nav-item @yield('bioStatus')">
                <a class="nav-link" href="{{url('/bio')}}">
                    <i class="material-icons">account_box</i>
                    <p> Bio Nakes </p>
                </a>
            </li>
            @endif
            @if($role=="Saralkes")
            <li class="nav-item @yield('bioFaskesStatus')">
                <a class="nav-link" href="{{url('/faskes/0')}}">
                    <i class="material-icons">home</i>
                    <p> Bio Faskes </p>
                </a>
            </li>
            @endif
            @if(in_array($role,['Saralkes','SDMK']))
            <li class="nav-item @yield('mapFaskesStatus')">
                <a class="nav-link" href="{{url('/faskes/map')}}">
                    <i class="material-icons">public</i>
                    <p> Peta Faskes </p>
                </a>
            </li>
            @endif
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
