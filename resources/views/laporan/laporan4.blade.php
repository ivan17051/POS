<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA NAKES PER PROFESI</title>
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
                              <td class="headerFont fontCenter " style="font-size:14px">{{isset($data[0]->pegawai->profesi) ? $data[0]->pegawai->profesi : '-'}}</td>
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
                          @if(isset($data[0]->pegawai->profesi) and $data[0]->pegawai->profesi==32)
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">METODE</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NAMA TEMPAT USAHA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT TEMPAT USAHA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">TANGGAL</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">MASA BERLAKU</th>
                          @else
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO PERSTEK/SIP/SIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NAMA FASYANKES</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT FASYANKES</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">MASA BERLAKU STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">TANGGAL VERIF/CETAK</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @foreach($data as $key=>$unit)
                        <tr>
                          <td class=" fontJustify">{{$key+1}}. </td>
                          <td class=" fontJustify">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($unit->pegawai->tanggallahir)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamatktp}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->alamat}}</td>
                          @if(isset($data[0]->pegawai->profesi) and $data[0]->pegawai->profesi==32)
                          <td class=" fontCenter"></td>
                          <td class=" fontCenter">{{$unit->nomor}}</td>
                          <td class=" fontCenter">{{$unit->namafaskes}}</td>
                          <td class=" fontCenter">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{$unit->expirystr}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
                          @else
                          <td class=" fontCenter">{{$unit->nomorstr}}</td>
                          <td class=" fontCenter">{{$unit->nomor}}</td>
                          <td class=" fontCenter">{{$unit->namafaskes}}</td>
                          <td class=" fontCenter">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->tglverif)->translatedFormat('d M Y')}}</td>
                          @endif
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