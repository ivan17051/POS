<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA NAKES PRAKTIK MANDIRI</title>
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
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA NAKES PRAKTIK MANDIRI</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter " style="font-size:14px">{{$data['profesi']}}</td>
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
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NAMA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">TTL</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT KTP</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT DOMISIli</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO PERSTEK/SIP/SIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT PRAKTIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">WILAYAH PUSKESMAS</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">MASA BERLAKU STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">TANGGAL VERIF/ CETAK</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                          $profesinow=0;
                          $spesialisasinow=null;
                          $nomor=1;
                          $nomor2=1;
                        @endphp
                        @foreach($data['nakes'] as $key=>$unit)
                        @if($profesinow!=$unit->idprofesi && $spesialisasinow!=$unit->idspesialisasi)
                        <tr>
                          <td colspan="13" class="fontBold" style="padding:5px;">{{$unit->namaprofesi}}</td>
                        </tr>
                        @if($unit->idspesialisasi != null)
                        <tr>
                          <td colspan="1" class="fontBold" style="padding:5px;"></td>
                          <td colspan="12" class="fontBold" style="padding:5px;">{{$unit->spesialisasi}}</td>
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
                          <td colspan="12" class="fontBold" style="padding:5px;">{{$unit->spesialisasi}}</td>
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
                          <td colspan="13" class="fontBold" style="padding:5px;">{{$unit->namaprofesi}}</td>
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
                          @if($spesialisasinow != null)
                          <td class=" fontJustify"><b>{{$nomor}}. </b></td>
                          <td class=" fontJustify"><b>{{$nomor2}}. </b></td>
                          @else
                          <td class=" fontJustify" colspan="2"><b>{{$nomor}}. </b></td>
                          @endif
                          <td class=" fontCenter">{{$unit->nik}}</td>
                          <td class=" fontCenter">{{$unit->nama}}</td>
                          <td class=" fontCenter">{{$unit->tempatlahir}}, {{Carbon\Carbon::parse($unit->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->alamat}}</td>
                          <td class=" fontJustify">{{$unit->nomorstr}}</td>
                          <td class=" fontJustify">{{$unit->nomor}}</td>
                          <td class=" fontJustify">{{$unit->alamatfaskes}}</td>
                          <td class=" fontJustify">{{$unit->namapkm}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
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