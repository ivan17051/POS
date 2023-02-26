<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA NAKES DI FASYANKES {{$faskes->nama}}</title>
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
    @php
    $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    @endphp
    <table class="screen panjang lebarKertasTidur">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA NAKES DI FASYANKES {{$faskes->nama}}</td>
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
                          <th class="headerFont fontCenter fontBold" style="font-size:13px" colspan="2">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO PERSTEK/SIP/SIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NAMA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:18%;">TTL</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:11%;">MASA BERLAKU STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:11%;">TANGGAL VERIF/CETAK</th>
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
                          <td colspan="7" class="fontBold" style="padding:5px;">{{$unit->namaprofesi}}</td>
                        </tr>
                        @if($unit->idspesialisasi != null)
                        <tr>
                          <td colspan="1" class="fontBold" style="padding:5px;"></td>
                          <td colspan="6" class="fontBold" style="padding:5px;">{{$unit->spesialisasi}}</td>
                        </tr>
                        @endif
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
                          <td colspan="1" class="fontBold" style="padding:5px;"></td>
                          <td colspan="6" class="fontBold" style="padding:5px;">{{$unit->spesialisasi}}</td>
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
                          <td colspan="7" class="fontBold" style="padding:5px;">{{$unit->namaprofesi}}</td>
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
                        @if($unit->expirystr<=date('Y-m-d'))
                        <tr>
                          @if($spesialisasinow != null)
                          <td class=" fontJustify"><b>{{$nomor}}. </b></td>
                          <td class=" fontJustify"><b>{{$nomor2}}. </b></td>
                          @else
                          <td class=" fontJustify" colspan="2"><b>{{$nomor}}. </b></td>
                          @endif
                          <td class=" fontJustify"><b>{{$unit->nomor}}</b></td>
                          <td class=" fontCenter"><b>{{$unit->nama}}</b></td>
                          <td class=" fontCenter"><b>{{$unit->tempatlahir}}, {{Carbon\Carbon::parse($unit->tanggallahir)->translatedFormat('d M Y')}}</b></td>
                          <td class=" fontCenter"><b>{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</b></td>
                          <td class=" fontCenter"><b>{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</b></td>
                        </tr>
                        @else
                        <tr>
                          @if($spesialisasinow != null)
                          <td class=" fontJustify">{{$nomor}}. </td>
                          <td class=" fontJustify">{{$nomor2}}. </td>
                          @else
                          <td class=" fontJustify" colspan="2">{{$nomor}}. </td>
                          @endif
                          <td class=" fontJustify">{{$unit->nomor}}</td>
                          <td class=" fontCenter">{{$unit->nama}}</td>
                          <td class=" fontCenter">{{$unit->tempatlahir}}, {{Carbon\Carbon::parse($unit->tanggallahir)->translatedFormat('d M Y')}}</td>
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