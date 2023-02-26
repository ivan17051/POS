<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{asset('/public/css/report.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('/public/css/report-screen.css')}}" rel="stylesheet" type="text/css" media="screen">
    <title>KITIR TEKNIS</title>
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
                              <td class="headerFont fontCenter  fontUnderline" style="font-size:16px">HASIL VERIFIKASI PERSYARATAN TEKNIS</td>
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
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">Sehubungan dengan permohonan yang diajukan oleh :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px; width:40%;">Nama</td>
                          <td class="" style="font-size:13px">: {{$sip->pegawai->nama}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Tempat Tanggal Lahir</td>
                          <td class="" style="font-size:13px">: {{$sip->pegawai->tempatlahir}}, {{Carbon\Carbon::parse($sip->pegawai->tanggallahir)->isoformat('D MMMM Y')}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Alamat KTP</td>
                          <td class="" style="font-size:13px">: {{$sip->pegawai->alamatktp}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Nomor Online/Tanggal Pendaftaran</td>
                          <td class="" style="font-size:13px">: {{$sip->nomoronline}} / {{Carbon\Carbon::parse($sip->tglonline)->isoformat('D MMMM Y')}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Tanggal Masuk Dinkes</td>
                          <td class="" style="font-size:13px">: {{Carbon\Carbon::parse($sip->tglmasukdinas)->isoformat('D MMMM Y')}}</td>
                        </tr>
                        <tr>
                          <td class="" style="font-size:13px">Jenis Perizinan</td>
                          <td class="" style="font-size:13px">: {{isset($jenispermohonan->nama) ? $jenispermohonan->nama : $jenispermohonan[0]->nama}}</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">Maka berdasarkan persyaratan dibawah ini :</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="w-89">
                      <thead class="tb-header">
                        <tr>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px">NO</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:55%;">PERSYARATAN</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">SESUAI</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; width:10%;">TIDAK SESUAI</th>
                          <th class="headerFont fontCenter fontBold" style="font-size:13px; ">KETERANGAN</th>
                        </tr>
                      </thead>
                      <tbody class="tb-body font-13">
                        @foreach($syarat as $key=>$unit)
                        <tr>
                          <td class=" fontJustify">{{$key+1}}. </td>
                          <td class=" fontJustify">{{$unit}}</td>
                          <td class=" fontCenter">&#10003;</td>
                          <td class=" fontCenter"></td>
                          <td class=" fontCenter">@if(strncasecmp($unit,'STR',3)==0) {{$sip->nomorstr}} @elseif(strncasecmp($unit,'Rekomendasi',11)==0) {{$sip->nomorrekom}} @endif</td>
                        </tr>
                        @endforeach
                        @php
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
                        @if($sip->spesialisasi!=null)
                        <tr>
                          <td class=" fontJustify">{{count($syarat)+1}}. </td>
                          <td class=" fontJustify">Analisis Beban Kerja</td>
                          <td class=" fontCenter">&#10003;</td>
                          <td class=" fontCenter"></td>
                          <td class=" fontCenter"></td>
                        </tr>
                        <tr>
                          <td class=" fontJustify">{{count($syarat)+2}}. </td>
                          <td class=" fontJustify">Jumlah {{$sip->spesialisasi->nama}}</td>
                          <td class=" fontCenter" colspan="2">{{$jumlah}} ({{ucwords(terbilang($jumlah))}})</td>
                          <td class=" fontCenter">@if(strncasecmp($unit,'STR',3)==0) {{$sip->nomorstr}} @elseif(strncasecmp($unit,'Rekomendasi',11)==0) {{$sip->nomorrekom}} @endif</td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                    <table class="w-89">
                      <tbody>
                        <tr>  
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">Telah dilakukan verifikasi dan diperiksa kebenarannya bahwa telah memenuhi persyaratan untuk  diberikan persetujuan teknis kepada:</td>
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
                          <td colspan="2" class=" fontJustify paragraf" style="font-size:13px">Demikian hasil verifikasi persyaratan teknis ini dibuat untuk digunakan sebagaimana mestinya.</td>
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
                        <td width="40%">
                            <table>
                              <tbody>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px"></td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{$subkoor->jabatan}},</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">Sumber Daya Manusia Kesehatan,</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class=" fontCenter fontUnderline paragraf" style="font-size:13px">{{$subkoor->nama}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{$subkoor->pangkat}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">NIP {{$subkoor->nip}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                          <td></td>
                          @php
                          dd($staf);
                          @endphp
                          <td width="40%">
                            <table>
                              <tbody>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">Surabaya, {{Carbon\Carbon::parse($sip->tglverif)->isoformat('D MMMM Y')}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{$staf->jabatan}},</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">Sumber Daya Manusia Kesehatan,</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{$staf->nama}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3">
                            <table>
                              <tbody>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{$kabid->jabatan}},</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">Sumber Daya Kesehatan,</td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                  <td class=" fontCenter fontUnderline paragraf" style="font-size:13px">{{$kabid->nama}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">{{$kabid->pangkat}}</td>
                                </tr>
                                <tr>
                                  <td class=" fontCenter paragraf" style="font-size:13px">NIP {{$kabid->nip}}</td>
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