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
  <table class="screen panjang lebarKertasTidur">
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

          <table class="w-85">
            <thead class="tb-header">
              <tr>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:5%;" rowspan="2">NO</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:25%;" rowspan="2">NAMA BARANG</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:30%;" rowspan="2">NAMA SUPPLIER</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:40%;" colspan="4">STOK</th>
              </tr>
              <tr>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; ">MASUK</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; ">KELUAR</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; ">PENYESUAIAN</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; ">JUMLAH</th>
              </tr>
            </thead>
            <tbody class="tb-body font-13">
              @foreach($data as $key=>$unit)
              <tr>
                <td class=" fontJustify">{{$key+1}}. </td>
                <td class=" fontJustify">{{$unit->getBarang->namabarang}}</td>
                <td class=" fontCenter">{{$unit->getSupplier->nama}}</td>
                <td class=" fontCenter">{{$unit->qtyin}}</td>
                <td class=" fontCenter">{{$unit->qtyout}}</td>
                <td class=" fontCenter">{{$unit->penyesuaian}}</td>
                <td class=" fontCenter">{{$unit->stok}}</td>
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