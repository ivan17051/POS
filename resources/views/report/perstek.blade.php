<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>CETAK PERSTEK</title>
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
    <table class="screen panjang lebarKertasTegak">
        <tbody>
            <tr>
                <td class="jarak">
                    <!-- KOP SURAT -->
                    <table cellspacing="0" cellpadding="0" >
                        <tbody>
                            <tr>
                              <td class="fontKanan w-20" style="vertical-align: middle;padding-right: 24px;"><img src="{{asset('/public/img/logo_sby.png')}}" width="82" height="105"></td>
                              <td>
                                <table style="margin: 0;">
                                  <tbody>
                                    <tr>
                                      <td class="headerFont fontCenter " style="font-size:16px">PEMERINTAH KOTA SURABAYA</td>
                                    </tr>
                                    <tr>
                                      <td class="headerFont fontCenter " style="font-size:16px">DINAS KESEHATAN</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
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
                    <!-- NOMOR -->
                    <table>
                      <tbody>
                        <tr>
                          <td class="headerFont fontCenter  fontUnderline" style="font-size:13px">PERSETUJUAN TEKNIS</td>
                        </tr>
                        <tr>
                          <td class="headerFont fontCenter " style="font-size:13px">NOMOR : {{$sip->nomor}}</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <!-- END OF NOMOR -->
                    <!-- CONTENT -->
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">Sehubungan dengan surat permohonan perizinan {{$jenispermohonan->nama}} yang diajukan oleh :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class=" w-25" style="font-size:13px">Nama Pemohon</td>
                          <td class="" style="font-size:13px">: {{$sip->pegawai->nama}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Alamat KTP</td>
                          <td class="" style="font-size:13px">: {{$sip->pegawai->alamatktp}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Alamat Domisili</td>
                          <td class="" style="font-size:13px">: {{$sip->pegawai->alamat}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Tanggal Masuk Dinas</td>
                          <td class="" style="font-size:13px">: {{Carbon\Carbon::parse($sip->tglmasukdinas)->isoformat('D MMMM Y')}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Tanggal Permohonan</td>
                          <td class="" style="font-size:13px">: {{Carbon\Carbon::parse($sip->tglonline)->isoformat('D MMMM Y')}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Nomor Permohonan</td>
                          <td class="" style="font-size:13px">: {{$sip->nomoronline}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">Maka Berdasarkan :</td>
                        </tr>
                        @foreach($aturan as $i=>$a)
                        <tr>
                          <td class=" fontJustify paragraf" style="font-size:13px">{{$i+1}}. </td>
                          <td class=" fontJustify paragraf" style="font-size:13px">{{$a}}</td>
                        </tr>
                        @endforeach
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-89">
                      <tbody>
                        <tr>
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">dengan ini memutuskan memberikan persetujuan untuk diterbitkan {{$jenispermohonan->nama}} Kepada :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class=" fontJustify paragraf w-25" style="font-size:13px">Nama</td>
                          <td class=" fontJustify paragraf" style="font-size:13px">: {{$sip->pegawai->nama}}</td>
                        </tr>
                        <tr>
                          <td class=" fontJustify paragraf" style="font-size:13px">Nama Fasyankes</td>
                          <td class=" fontJustify paragraf" style="font-size:13px">: {{$sip->namafaskes}}</td>
                        </tr>
                        <tr>
                          <td class=" fontJustify paragraf" style="font-size:13px">Alamat Fasyankes</td>
                          <td class=" fontJustify paragraf" style="font-size:13px">: {{$sip->alamatfaskes}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">Demikian persetujuan ini dibuat untuk dapat digunakan sebagaiamana mestinya.</td>
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
                                  <td class=" fontCenter paragraf" style="font-size:13px">Surabaya, {{Carbon\Carbon::parse($sip->tglverif)->isoformat('MMMM Y')}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{strtoupper($kadinkes->jabatan)}},</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class=" fontCenter paragraf fontUnderline" style="font-size:13px">{{$kadinkes->nama}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{$kadinkes->pangkat}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">NIP {{$kadinkes->nip}}</td>
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