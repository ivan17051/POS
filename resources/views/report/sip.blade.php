<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>PRAKTIK SIP</title>
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
    @endphp
    <table class="screen panjang lebarKertasTegak">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="headerFont fontCenter paddingfont fontUnderline" style="font-size:16px">SURAT IZIN PRAKTIK (SIP) DOKTER</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter paddingfont" >NOMOR : {{$sip->nomor}}</td>
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
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">&nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan Peraturan Menteri Kesehatan Republik Indonesia  Nomor  2052/Menkes/Per/X/2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran, yang bertanda tangan dibawah ini,  Kepala Dinas Kesehatan Kota Surabaya memberikan Izin Praktik pada :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont fontCenter fontBold fontUnderline" style="font-size:13px">{{$sip->pegawai->nama}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Tempat Tanggal Lahir</td>
                          <td class="paddingfont" style="font-size:13px">: {{ucfirst(strtolower($sip->pegawai->tempatlahir))}}, {{Carbon\Carbon::parse($sip->pegawai->tanggallahir)->isoformat('DD MMMM Y')}}</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Alamat KTP</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->pegawai->alamatktp}}</td>
                        </tr>
                        <tr>
                          <td rowspan="2" class="paddingfont" style="font-size:13px">Alamat Tempat Praktik {{$sip->instance}}</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->namafaskes}}</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">&nbsp;&nbsp;{{$sip->alamatfaskes}}</td>
                        </tr> 	
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Waktu Praktik</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->jadwalpraktik}}</td>
                        </tr>
                        <tr>
                          <td rowspan="2" class="paddingfont" style="font-size:13px">Nomor STR</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->nomorstr}}</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">&nbsp;&nbsp;berlaku {{Carbon\Carbon::parse($sip->tglverif)->isoformat('DD MMMM Y')}} - {{Carbon\Carbon::parse($sip->expirystr)->isoformat('DD MMMM Y')}}</td>
                        </tr> 	
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Nomor Rekomendasi OP</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->nomorrekom}}</td>
                        </tr>
                        <tr>
                          <td class="paddingfont" style="font-size:13px">Untuk Praktik sebagai</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->pegawai->profesi}}</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontCenter" colspan="2">dengan kewenangan klinis sesuai dengan kompetensinya</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontCenter" colspan="2">{{$sip->pegawai->profesi}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Dengan ketentuan sebagai berikut :</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">1. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Mentaati Peraturan Perundangan yang berlaku dan standar profesi Kedokteran.</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">2. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Surat Izin Praktik ( SIP ) ini berlaku sejak tanggal ditetapkan s/d : <strong>{{Carbon\Carbon::parse($sip->expirystr)->isoformat('DD MMMM Y')}}</strong></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">3. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Dokter dapat memberikan pelayanan gawat darurat, konsultasi, dan visite diluar waktu praktik	</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">4. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">SIP ini berlaku apabila Izin Sarana Kesehatan yang tercantum diatas masih berlaku.</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">5. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Apabila dikemudian hari ternyata terdapat kekeliruan akan diperbaiki sebagaimana mestinya.</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- END OF CONTENT -->
                    <!-- TTD -->
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td></td>
                          <td width="40%">
                            <table>
                              <tbody>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td>
                                    <table style="border-bottom:1px solid black">
                                      <tbody>
                                        <tr>
                                          <td class="paragraf" style="font-size:13px">Ditetapkan di</td>
                                          <td class="paragraf" style="font-size:13px">: Surabaya</td>
                                        </tr>
                                        <tr>
                                          <td class="paragraf" style="font-size:13px">Pada tanggal</td>
                                          <td class="paragraf" style="font-size:13px">: {{Carbon\Carbon::parse($sip->tglverif)->isoformat('DD MMMM Y')}}</td>
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
                                  <td class="fontCenter paragraf" style="font-size:13px">{{$kadinkes->nama}}</td>
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
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td colspan="2" class="paddingfont fontJustify paragraf" style="font-size:13px">Tembusan :</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paragraf" style="font-size:13px" width="1%">1. </td>
                          <td class="fontJustify paragraf" style="font-size:13px">Menteri Kesehatan</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paragraf" style="font-size:13px">2. </td>
                          <td class="fontJustify paragraf" style="font-size:13px">Ketua Konsil Kedokteran Indonesia</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paragraf" style="font-size:13px">3. </td>
                          <td class="fontJustify paragraf" style="font-size:13px">Kepala Dinas Kesehatan Provinsi Jawa Timur</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paragraf" style="font-size:13px">4. </td>
                          <td class="fontJustify paragraf" style="font-size:13px">Organisasi Profesi</td>
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