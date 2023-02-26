<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA NAKES PRAKTIK MANDIRI PER WILAYAH</title>
    <style media="all" type="text/css">
        body{
            font-family:Verdana, Geneva, sans-serif;
            font-size:12px;
            padding:0px;
            margin:0px;
        } 
        .TebalBorder{ 
            border-bottom:solid 2px;
        } 
        p{
            text-indent:40px;
        }
        .indent1{
            background-color:#5a5a5a;
        }
        .indent2{
            background-color:#808080;
        }
        .indent3{
            background-color:#a6a6a6;
        }
    </style>
</head>

<body>
    <table class="screen panjang lebarKertasTidur">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA NAKES PRAKTIK MANDIRI PER WILAYAH</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END OF KOP SURAT -->
                    <!-- CONTENT -->
                    
                    <table class="w-90">
                      <thead class="tb-header">
                      <tr>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px" colspan="4">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NAMA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">TTL</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT KTP</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT DOMISIli</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO PERSTEK/SIP/SIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT PRAKTIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">MASA BERLAKU STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">TANGGAL VERIF/ CETAK</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                        $wilnow = '';
                        $kecnow = '';
                        $pkmnow = '';
                        $profesinow = '';
                        $nomor = 0;
                        @endphp

                        @foreach($data as $unit)
                        <!-- JIKA WILAYAH BERUBAH -->
                        @if($wilnow != $unit->wilayah)
                        @php
                          $wilnow = $unit->wilayah;
                          $kecnow = $unit->nama_kec;
                          $pkmnow = $unit->nama;
                          $profesinow = $unit->pegawai->profesi;
                          $nomor = 1;
                        @endphp
                        <tr>
                          <td class=" fontJustify" colspan="14"><b>SURABAYA {{$unit->wilayah}} </b></td>
                        </tr>
                        <tr>
                          <td class="indent1"></td>
                          <td class=" fontJustify" colspan="13"><b>KECAMATAN {{$unit->nama_kec}} </b></td>
                        </tr>
                        <tr>
                          <td class="indent1"></td>
                          <td class="indent2"></td>
                          <td class=" fontJustify" colspan="12"><b>{{$unit->nama}} </b></td>
                        </tr>
                        <tr>
                          <td class="indent1"></td>
                          <td class="indent2"></td>
                          <td class="indent3"></td>
                          <td class=" fontJustify" colspan="11"><b>{{strtoupper($unit->pegawai->profesi)}} </b></td>
                        </tr>
                        <tr>
                          <td class="indent1"></td>
                          <td class="indent2"></td>
                          <td class="indent3"></td>
                          <td class=" fontJustify"><b>{{$nomor}}. </b></td>
                          <td class=" fontCenter">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($unit->pegawai->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamat}}</td>
                          <td class=" fontJustify">{{$unit->nomorstr}}</td>
                          <td class=" fontJustify">{{$unit->nomor}}</td>
                          <td class=" fontJustify">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
                        </tr>
                        <!-- JIKA KECAMATAN BERUBAH -->
                        @elseif($kecnow != $unit->nama_kec)
                        @php
                          $kecnow = $unit->nama_kec;
                          $pkmnow = $unit->nama;
                          $profesinow = $unit->pegawai->profesi;
                          $nomor = 1;
                        @endphp
                        <tr>
                          <td class="indent1"></td>
                          <td class=" fontJustify" colspan="13"><b>KECAMATAN {{$unit->nama_kec}} </b></td>
                        </tr>
                        <tr>
                          <td class="indent1"></td>
                          <td class="indent2"></td>
                          <td class=" fontJustify" colspan="12"><b>{{$unit->nama}} </b></td>
                        </tr>
                        <tr>
                          <td class="indent1"></td>
                          <td class="indent2"></td>
                          <td class="indent3"></td>
                          <td class=" fontJustify" colspan="11"><b>{{strtoupper($unit->pegawai->profesi)}} </b></td>
                        </tr>
                        <tr>
                          <td class=" indent1"></td>
                          <td class=" indent2"></td>
                          <td class=" indent3"></td>
                          <td class=" fontJustify"><b>{{$nomor}}. </b></td>
                          <td class=" fontCenter">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($unit->pegawai->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamat}}</td>
                          <td class=" fontJustify">{{$unit->nomorstr}}</td>
                          <td class=" fontJustify">{{$unit->nomor}}</td>
                          <td class=" fontJustify">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
                        </tr>
                        <!-- JIKA PKM BERBEDA -->
                        @elseif($pkmnow != $unit->nama)
                        @php
                          $pkmnow = $unit->nama;
                          $profesinow = $unit->pegawai->profesi;
                          $nomor = 1;
                        @endphp
                        <tr>
                          <td class=" indent1"></td>
                          <td class=" indent2"></td>
                          <td class=" fontJustify" colspan="12"><b>{{$unit->nama}} </b></td>
                        </tr>
                        <tr>
                          <td class="indent1"></td>
                          <td class="indent2"></td>
                          <td class="indent3"></td>
                          <td class=" fontJustify" colspan="11"><b>{{strtoupper($unit->pegawai->profesi)}} </b></td>
                        </tr>
                        <tr>
                          <td class=" indent1"></td>
                          <td class=" indent2"></td>
                          <td class=" indent3"></td>
                          <td class=" fontJustify"><b>{{$nomor}}. </b></td>
                          <td class=" fontCenter">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($unit->pegawai->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamat}}</td>
                          <td class=" fontJustify">{{$unit->nomorstr}}</td>
                          <td class=" fontJustify">{{$unit->nomor}}</td>
                          <td class=" fontJustify">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
                        </tr>
                        <!-- JIKA PROFESI BERBEDA -->
                        @elseif($profesinow != $unit->pegawai->profesi)
                        @php
                          $profesinow = $unit->pegawai->profesi;
                          $nomor = 1;
                        @endphp
                        <tr>
                          <td class="indent1"></td>
                          <td class="indent2"></td>
                          <td class="indent3"></td>
                          <td class=" fontJustify" colspan="11"><b>{{strtoupper($unit->pegawai->profesi)}} </b></td>
                        </tr>
                        <tr>
                          <td class=" indent1"></td>
                          <td class=" indent2"></td>
                          <td class=" indent3"></td>
                          <td class=" fontJustify"><b>{{$nomor}}. </b></td>
                          <td class=" fontCenter">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($unit->pegawai->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamat}}</td>
                          <td class=" fontJustify">{{$unit->nomorstr}}</td>
                          <td class=" fontJustify">{{$unit->nomor}}</td>
                          <td class=" fontJustify">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
                        </tr>
                        @else
                        @php
                          $nomor += 1;
                        @endphp
                        <tr>
                          <td class=" indent1"></td>
                          <td class=" indent2"></td>
                          <td class=" indent3"></td>
                          <td class=" fontJustify"><b>{{$nomor}}. </b></td>
                          <td class=" fontCenter">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($unit->pegawai->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamat}}</td>
                          <td class=" fontJustify">{{$unit->nomorstr}}</td>
                          <td class=" fontJustify">{{$unit->nomor}}</td>
                          <td class=" fontJustify">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
                        </tr>
                        @endif
                        
                        @endforeach
                      </tbody>
                    </table>
                    <!-- END OF CONTENT -->
                </td>
            </tr>
        </tbody>
    </table>
    <script>
        // window.print();
    </script>
</body>

</html>