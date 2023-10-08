<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
  <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
  <title>LAPORAN HARGA JUAL BARANG</title>
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
                <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">LAPORAN HARGA JUAL BARANG</td>
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
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">STOK SISTEM</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">HARGA JUAL 1</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">HARGA JUAL 3</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">HARGA JUAL 6</th>
              </tr>
            </thead>
            <tbody class="tb-body font-13">
              @foreach($data as $key=>$unit)
              <tr>
                <td class=" fontJustify">{{$key+1}}. </td>
                <td class=" fontJustify">{{$unit->namabarang}}</td>
                <td class=" fontCenter">{{$unit->kodebarang}}</td>
                <td class=" fontCenter">{{$unit->qty}}</td>
                <td class=" fontCenter">{{is_numeric($unit->harga_1) ? number_format($unit->harga_1) : $unit->harga_1}}</td>
                <td class=" fontCenter">{{is_numeric($unit->harga_3) ? number_format($unit->harga_3) : $unit->harga_3}}</td>
                <td class=" fontCenter">{{is_numeric($unit->harga_6) ? number_format($unit->harga_6) : $unit->harga_6}}</td>
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