<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
  <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
  <title>LAPORAN PENDAPATAN / PEMASUKAN</title>
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
                <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">LAPORAN PENDAPATAN / PEMASUKAN</td>
              </tr>
              @if(isset($periode))
              <tr>
                <td class="fontCenter">Periode
                  {{\Carbon\Carbon::createFromFormat('Y-m-d',$periode['tglawal'])->translatedFormat('d F Y')}} -
                  {{\Carbon\Carbon::createFromFormat('Y-m-d',$periode['tglakhir'])->translatedFormat('d F Y')}}</td>
              </tr>
              @else
              <tr>
                <td>&nbsp;</td>
              </tr>
              @endif
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
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:5%;">NO</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:22%;">TANGGAL</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:30%;">NAMA MEMBER</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; width:23%;">NOMOR</th>
                <th class="headerFont fontCenter fontBold" style="font-size:13px; ">TOTAL</th>
              </tr>
            </thead>
            <tbody class="tb-body font-13">
              @php
              $total = 0;
              @endphp
              @foreach($data as $key=>$unit)
              <tr>
                <td class=" fontJustify">{{$key+1}}. </td>
                <td class=" fontJustify">{{Carbon\Carbon::make($unit->tanggal)->translatedFormat('d F Y')}}</td>
                <td class=" fontJustify">{{$unit->getMember->nama}}</td>
                <td class=" fontCenter">{{$unit->nomor}}</td>
                <td class=" fontCenter">{{number_format($unit->jumlah)}}</td>
              </tr>
              @php
              $total += $unit->jumlah;
              @endphp
              @endforeach
              <tr>
                <td class=" fontCenter fontBold" colspan='4'>TOTAL PENDAPATAN / PEMASUKAN</td>
                <td class=" fontCenter fontBold">{{number_format($total)}}</td>
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