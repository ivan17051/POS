<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>LAPORAN 9 NAKES</title>
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
    
    <table class="screen panjang lebarKertasTidur">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">LAPORAN 9 NAKES</td>
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
                    
                    <table class="w-89">
                      <thead class="tb-header">
                        <tr>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px" >NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:50%;" >NAMA FASKES</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">DOKTER</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">DOKTER GIGI</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">PERAWAT</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">BIDAN</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">KESEHATAN MASYARAKAT</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">KESEHATAN LINGKUNGAN</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">APOTEKER</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">TTK</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">GIZI</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">ATLM</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;min-width:50px;">MEMENUHI</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @foreach($data as $key=>$unit)
                        <tr>
                          <td class=" fontJustify">{{$key+1}}. </td>
                          <td class=" fontLeft">{{$unit[0]}}</td>
                          <td class=" fontCenter">{{isset($unit[1]) ? $unit[1] : '-'}}</td>
                          <td class=" fontCenter">{{isset($unit[2]) ? $unit[2] : '-'}}</td>
                          <td class=" fontCenter">{{isset($unit[9]) ? $unit[9] : '-'}}</td>
                          <td class="fontCenter">{{isset($unit[10]) ? $unit[10] : '-'}}</td>
                          <td class="fontCenter">-</td>
                          <td class=" fontCenter">{{isset($unit[13]) ? $unit[13] : '-'}}</td>
                          <td class="fontCenter">{{isset($unit[11]) ? $unit[11] : '-'}}</td>
                          <td class="fontCenter">{{isset($unit[12]) ? $unit[12] : '-'}}</td>
                          <td class=" fontCenter">{{isset($unit[14]) ? $unit[14] : '-'}}</td>
                          <td class=" fontCenter">{{isset($unit[27]) ? $unit[27] : '-'}}</td>
                          <td class=" fontCenter">
                            @php
                            if(isset($unit[1]) && isset($unit[2]) && isset($unit[9]) && isset($unit[10]) && isset($unit[13]) && isset($unit[11]) && isset($unit[12]) && isset($unit[14]) && isset($unit[27])){
                              if($unit[1]!=0 && $unit[2]!=0 && $unit[9]!=0 && $unit[10]!=0 && $unit[13]!=0 && $unit[11]!=0 && $unit[12]!=0 && $unit[14]!=0 && $unit[27]!=0){
                                echo 'Memenuhi';
                              }
                              else{
                                echo 'Tidak Memenuhi';
                              }
                            }
                            else{
                              echo 'Tidak Memenuhi';
                            }
                            @endphp
                          </td>
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