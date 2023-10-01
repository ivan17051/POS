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
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">--------------------------------------</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="" style="font-size:12px">{{Carbon\Carbon::parse($barang_keluar->tanggal)->isoformat('DD-MM-Y')}}</td>
                            </tr>
                            <tr>
                              <td colspan="2">No. {{$barang_keluar->nomor}}</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">--------------------------------------</td>
                            </tr>
                            @foreach($detail as $unit)
                            <tr>
                              <td colspan="2" class="" style="font-size:12px">{{$unit->getBarang->namabarang}} [{{$unit->getBarang->kodebarang}}]</td>
                            </tr>
                            <tr>
                              <td class="" >{{$unit->qty}} x {{number_format($unit->h_sat)}} </td>
                              <td class="fontKanan" >{{number_format($unit->jumlah)}} </td>
                            </tr>
                            @endforeach
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">--------------------------------------</td>
                            </tr>
                            <tr>
                              <td class="" >Total </td>
                              <td class="fontKanan" >{{number_format($barang_keluar->jumlah)}} </td>
                            </tr>
                            <tr>
                              <td class="" >Potongan </td>
                              <td class="fontKanan" >{{number_format($barang_keluar->diskon)}} </td>
                            </tr>
                            <tr>
                              <td class="" >Bayar </td>
                              <td class="fontKanan" >{{isset($barang_keluar->bayar) ? number_format($barang_keluar->bayar) : number_format($barang_keluar->jumlah)}} </td>
                            </tr>
                            <tr>
                              <td class="" >Kembali </td>
                              <td class="fontKanan" >{{isset($barang_keluar->bayar) ? number_format($barang_keluar->diskon + $barang_keluar->bayar - $barang_keluar->jumlah) : '0'}} </td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px"'>--------------------------------------</td>
                            </tr>
                            <tr>
                              <td class="" style="font-size:12px" colspan="2">Jenis Pembayaran :</td>
                            </tr>
                            <tr>
                              <td class="" style="font-size:12px" colspan="2">{{ucwords($barang_keluar->metode)}} {{isset($barang_keluar->keterangan) ? '('.$barang_keluar->keterangan.')' : ''}}</td>
                            </tr>
                            
                            @if(isset($barang_keluar->getMember))
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:15px">--------------------------------------</td>
                            </tr>
                            @if(isset($barang_keluar->poin))
                            <tr>
                              <td colspan="2" class="fontCenter" style="font-size:12px">Selamat anda mendapat {{$barang_keluar->poin}} poin.</td>
                            </tr>
                            <tr><td>&nbsp;</td></tr>
                            @endif
                            <tr>
                              <td style="font-size:12px" colspan="2">Detail Member :</td>
                            </tr>
                            <tr>
                              <td style="font-size:12px;" colspan="2">&#9900; {{$barang_keluar->getMember->nama}}</td>
                            </tr>
                            <tr>
                              <td style="font-size:12px" colspan="2">&#9900; {{$barang_keluar->getMember->notelp}}</td>
                            </tr>
                            <tr>
                              <td style="font-size:12px" colspan="2">&#8473; <b>{{$barang_keluar->getMember->poin}} Poin</b></td>
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