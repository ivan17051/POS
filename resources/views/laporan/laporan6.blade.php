<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>DATA EXPIRY NAKES 5 TAHUNAN</title>
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
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">DATA EXPIRY NAKES 5 TAHUNAN</td>
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
                          <th class="headerFont fontCenter fontBold" style="font-size:13px" rowspan="2">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:50%;" rowspan="2">JENIS TENAGA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;" rowspan="2">JUMLAH TENAGA</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;" rowspan="2">STR AKTIF</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;" colspan="5">TAHUN EXPIRY</th>
                        </tr>
                        <tr>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;">{{date('Y')}}</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;">{{date('Y')+1}}</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;">{{date('Y')+2}}</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;">{{date('Y')+3}}</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px;">{{date('Y')+4}}</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                        $flag = 0;
                        $total = 0;
                        $totalaktif = [0,0,0,0,0, 0,0,0,0,0, 0,0,0,0,0, 0,0,0,0,0, 0,0,0,0,0, 0,0,0,0,0, 0,0,0,0,0, 0,0,0,0,0, 0,0,0,0,0];
                        $totaltahun = [0,0,0,0,0];
                        $j=0;
                        $i=0;
                        @endphp
                        @foreach($data as $key=>$unit)
                        <tr>
                          <td class=" fontJustify">{{$key+1}}. </td>
                          <td class=" fontLeft">{{$unit->nama}}</td>
                          <td class=" fontCenter">{{$unit->total}}</td>
                          <td class=" fontCenter">
                            @foreach($datastr as $unit2)
                            @php
                            if($unit2->idprofesi == $unit->idprofesi){
                              $totalaktif[$key] += $unit2->totalaktif;
                              $totalaktif[32] += $unit2->totalaktif;
                            }
                            @endphp
                            @endforeach
                            {{$totalaktif[$key]}}
                          </td>
                          @php
                          $total += $unit->total;
                          
                          $i=0;
                          @endphp
                          @while($j < count($datastr))
                          
                          @if($unit->idprofesi==$datastr[$j]->idprofesi)
                            @if($datastr[$j]->tahun==date('Y')+$i && $i < 5)
                              <td class=" fontCenter">{{$datastr[$j]->totalaktif}}</td>
                              @php
                              $flag += 1;
                              $totaltahun[$i] += $datastr[$j]->totalaktif;
                              $i++;
                              $j++;
                              @endphp
                            @elseif($i>=5)
                              @php
                              $j++;
                              break;
                              @endphp
                            @else
                              <td class="fontCenter">0</td>
                              @php
                              $flag += 1;
                              $i++;
                              @endphp
                            @endif
                          @elseif($datastr[$j]->idprofesi != $unit->idprofesi)
                            @if($i < 5 && $datastr[$j]->idprofesi > $unit->idprofesi)
                              <td class="fontCenter">0</td>
                              @php
                              $flag += 1;
                              $i++;
                              @endphp
                            
                            @elseif($i < 5 && $datastr[$j]->idprofesi < $unit->idprofesi)
                              @php
                              $j++;
                              @endphp
                            @else
                              @php
                              break;
                              @endphp
                            @endif
                          @elseif($datastr[$j]->tahun >= date('Y')+5)
                            @php
                            $j++;
                            @endphp
                          @else
                            <td class=" fontCenter">0</td>
                            @php
                            $j++;
                            $i++;
                            @endphp
                          
                          @endif
                          @endwhile
                          @if($flag==155 && $unit->total==0)
                          @for($i=0;$i< 5;$i++)
                          <td class=" fontCenter">0</td>
                          @endfor
                          @endif
                        </tr>
                        @endforeach
                        <tr>
                          <td class=" fontCenter fontBold" colspan='2'>TOTAL</td>
                          <td class=" fontCenter fontBold">{{$total}}</td>
                          <td class=" fontCenter fontBold">{{$totalaktif[32]}}</td>
                          @for($i=0;$i< 5;$i++)
                          <td class=" fontCenter fontBold">{{$totaltahun[$i]}}</td>
                          @endfor
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