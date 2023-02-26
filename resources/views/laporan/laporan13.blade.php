<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA NAKES MOU LIMBAH MEDIS DENGAN PIHAK KE-3</title>
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
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA NAKES MOU LIMBAH MEDIS DENGAN PIHAK KE-3</td>
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
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NOMOR PERSTEK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NAMA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">ALAMAT PRAKTIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">MASA BERLAKU STR</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">MOU LIMBAH MEDIS</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">MASA BERLAKU MOU</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NOMOR MOU</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                        $profesinow = '';
                        $nomor = 0;
                        @endphp

                        @foreach($data as $unit)
                        <!-- JIKA PROKFESI BERUBAH -->
                        @if($profesinow != $unit->pegawai->profesi)
                        @php
                          $profesinow = $unit->pegawai->profesi;
                          $nomor = 1;
                        @endphp
                        <tr>
                          <td class=" fontJustify" colspan="9"><b>{{$unit->pegawai->profesi}} </b></td>
                        </tr>
                        <tr>
                          <td class=" "><b>{{$nomor}}. </b></td>
                          <td class=" ">{{$unit->nomor}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" ">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" ">{{$unit->ptmou->nama}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->masamou)->translatedFormat('d M Y')}}</td>
                          <td class=" ">{{$unit->nomormou}}</td>
                        </tr>
                        @else
                        @php
                          $nomor += 1;
                        @endphp
                        <tr>
                          <td class=" "><b>{{$nomor}}. </b></td>
                          <td class=" ">{{$unit->nomor}}</td>
                          <td class=" fontCenter">{{$unit->pegawai->nama}}</td>
                          <td class=" ">{{$unit->alamatfaskes}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->expirystr)->translatedFormat('d M Y')}}</td>
                          <td class=" ">{{$unit->ptmou->nama}}</td>
                          <td class=" fontCenter">{{Carbon\Carbon::parse($unit->masamou)->translatedFormat('d M Y')}}</td>
                          <td class=" ">{{$unit->nomormou}}</td>
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