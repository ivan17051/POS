<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA PENAMBAHAN NAKES SECARA PERIODIK</title>
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
    
    <table class="screen panjang lebarKertasTegak">
        <tbody>
          
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA PENAMBAHAN NAKES SECARA PERIODIK</td>
                            </tr>
                            <tr>
                            <td class="headerFont fontCenter " style="font-size:14px">Periode {{Carbon\Carbon::create($periode['tglawal'])->translatedFormat('d F Y')}} - {{Carbon\Carbon::create($periode['tglakhir'])->translatedFormat('d F Y')}}</td>
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
                    
                    <table class="w-85">
                      <thead class="tb-header">
                        <tr>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:8%;">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:65%;">JENIS TENAGA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;">JUMLAH TENAGA</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                        $total = 0;
                        @endphp
                        @foreach($data as $key=>$unit)
                        <tr>
                          <td class=" fontJustify">{{$key+1}}. </td>
                          <td class=" fontJustify">{{$unit->profesi}}</td>
                          <td class=" fontCenter">{{$unit->total}}</td>
                          @php
                          $total += $unit->total;
                          @endphp
                        </tr>
                        @endforeach
                        <tr>
                          <td class=" fontCenter fontBold" colspan='2'>TOTAL</td>
                          <td class=" fontCenter fontBold">{{$total}}</td>
                        </tr>
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