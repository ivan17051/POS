<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>STRUK</title>
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
    @php
    $bulan = ['','I','II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    @endphp
    <table class="screen" style="width:5.8cm;">
        <tbody>
            <tr>
                <td class="jarak">
                  <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="fontKanan" style="text-align: center;"><img src="{{asset('/public/img/koperasi.png')}}" height="50"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="fontCenter " style="font-size:13px">KPRI SEKDA PROV JATIM</td>
                            </tr>
                            <tr>
                              <td class="fontCenter " style="font-size:12px;">JL. PAHLAWAN 110 SURABAYA</td>
                            </tr>
                            <tr>
                              <td class="fontCenter " style="font-size:12px">03188188593</td>
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
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">-----------------------------------</td>
                            </tr>
                            <tr>
                              <td class="" style="font-size:12px">{{$barang_keluar->tanggal}}</td>
                            </tr>
                            <tr>
                              <td class="" >Kasir: </td>
                            </tr>
                            <tr>
                              <td>No. {{$barang_keluar->nomor}}</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">-----------------------------------</td>
                            </tr>
                            @foreach($detail as $unit)
                            <tr>
                              <td colspan="2" class="" style="font-size:12px">{{$unit->getBarang->namabarang}}</td>
                            </tr>
                            <tr>
                              <td class="" >{{$unit->qty}} x {{number_format($unit->h_sat)}} </td>
                              <td class="fontKanan" >{{number_format($unit->jumlah)}} </td>
                            </tr>
                            @endforeach
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">-----------------------------------</td>
                            </tr>
                            <tr>
                              <td class="" >Total </td>
                              <td class="fontKanan" >{{number_format($barang_keluar->jumlah)}} </td>
                            </tr>
                            <tr>
                              <td class="" >Bayar </td>
                              <td class="fontKanan" >{{isset($barang_keluar->bayar) ? number_format($barang_keluar->bayar) : number_format($barang_keluar->jumlah)}} </td>
                            </tr>
                            <tr>
                              <td class="" >Kembali </td>
                              <td class="fontKanan" >{{isset($barang_keluar->bayar) ? number_format($barang_keluar->bayar-$barang_keluar->jumlah) : '0'}} </td>
                            </tr>
                            @if(isset($barang_keluar->poin))
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">-----------------------------------</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:12px">Selamat anda mendapat {{$barang_keluar->poin}} poin.</td>
                            </tr>
                            @endif
                            <tr>
                              <td colspan="2"style="font-size:15px">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:12px">Terima Kasih</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:11px">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan</td>
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