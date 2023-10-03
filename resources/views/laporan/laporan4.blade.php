<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
  <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
  <title>LAPORAN STOK</title>
  <style media="all" type="text/css">
    body {
      font-family: Verdana, Geneva, sans-serif;
      font-size: 12px;
      padding: 0px;
      margin: 0px;
    }

    .TebalBorder {
      border-bottom: solid 2px;
    }

    p {
      text-indent: 40px;
    }
  </style>
</head>

<body>
  <table class="screen panjang lebarKertasTegak">
    <tbody>
      <tr>
        <td class="jarak">
          <!-- KOP SURAT -->
          <table cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">LAPORAN STOK</td>
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

          <table class="">
            <thead class="tb-header">
              <tr>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:5%;">NO</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:35%;">NAMA BARANG</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:20%;">KODE BARANG</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:15%;">HARGA PEROLEHAN</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">STOK SISTEM</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:15%;">JUMLAH TOTAL</th>
              </tr>
            </thead>
            <tbody class="tb-body font-13">
              @php
              $total = 0;
              $totall = 0;
              @endphp
              @foreach($data as $key=>$unit)
              @php
                $total = ($unit->hargabeli * $unit->stok);
                $totall += $total;
              @endphp
              <tr>
                <td class=" fontJustify">{{$key+1}}. </td>
                <td class=" fontJustify">{{$unit->namabarang}}</td>
                <td class=" fontCenter">{{$unit->kodebarang}}</td>
                <td class=" fontCenter">{{number_format($unit->hargabeli)}}</td>
                <td class=" fontCenter">{{$unit->stok}}</td>
                <td class=" fontCenter">{{number_format($total)}}</td>
              </tr>
              @endforeach
              <tr>
                <td class=" fontJustify" colspan="5">TOTAL </td>
                <td class=" fontCenter">{{number_format($totall)}}</td>
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