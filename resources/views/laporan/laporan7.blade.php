<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>LAPORAN PENDAPATAN BERDASAR METODE BAYAR</title>
    <style media="all" type="text/css">
        body{
            font-family:Arial;
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
    <table class="screen" style="max-width:5.8cm;">
        <tbody>
            <tr>
                <td class="jarak">
                  <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="fontKanan" style="text-align: center;"><img src="{{asset('/public/img/koperasi.png')}}" height="50" style="filter: grayscale(100%);"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="fontCenter " style="font-size:13px">KKPRI MART</td>
                            </tr>
                            <tr>
                              <td class="fontCenter " style="font-size:12px">SETDA PROV JATIM</td>
                            </tr>
                            <tr>
                              <td class="fontCenter " style="font-size:12px;">JL. PAHLAWAN 110 SURABAYA</td>
                            </tr>
                            <tr>
                              <td class="fontCenter " style="font-size:12px">081232679997</td>
                            </tr> 
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END OF KOP SURAT -->
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            @if(isset($periode))
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">--------------------------------------</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontBold" style="font-size:12px">Periode :</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="" style="font-size:12px">{{Carbon\Carbon::parse($periode['tglawal'])->isoformat('DD-MM-Y')}} s/d {{Carbon\Carbon::parse($periode['tglakhir'])->isoformat('DD-MM-Y')}}</td>
                            </tr>
                            @endif
                            @php
                            $tglnow = '';
                            $totcash = 0;
                            $totdebit = 0;
                            $totqris = 0;
                            $tottf = 0;
                            $totvoucher = 0;
                            $totpoin = 0;
                            @endphp
                            @foreach($data as $unit)
                            @php
                            if($unit->metode == 'cash') $totcash += $unit->total;
                            elseif($unit->metode == 'debit/kredit') $totdebit += $unit->total;
                            elseif($unit->metode == 'qris') $totqris += $unit->total;
                            elseif($unit->metode == 'transfer') $tottf += $unit->total;
                            elseif($unit->metode == 'voucher') $totvoucher += $unit->total;
                            elseif($unit->metode == 'poin') $totpoin += $unit->total;
                            @endphp
                            @if($unit->tanggal != $tglnow)
                            @php
                            $tglnow = $unit->tanggal;
                            @endphp
                            <tr>
                              <td colspan="2"></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">--------------------------------------</td>
                            </tr>
                            <tr>
                              <td class="">Tanggal</td>
                              <td class="fontKanan" style="font-size:12px">{{Carbon\Carbon::parse($unit->tanggal)->isoformat('DD-MM-Y')}}</td>
                            </tr>
                            <tr>
                              <td colspan="2"></td>
                            </tr>
                            <tr>
                              <td class="">Subtot. {{ucfirst($unit->metode)}}</td>
                              <td class="fontKanan" >{{number_format($unit->total)}} </td>
                            </tr>
                            @else
                            <tr>
                              <td class="">Subtot. {{ucfirst($unit->metode)}}</td>
                              <td class="fontKanan" >{{number_format($unit->total)}} </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">--------------------------------------</td>
                            </tr>
                            <tr>
                              <td class="fontBold" colspan="2">Total </td>
                            </tr>
                            <tr>
                              <td class="">Total Cash</td>
                              <td class="fontKanan" >{{number_format($totcash)}} </td>
                            </tr>
                            <tr>
                              <td class="">Total Debit/Kredit</td>
                              <td class="fontKanan" >{{number_format($totdebit)}} </td>
                            </tr>
                            <tr>
                              <td class="">Total QRIS</td>
                              <td class="fontKanan" >{{number_format($totqris)}} </td>
                            </tr>
                            <tr>
                              <td class="">Total Transfer</td>
                              <td class="fontKanan" >{{number_format($tottf)}} </td>
                            </tr>
                            <tr>
                              <td class="">Total Voucher</td>
                              <td class="fontKanan" >{{number_format($totvoucher)}} </td>
                            </tr>
                            <tr>
                              <td class="">Total Potong Poin</td>
                              <td class="fontKanan" >{{number_format($totpoin)}} </td>
                            </tr>
                            
                            <tr>
                              <td colspan="2"style="font-size:15px">&nbsp;</td>
                            </tr>
                            <tr>
                              <td class=""><b>GRAND TOTAL</b></td>
                              <td class="fontKanan" ><b>{{number_format($totcash+$totdebit+$totqris+$tottf+$totvoucher+$totpoin)}} </b></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END OF KOP SURAT -->
                    <!-- CONTENT -->

                    <!-- END OF CONTENT -->
                    
                </td>
            </tr>
            
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>