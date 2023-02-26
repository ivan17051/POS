<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA NAKES PER SPESIALISASI</title>
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
    </style>
</head>

<body>
    <table class="screen panjang lebarKertasTidurPanjang">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA NAKES PER PROFESI</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter " style="font-size:14px">{{isset($profesi) ? $profesi->nama : '-'}}</td>
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
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NAMA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">TTL</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT KTP</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT DOMISIli</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">MASA BERLAKU STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">TANGGAL VERIF/CETAK</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                          $profesinow=0;
                          $spesialisasinow=null;
                          $nomor=1;
                          $nomor2=1;
                        @endphp
                        @foreach($data as $unit)
                        @if($profesinow!=$unit->idprofesi && $spesialisasinow!=$unit->idspesialisasi)
                        <tr>
                          <td colspan="13" class="fontBold" style="padding:5px;">{{isset($unit->spesialisasi->nama) ? $unit->spesialisasi->nama : 'Tidak Ada Spesialisasi'}}</td>
                        </tr>
                        @php
                        if($profesinow!=$unit->idprofesi && $spesialisasinow!=$unit->idspesialisasi){
                          $spesialisasinow=$unit->idspesialisasi;
                          $profesinow=$unit->idprofesi;
                          $nomor=1;
                          $nomor2=1;
                        }
                        @endphp
                        @elseif($profesinow==$unit->idprofesi && $spesialisasinow!=$unit->idspesialisasi && $unit->idspesialisasi != null)
                        <tr>
                          <td colspan="13" class="fontBold" style="padding:5px;">{{isset($unit->spesialisasi->nama) ? $unit->spesialisasi->nama : 'Tidak Ada Spesialisasi'}}</td>
                        </tr>
                        @php
                        if($profesinow==$unit->idprofesi && $spesialisasinow!=$unit->idspesialisasi){
                          $spesialisasinow=$unit->idspesialisasi;
                          $nomor2=1;
                          $nomor++;
                        }
                        @endphp
                        @elseif($profesinow!=$unit->idprofesi)
                        <tr>
                          <td colspan="13" class="fontBold" style="padding:5px;">{{isset($unit->spesialisasi->nama) ? $unit->spesialisasi->nama : 'Tidak Ada Spesialisasi'}}</td>
                        </tr>
                        @php
                        $profesinow=$unit->idprofesi;
                        $nomor=1;
                        @endphp
                        
                        @else
                        @php
                        if($spesialisasinow==$unit->idspesialisasi){
                          $nomor++;
                          $nomor2++;
                        }
                        else{
                          $nomor++;
                        }
                        @endphp
                        @endif
                        <tr>
                          <td class=" fontJustify">{{$nomor2}}. </td>
                          <td class=" fontJustify">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($unit->pegawai->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamat}}</td>
                          <td class=" fontCenter">{{$unit->nomor}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expiry)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->since)->translatedFormat('d M Y')}}</td>
                        </tr>
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