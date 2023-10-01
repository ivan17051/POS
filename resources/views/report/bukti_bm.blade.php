<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>BUKTI BARANG MASUK</title>
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
    
    function penyebut($nilai) {
      $nilai = abs($nilai);
      $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      $temp = "";
      if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
      } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
      } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
      } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
      } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
      } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
      } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
      } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
      } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
      } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
      }     
      return $temp;
    }
  
    function terbilang($nilai) {
      if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
      } else {
        $hasil = trim(penyebut($nilai));
      }     		
      return $hasil;
    }
    
    @endphp
    <table class="screen panjang lebarKertasTegak" style="height:498px;">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <!-- <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">BUKTI BARANG MASUK</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table> -->
                    <!-- END OF KOP SURAT -->
                    <!-- CONTENT -->
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td class="" style="font-size:12px; width:45%;">Bukti Barang Masuk No. {{$main->nomor}}</td>
                          <td class="" style="font-size:12px; width:17%;"></td>
                          <td class="" style="font-size:12px"></td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:12px">KPRI SEKDA PROV JATIM</td>
                          <td class="fontKanan" style="font-size:12px">Tanggal : </td>
                          <td class="" style="font-size:12px"> {{Carbon\Carbon::parse($main->tanggal)->isoformat('D/MM/Y')}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:12px">JL. PAHLAWAN 110 SURABAYA</td>
                          <td class="fontKanan" style="font-size:12px">Nama Supplier : </td>
                          <td class="" style="font-size:12px"> {{$main->getSupplier->nama}}</td>
                        </tr>
                        <tr>
                        <td class="" style="font-size:12px">SURABAYA</td>
                          <td class="fontKanan" style="font-size:12px">Alamat : </td>
                          <td class="" style="font-size:12px"> {{$main->getSupplier->alamat}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-89" >
                      <thead class="tb-header" style="height:25px;">
                        <tr>
                          <th class="headerFont fontCenter fontBold" style="font-size:12px; width:5%;">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:12px; width:10%;">QTY</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:12px; width:50%;">NAMA BARANG</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:12px; width:16%;">HARGA SAT</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:12px; ">TOTAL</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @php
                        $total = 0;
                        @endphp
                        @foreach($detail as $key=>$unit)
                        <tr>
                          <td class=" fontJustify">{{$key+1}}. </td>
                          <td class=" fontCenter">{{$unit->qty}}</td>
                          <td class=" fontJustify">{{$unit->getBarang->namabarang}}</td>
                          <td class=" fontKanan">{{number_format($unit->h_sat)}}</td>
                          <td class=" fontKanan">{{number_format($unit->jumlah)}}</td>
                        </tr>
                        @php
                        $total += $unit->jumlah;
                        @endphp
                        @endforeach
                        
                      </tbody>
                    </table>
                    <!-- END OF CONTENT -->
                    <table class="w-89" style="margin-top:10px;">
                      <tbody>
                        <tr>
                          <td style="width:60%;">Keterangan:</td>
                          <td class="fontKanan" style="width:20%;">Subtotal :</td>
                          <td class="fontKanan">{{number_format($total)}}</td>
                        </tr>
                        <tr>
                          <td style="width:50%;" rowspan="3">TERBILANG ##{{strtoupper(terbilang($total-$main->disc+$main->ppn))}}##</td>
                          <td class="fontKanan" style="width:20%;">Disc :</td>
                          <td class="fontKanan">{{number_format($main->disc)}}</td>
                        </tr>
                        <tr>
                          <td class="fontKanan" style="width:20%;">PPN :</td>
                          <td class="fontKanan">{{number_format($main->ppn)}}</td>
                        </tr>
                        <tr>
                          <td class="fontKanan" style="width:20%;">Total :</td>
                          <td class="fontKanan">{{number_format($total-$main->disc+$main->ppn)}}</td>
                        </tr>
                      </tbody>
                    </table>
                    
                </td>
            </tr>
            
        </tbody>
    </table>
    <script>
        // window.print();
    </script>
</body>

</html>