<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>PRAKTIK SIP</title>
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
                              <td class="fontKanan w-20" style="vertical-align: middle;padding-right: 24px;"><img src="{{asset('/public/img/logo_sby.png')}}" height="90"></td>
                              <td>
                                <table style="margin: 0;">
                                  <tbody>
                                    <tr>
                                      <td class="headerFont fontCenter " style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter " style="font-size:20px">DINAS KESEHATAN</td>
                                    </tr>
                                    
                                    <tr>
                                      <td class="fontCenter " style="font-size:13px; vertical-align:bottom;">Jalan Jemursari No. 197 Surabaya 60243</td>                                    
                                    </tr>
                                    <tr>
                                      <td class="fontCenter " style="font-size:13px">Telp. (031) 8439473, 8439372, 8473729 Fax. (031) 8483393</td>
                                    </tr>
                                    <tr>
                                      <td class="fontCenter " style="font-size:13px">S U R A B A Y A</td>
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
                              <td class="headerFont fontCenter fontUnderline" style="font-size:15px">SURAT IZIN PRAKTIK TENAGA KESEHATAN TRADISIONAL INTERKONTINENTAL</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter paddingfont fontUnderline" style="font-size:15px">(SIPTKT INTERKONTINENTAL)</td>
                            </tr>
                            <tr>
                              <td class="headerFont fontCenter paddingfont" >{{$sip->nomor}}</td>
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
                          <td colspan="2" class="paragraf" style="font-size:13px">Berdasarkan</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paragraf" style="font-size:13px; width:4%;">1.</td>
                          <td colspan="2" class="fontJustify paragraf" style="font-size:13px">Peraturan Menteri Kesehatan Republik Indonesia Nomor 17 Tahun 2021 Tentang Izin dan Penyelenggaraan Praktik Tenaga Kesehatan Tradisional Interkontinental</td>
                        </tr>
                        <tr>
                          <td class="fontJustify paragraf" style="font-size:13p;">2.</td>
                          <td colspan="2" class="fontJustify paragraf" style="font-size:13px">Peraturan Walikota Surabaya Nomor 41 Tahun 2021 tentang Perizinan Berusaha, Perizinan Non Berusaha dan Pelayanan Non Perizinan;</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="fontJustify paragraf" style="font-size:13px">dengan ini memberikan Surat Izin Praktik Tenaga Kesehatan Tradisional Interkontinental (SIPTKT Interkontinental), kepada :</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="fontCenter fontBold fontUnderline" style="font-size:13px">{{$sip->pegawai->nama}}</td>
                        </tr>
                        <tr>
                          <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px;width:35%;">Tempat Tanggal Lahir</td>
                          <td class="paddingfont" style="font-size:13px">: {{ucfirst(strtolower($sip->pegawai->tempatlahir))}}, {{Carbon\Carbon::parse($sip->pegawai->tanggallahir)->isoformat('DD MMMM Y')}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat KTP</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->pegawai->alamatktp}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat Domisili</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->pegawai->alamat}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Nomor STR</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->nomorstr}}</td>
                        </tr>
                        <tr>
                          <td colspan="3" class="paddingfont" style="font-size:13px">Untuk menjalankan praktik sebagai Tenaga Kesehatan Tradisional Interkontinental di </td>
                        </tr> 	
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Nama Fasyankes {{$sip->instance}}</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->namafaskes}}</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="paddingfont" style="font-size:13px">Alamat Fasyankes {{$sip->instance}}</td>
                          <td class="paddingfont" style="font-size:13px">: {{$sip->alamatfaskes}}</td>
                        </tr> 	
                        
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td colspan="2" class="fontJustify paragraf" style="font-size:13px">Dengan ketentuan sebagai berikut :</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">1. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Mentaati Peraturan Perundangan yang berlaku, Standar Profesi dan Kode Etik Tenaga Kesehatan Tradisional Interkontinental</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">2. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Surat Izin Praktik Tenaga Kesehatan Tradisional Interkontinental (SIPTKT Interkontinental) berlaku sejak tanggal dikeluarkan sampai dengan <strong>{{Carbon\Carbon::parse($sip->expirystr)->isoformat('DD MMMM Y')}}</strong></td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">3. </td>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">Surat Izin Praktik Tenaga Kesehatan Tradisional Interkontinental (SIPTKT Interkontinental) berlaku @if($jenispermohonan->syarat>4) apabila Izin Sarana Kesehatan yang tercantum diatas masih berlaku. @else sesuai dengan alamat tempat praktik yang tercantum di atas. @endif</td>
                        </tr>
                        <tr>
                          <td class="paddingfont fontJustify paragraf" style="font-size:13px">4. </td>
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
                                    <table>
                                      <tbody>
                                        <tr>
                                          <td class="paragraf" style="font-size:13px">Surabaya, {{Carbon\Carbon::parse($sip->tglverif)->isoformat('MMMM Y')}}</td>
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