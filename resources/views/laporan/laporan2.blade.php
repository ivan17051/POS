<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA CETAK PERSETUJUAN TEKNIS</title>
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
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA CETAK PERSETUJUAN TEKNIS</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter " style="font-size:14px">PERIODE {{Carbon\Carbon::create($periode['tglawal'])->translatedFormat('d F Y')}} - {{Carbon\Carbon::create($periode['tglakhir'])->translatedFormat('d F Y')}}</td>
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
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:15%;">JENIS TENAGA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO PERSTEK/SIP/SIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:15%;">NO. STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">MASA BERLAKU STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">TANGGAL VERIF/CETAK</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @foreach($data as $key=>$unit)
                        <tr>
                          <td class=" fontJustify">{{$key+1}}. </td>
                          <td class=" fontJustify">{{$unit->pegawai->nik}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->profesi}}</td>
                          <td class=" fontCenter">{{$unit->nomor}}</td>
                          <td class=" fontCenter">{{$unit->nomorstr}}</td>
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