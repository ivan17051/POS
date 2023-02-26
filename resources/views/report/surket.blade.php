<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>SURAT KETERANGAN</title>
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
    <table class="screen panjang lebarKertasTegak">
        <tbody>
            <tr>
                <td class="jarak">
                  <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="fontKanan w-20" style="vertical-align: middle;padding-right: 30px;" rowspan="3"><img src="{{asset('/public/img/logo_sby.png')}}" height="100"></td>
                              <td>.</td>
                            </tr>
                            <tr>
                              <td>
                                <table style="margin: 0;">
                                  <tbody>
                                    <tr>
                                      <td class="headerFont fontCenter " style="font-size:18px">PEMERINTAH KOTA SURABAYA</td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter " style="font-size:25px">DINAS KESEHATAN</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter " style="font-size:15px; vertical-align:bottom;">Jalan Jemursari No. 197 Surabaya Telp. (031) 8439473, 8439372</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
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
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter fontUnderline" style="font-size:15px">PERSETUJUAN TEKNIS</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter paddingfont fontUnderline" style="font-size:15px">SURAT KETERANGAN</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter paddingfont" >Nomor: {{$surket->nosurat}}</td>
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
                    <table class="w-90">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px;width:28%;">Nama Pemohon</td>
                          <td class="paddingfont" style="font-size:13px">: {{$nakes->nama}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat KTP</td>
                          <td class="paddingfont" style="font-size:13px">: {{$nakes->alamatktp}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat Domisili</td>
                          <td class="paddingfont" style="font-size:13px">: {{$nakes->alamat}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Tanggal Permohonan</td>
                          <td class="paddingfont" style="font-size:13px">: {{isset($surket->tglonline)? Carbon\Carbon::parse($surket->tglonline)->isoformat('D MMMM Y') : ''}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Nomor Online</td>
                          <td class="paddingfont" style="font-size:13px">: {{isset($surket->noonline)? $surket->noonline : ''}}</td>
                        </tr>
                        
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                          <td colspan="2" class="paddingfont paragraf" style="font-size:13px">Maka berdasarkan :</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paddingfont paragraf" style="font-size:13px; width:4%;">1.</td>
                          <td colspan="2" class="fontJustify paragraf" style="font-size:13px">Peraturan Menteri Kesehatan Republik Indonesia Nomor 2052 / MENKES / PER / X / 2011 tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paddingfont paragraf" style="font-size:13p;">2.</td>
                          <td colspan="2" class="fontJustify paragraf" style="font-size:13px">Peraturan Walikota Surabaya Nomor 41 Tahun 2021 tentang Perizinan Berusaha, Perizinan Non Berusaha dan Pelayanan Non Perizinan;</td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                          <td colspan="3" class="fontJustify paddingfont paragraf" style="font-size:13px">Dengan ini memutuskan memberikan persetujuan untuk diterbitkan Izin Surat Keterangan Izin Praktik Dokter Umum /Gigi /Spesialis /Spesialis Gigi /PPDS /PPDGS, kepada :</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px;width:28%;">Nama Pemohon</td>
                          <td class="paddingfont" style="font-size:13px">: {{$nakes->nama}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat KTP</td>
                          <td class="paddingfont" style="font-size:13px">: {{$nakes->alamatktp}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat Domisili</td>
                          <td class="paddingfont" style="font-size:13px">: {{$nakes->alamat}}</td>
                        </tr>
                        
                        @php
                        if(count($sip)>0){
                          $jumlah = count($sip);
                          if($jumlah == 1) $terbilang = 'satu';
                          elseif($jumlah == 2) $terbilang = 'dua';
                          elseif($jumlah == 3) $terbilang = 'tiga';
                        }
                        @endphp

                        @if(count($sip)>0)
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                          <td colspan="3" class="paddingfont" style="font-size:13px">Telah memiliki Surat Izin Praktik (SIP) di {{$jumlah}} ({{$terbilang}}) Fasyankes di Kota Surabaya, fasyankes tersebut adalah</td>
                        </tr>
                        @else
                        <tr>
                          <td colspan="3" class="paddingfont" style="font-size:13px">Bahwa tidak memiliki SIP di wilayah Kota Surabaya</td>
                        </tr>
                        @endif

                        @foreach($sip as $key=>$unit)
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Nomor SIP {{$key+1}}</td>
                          <td class="paddingfont" style="font-size:13px">: {{$unit->nomor}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Nama Fasyankes {{$key+1}}</td>
                          <td class="paddingfont" style="font-size:13px">: {{$unit->namafaskes}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat Fasyankes {{$key+1}}</td>
                          <td class="paddingfont" style="font-size:13px">: {{$unit->alamatfaskes}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        @endforeach
                        
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Kota/Kab. Tujuan</td>
                          <td class="paddingfont" style="font-size:13px">: {{$surket->kotatujuan}}</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="paddingfont" style="font-size:13px">Demikian persetujuan ini dibuat untuk dapat digunakan sebagaimana mestinya</td>
                        </tr>
                      </tbody>
                    </table>
                    
                    <!-- END OF CONTENT -->
                    <!-- TTD -->
                    <table class="w-90" style="width:100%;">
                      <tbody>
                        <tr>
                          <td></td>
                          <td width="40%">
                            <table>
                              <tbody>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td>
                                    <table>
                                      <tbody>
                                        <tr>
                                          <td class="paragraf" style="font-size:13px">Surabaya, {{Carbon\Carbon::parse($surket->tglsurat)->isoformat('D MMMM Y')}}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="paddingfont fontCenter paragraf" style="font-size:13px">KEPALA DINAS,</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class="fontCenter paragraf fontUnderline" style="font-size:13px">{{$kadinkes->nama}}</td>
                                </tr>
                                <tr>
                                  <td class="fontCenter paragraf" style="font-size:13px">{{$kadinkes->pangkat}}</td>
                                </tr>
                                <tr>
                                  <td class="fontCenter paragraf" style="font-size:13px">NIP {{$kadinkes->nip}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- END OF TTD -->
                    
                </td>
            </tr>
            
        </tbody>
    </table>
    <script>
        // window.print();
    </script>
</body>

</html>