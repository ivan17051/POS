<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>LAPORAN JUMLAH NAKES PER KATEGORI FASKES</title>
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
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">LAPORAN JUMLAH NAKES PER KATEGORI FASKES</td>
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
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:8%;">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;">JENIS TENAGA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:14%;">RUMAH SAKIT</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:14%;">KLINIK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:14%;">PUSKESMAS</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:14%;">PRAKTIK MANDIRI</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                        $total = [0,0,0,0];
                        @endphp
                        <!-- jumlah profesi -->
                        @for($i=1;$i<=32;$i++)
                        <tr>
                          <td class="fontCenter">{{$i}}.</td>
                          <td class="">{{isset($data[$i][0]) ? $data[$i][0] : $profesi[$i-1]['nama']}}</td>
                          <td class="fontCenter">{{isset($data[$i][9]) ? $data[$i][9] : '0'}}</td>
                          <td class="fontCenter">
                            @php
                            $klinik = 0;
                            isset($data[$i][2]) ? $klinik += $data[$i][2] : '0';
                            isset($data[$i][3]) ? $klinik += $data[$i][3] : '0';
                            isset($data[$i][4]) ? $klinik += $data[$i][4] : '0';
                            isset($data[$i][5]) ? $klinik += $data[$i][5] : '0';
                            @endphp
                            {{$klinik}}
                          </td>
                          <td class="fontCenter">{{isset($data[$i][1]) ? $data[$i][1] : '0'}}</td>
                          <td class="fontCenter">{{isset($data[$i][8]) ? $data[$i][8] : '0'}}</td>
                        </tr>
                        @php
                        $total[0] += isset($data[$i][9]) ? $data[$i][9] : 0;
                        $total[1] += $klinik;
                        $total[2] += isset($data[$i][1]) ? $data[$i][1] : '0';
                        $total[3] += isset($data[$i][8]) ? $data[$i][8] : '0';
                        @endphp
                        @endfor
                        <tr>
                          <td class=" fontCenter fontBold" colspan='2'>TOTAL</td>
                          <td class=" fontCenter fontBold">{{$total[0]}}</td>
                          <td class=" fontCenter fontBold">{{$total[1]}}</td>
                          <td class=" fontCenter fontBold">{{$total[2]}}</td>
                          <td class=" fontCenter fontBold">{{$total[3]}}</td>
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