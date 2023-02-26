@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Profil Nakes
@endsection

@section('bioStatus')
active
@endsection

@section('modal')
@if(isset($nakes))
<div class="modal fade text-left bg-overlay-gray" id="dropdowncetakkitir" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable mt-5"
        role="document">
        <div class="modal-content" style="overflow: visible!important;">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" >Cetak Kitir
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="form-horizontal input-margin-additional" method="GET" target="_blank" >
                <div class="modal-body">
                    <div class="form-group">
                        <label class="bmd-label force-top">Jenis Permohonan</label>
                        <select class="selectpicker form-control" data-style="btn btn-outline-primary btn-round" title="Jenis Permohonan" name="idjenispermohonan" data-size="7" required>
                            @foreach($jenispermohonan as $j)
                            <option value="{{$j->id}}" >{{$j->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="bmd-label force-top">Staf SDM</label>
                        <select class="selectpicker form-control" data-style="btn btn-outline-primary btn-round" title="Staf SDM" name="idpejabat" data-size="3" required>
                            @foreach($staf as $j)
                            <option value="{{$j->id}}" >{{$j->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(isset($str->idspesialisasi) && $str->idspesialisasi != null)
                    <div class="form-group" style="margin-top:20px;">
                        <label class="bmd-label force-top">Jumlah Spesialis <small class="text-danger align-text-top">*khusus untuk praktik mandiri</small></label>
                        <input class="form-control" type="text" name="jumlah">
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link text-primary">Cetak</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade text-left bg-overlay-gray" id="dropdowncetakkitirSurket" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable mt-5"
        role="document">
        <div class="modal-content" style="overflow: visible!important;">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" >Cetak Kitir
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="form-horizontal input-margin-additional" method="GET" target="_blank" >
                <div class="modal-body">
                    <div class="form-group">
                        <label class="bmd-label force-top">Staf SDM</label>
                        <select class="selectpicker form-control" data-style="btn btn-outline-primary btn-round" title="Staf SDM" name="idpejabat" data-size="3" required>
                            @foreach($staf as $j)
                            <option value="{{$j->id}}" >{{$j->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link text-primary">Cetak</button>
                    <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
@section('content')
<div class="container-fluid">
    @if(!isset($nakes))
        <div class="text-center">
            <p style="font-size:14px;">Cari Nakes terlebih dahulu dengan klik tombol di bawah ini</p>
            <a href="{{url('/nakes')}}" class="btn btn-primary">CARI</a>
        </div>
        <div class="text-center mt-4">
            <h5 class="text-primary" style="font-weight:bold;"><i>Atau</i></h5>
            <p style="font-size:14px;">Cari Nomor Registrasi</p>
        </div>
        <div class="text-center">
            <form action="{{route('bio.searchPegawai')}}" method="post">    
                @csrf
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="form-group">
                        <label class="bmd-label force-top mb-0">Profesi</label>
                            <select name="idprofesi" id="idprofesi" class="selectpicker form-control mb-2" data-size="5" data-style="btn btn-primary btn-round" data-live-search="true" required>
                                <option value="" selected disabled>Pilih Profesi</option>
                                @foreach($profesi as $unit)
                                <option value="{{$unit->id}}">{{$unit->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mr-auto">
                        <div class="input-group no-border mt-4">
                            <input type="text" name="nomorregis" id="nomorregis" value="" class="form-control mt-1" placeholder="Nomor Regis" required>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    @else

    @if(isset($str))
        @php
            $daydiff = (new DateTime(date('Y-m-d')))->diff(new DateTime($str->expiry));
        @endphp

        @if( $daydiff->invert )
        @php
            $isstrexpired = TRUE;
        @endphp
        <!-- expired -->
        <div class="alert alert-rose alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <span data-notify="message">STR TELAH EXPIRED PADA TANGGAL <strong>{{Carbon\Carbon::parse($str->expiry)->isoFormat('D MMMM Y')}}</strong> !!!</span>
        </div>
        @elseif( $daydiff->days < 60 )
        <!-- 2 bulan maka sudah masuk expired -->
        <div class="alert alert-rose alert-with-icon" data-notify="container">
            <i class="material-icons" data-notify="icon">notifications</i>
            <span data-notify="message">STR AKAN MEMASUKI MASA EXPIRED PADA TANGGAL <strong>{{$str->expiry}}</strong> !!!</span>
        </div>
        @endif
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="subtitle-wrapper">
                        <h4 class="card-title">BIODATA PENGGUNA</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 text-center"> 
                            <!-- <div class="profil-image-wrapper d-inline-block"> -->
                                <form action="{{route('profil.upload')}}" method="post" enctype="multipart/form-data" id="photo-form" style="display: none;">
                                    @csrf
                                    <input type="file" id="photo" name="file" hidden>
                                </form>
                                    <div class="card mb-xl-0 mt-1">
                                        <div class="card-body text-center">
                                            <div style="height:10rem;width:10rem;margin: auto;overflow: hidden;position: relative;" class=" rounded-circle">
                                                <img class="img-account-profile profile-pict mb-2" src="{{ isset($nakes->foto) ? $nakes->foto : asset('public/img/logo.png')}}" alt=""
                                                    style="position:absolute;top:0;left:0;width:10rem;">
                                            </div>
                                            @if(isset($nakes->foto))
                                            <form action="{{route('profil.hapus', ['id'=>$nakes->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-round btn-fab btn-danger" style="position: relative; top: -150px; right: -60px"><i class="material-icons">close</i><div class="ripple-container"></div></button>
                                            </form>
                                            @endif
                                            <button class="btn btn-primary" type="button" id="trigger-photo">Upload Foto</button>
                                        </div>
                                    </div>
                                
                            <!-- </div> -->
                        </div>
                        <div class="col mt-3">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{$nakes->nama}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Profesi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($nakes->profesi)? $nakes->profesi : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Spesialisasi</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" class="form-control" value="{{isset($nakes->spesialisasi)? $nakes->spesialisasi : '-'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-selengkapnya-wrapper d-absolute w-100 text-right">
                                <button type="button" class="btn btn-primary btn-selengkapnya" onclick="openSelengkapnya()"><i
                                        class="material-icons">more_vert</i> SELENGKAPNYA</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title"></span>
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#str" data-toggle="tab">
                                        <i class="material-icons">bug_report</i> STR
                                        <div class="ripple-container"></div>
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                @if(isset($str))
                                @for($i=0;$i<=min($makssip-1, count($sips));$i++)
                                    @if($str->isactive OR  (!$str->isactive AND isset($sips[$i])))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sip{{$i+1}}" data-toggle="tab">
                                            <i class="material-icons">code</i> SIP {{$i+1}}
                                            <div class="ripple-container"></div>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    @endif
                                @endfor
                                    @if(in_array($nakes->idprofesi, [1,2,3,4]))
                                    <li class="nav-item">
                                        <a class="nav-link show" href="#surket" data-toggle="tab">
                                            <i class="material-icons">drafts</i> Surket
                                            <div class="ripple-container"></div>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="str">
                            @include('form.str')
                        </div>
                        @if(isset($str))
                        @for($i=0;$i<=min($makssip-1, count($sips));$i++)
                        @if($str->isactive OR  (!$str->isactive AND isset($sips[$i])))
                        <div class="tab-pane" id="sip{{$i+1}}">
                            @include('form.sip', ['index'=> $i ])
                        </div>
                        @endif
                        @endfor
                        <div class="tab-pane" id="surket">
                            @include('form.surket')
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    @endif
</div>
@endsection

@section('script')
<script type="text/javascript">
    async function openSelengkapnya(){
        if(!$('#modal-biodata').length){
            LOADING.show();
            try {
                let res = await my.request.get("{{route('raw.bio').$urlparam}}")
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-biodata')
                $modal.find('.modal-title').text('Biodata Nakes')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
                setTimeout(() => {
                    $modal.find('.selectpicker').selectpicker({liveSearch:true}); 
                    $modal.find('.myform').myFormAndToggle() 
                }, 200);
            } catch (err) {
                console.log(err)
            }
            LOADING.hide();
        }else{
            $('#modal-biodata').modal('show')
        }
    }

    async function openHistoriSTR(idstr=null){
        if(!$('#modal-historistr').length){
            LOADING.show();
            try {
                let additionalParam = ''
                if(idstr) additionalParam+='&idstr='+idstr
                let res = await my.request.get("{{route('raw.historistr').$urlparam}}"+additionalParam)
                let $modal = $($('#modal-template').html())
                $modal.attr('id','modal-historistr')
                $modal.find('.modal-title').text('Histori STR')
                $modal.find('.modal-body').append(res)
                $('body').prepend($modal);
                $modal.modal('show')
            } catch (err) {
                console.log(err)
            }
            LOADING.hide();
        }else{
            $('#modal-historistr').modal('show')
        }
    }

    async function openHistoriSIP(index, idstr=null){
        LOADING.show();
        try {
            let additionalParam = ''
            if(idstr) additionalParam+='&idstr='+idstr
            let res = await my.request.get("{{route('raw.historisip', ['index'=>''])}}/"+index+"{{$urlparam}}"+additionalParam)
            let $modal = $($('#modal-template').html())
            $modal.attr('id','modal-historisip')
            $modal.find('.modal-title').text('Histori SIP')
            $modal.find('.modal-body').append(res)
            $('body').prepend($modal);
            $modal.modal('show')
        } catch (err) {
            console.log(err)
        }
        LOADING.hide();
    }

    async function openHistoriSurket(index){
        LOADING.show();
        try {
            let additionalParam = ''
            let res = await my.request.get("{{route('raw.historisurket', ['idnakes'=>''])}}"+index)
            let $modal = $($('#modal-template').html())
            $modal.attr('id','modal-historisurket')
            $modal.find('.modal-title').text('Histori Surat Keterangan')
            $modal.find('.modal-body').append(res)
            $('body').prepend($modal);
            $modal.modal('show')
        } catch (err) {
            console.log(err)
        }
        LOADING.hide();
    }

    function cetakKitir(idsip, idjenispermohonan=null){
        let $modal = $('#dropdowncetakkitir')
        let $form = $modal.find('form')
        $form.attr('action',"{{route('cetak.kitir', ['idsip'=>''])}}/"+ idsip)
        $form.find('[name=idjenispermohonan]').selectpicker('val', idjenispermohonan).change();
        $form.find('[name=idpejabat]').selectpicker('val', null).change();
        $modal.modal('show')
    }

    function cetakKitirSurket(url){
        let $modal = $('#dropdowncetakkitirSurket');
        let $form = $modal.find('form');
        
        $form.attr('action',url);
        $form.find('[name=idpejabat]').selectpicker('val', null).change();
        $modal.modal('show');
    }
    
    $(function(){
        $('.myform').myFormAndToggle()
        my.initFormExtendedDatetimepickers()
    })

    $("#trigger-photo").click(function(){
        $("#photo").click();
    });

    @if(isset($nakes))
    document.getElementById("photo").onchange = async function() {
        file=$(this)[0].files[0];

        try {
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('idpegawai', "{{$nakes->id}}");
            var newfile = await my.noMoreBigFile(file);
            formData.append('file', newfile);
            const res = await myRequest.upload( "{{route('profil.upload')}}" , formData);
            window.location.reload();
        } catch (err) {
            console.log('ayee'+err);
            myAlert('Terjadi kesalahan, pastikan file berupa gambar.');
        }
    };
    @endif
</script>
@endsection
