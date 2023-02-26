@php
$filter = [1,2,3,4,9,10,18,24,29,31];
@endphp
@push('modal2')
<div class="modal modal-custom-1 fade" id="modal-sip{{$index}}" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg mt-4">
    <div class="modal-content">
      <form action="{{route('sip.store')}}" method="POST">
        @csrf
        <input type="hidden" name="idstr" value="{{$str->id}}">
        <div class="modal-header">
          <h4 class="modal-title">SIP {{$index+1}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <div class="modal-body">
          <div id="sip-form-accordion{{$index}}" role="tablist">
            @if(isset($sips[$index]) AND isset($sips[$index]['isactive']) )
            <div class="form-check-group mb-3" id="aksisip-wrapper-{{$index}}">
              <div class="form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="radio" name="jenispermohonan" value="perpanjangan" 
                  data-target="#form-sip-panjang-{{$index}}" > Perpanjangan
                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="jenispermohonan" value="cabut"> Cabut
                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="jenispermohonan" value="cabutpindah"
                    data-target="#form-sip-baru-{{$index}}" checked> Cabut Pindah
                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>
            @else
            <input type="hidden" name="jenispermohonan" value="baru">
            @endif
            <div id="form-sip-baru-{{$index}}">
              <div class="card-collapse">
                <div class="card-header" role="tab">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#sip-form-1-{{$index}}" aria-expanded="true" class="collapsed">
                      NOMOR
                      <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                  </h5>
                </div>
                <div id="sip-form-1-{{$index}}" class="collapse show" role="tabpanel"
                  data-parent="#sip-form-accordion{{$index}}">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="bmd-label force-top">Praktik ke- <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="number" class="form-control bg-color-unset" name="instance" value="{{$index+1}}"
                        readonly required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor SIP <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <div>
                        <input type="text" class="form-control" name="nomor" maxlength="70"
                          value="400.7.5.4 /       / {{sprintf('%04d', $nakes->nomorregis)}} / {{integerToRoman($index+1)}} / IP.DU / 436.7.2 / {{date('Y')}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor Online</label>
                      <div>
                        <input type="text" class="form-control" name="nomoronline" maxlength="60">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor Rekom</label>
                      <div>
                        <input type="text" class="form-control" name="nomorrekom" maxlength="60">
                      </div>
                    </div>
                    @if(isset($sips[$index]['idprofesi']) and in_array($sips[$index]['idprofesi'],[5,6]))
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor Rekom KPS</label>
                      <div>
                        <input type="text" class="form-control" name="nomorrekomkps" maxlength="60">
                      </div>
                    </div>
                    @endif
                    <div class="form-group">
                      <label class="bmd-label force-top">Jabatan</label>
                      <div>
                        <input type="text" class="form-control" name="jabatan" maxlength="50">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-collapse">
                <div class="card-header" role="tab">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#sip-form-2-{{$index}}" aria-expanded="false" class="">
                      FASKES
                      <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                  </h5>
                </div>
                <div id="sip-form-2-{{$index}}" class="collapse" role="tabpanel"
                  data-parent="#sip-form-accordion{{$index}}">
                  <div class="card-body">
                    @if(isset($str->idprofesi) and $str->idprofesi==7)
                    <label class="bmd-label force-top">Faskes 1<small class="text-danger align-text-top">*wajib</small></label>
                    <div class="input-group mb-3">
                      <input type="text" name="idfaskes1" required hidden>
                      <input type="text" class="form-control" name="faskes1" required readonly>
                      <div class="input-group-append">
                        <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal"
                          data-target="#searchfaskes{{$index}}1">
                          <i class="material-icons">search</i>
                        </button>
                      </div>
                    </div>
                    @for($i=2;$i<=3;$i++)
                    <label class="bmd-label force-top">Faskes {{$i}}</label>
                    <div class="input-group mb-3">
                      <input type="text" name="idfaskes{{$i}}" hidden>
                      <input type="text" class="form-control" name="faskes{{$i}}" readonly>
                      <div class="input-group-append">
                        <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal"
                          data-target="#searchfaskes{{$index}}{{$i}}">
                          <i class="material-icons">search</i>
                        </button>
                      </div>
                    </div>
                    @endfor
                    @else
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="ismandiri" name="ismandiri"
                          onchange="gantiMandiri(this, {{$index}})"> Praktik Mandiri
                        <span class="form-check-sign">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>
                    <div class="form-group" id="faskesnonmandiri{{$index}}">
                      <label class="bmd-label force-top">Faskes <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <div class="input-group mb-3">
                        <input type="text" name="idfaskes" required hidden>
                        <input type="text" class="form-control" name="faskes" required readonly>
                        <div class="input-group-append">
                          <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal"
                            data-target="#searchfaskes{{$index}}">
                            <i class="material-icons">search</i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <div id="faskesmandiri{{$index}}" hidden>
                      <div class="form-group">
                        <label class="bmd-label force-top">Alamat Faskes Mandiri <small
                            class="text-danger align-text-top">*wajib</small></label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="alamatfaskes">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="bmd-label force-top mb-0">Wilayah Puskesmas <small
                            class="text-danger align-text-top">*wajib</small></label>
                        <select name="idwilayahpkm" id="idwilayahpkm" class="selectpicker form-control mb-2" data-size="7"
                          data-style="btn btn-primary btn-round">
                          <option value="" selected disabled>Pilih Puskesmas</option>
                          @foreach($puskesmas as $key=>$unit)
                          <option value="{{$unit->id}}">{{$unit->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label class="bmd-label force-top mb-0">PT. MOU Limbah Medis<small
                                  class="text-danger align-text-top">*wajib</small></label>
                                  <select name="idptmou" id="idptmou" class="selectpicker form-control mb-2" data-size="7"
                                    data-style="btn btn-primary btn-round">
                                    <option value="" selected disabled>Pilih PT MOU</option>
                                    @foreach($ptmou as $key=>$unit)
                                    <option value="{{$unit->id}}">{{$unit->nama}}</option>
                                    @endforeach
                                  </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label force-top">Nomor MOU <small
                                  class="text-danger align-text-top">*wajib</small></label>
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" name="nomormou" value="{{isset($sips[$index]['nomormou']) ? $sips[$index]['nomormou'] : null}}">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="bmd-label force-top">Masa Berlaku MOU <small
                                  class="text-danger align-text-top">*wajib</small></label>
                              <input type="date" class="form-control" name="masamou">
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                    <!-- <div class="all-foto-faskes-wrapper">
                      <label class="bmd-label force-top">Foto Pendukung </label>
                      <div class="position-relative" id="tambah-foto-fakes{{$index}}"> -->
                        <!-- <form></form>
                        <form method="post" enctype="multipart/form-data" class="m-0">
                          <input type="file" class="fotopendukung" name="file" hidden>
                        </form> -->
                        <!-- <button type="button" class="btn btn-round btn-outline"><i
                            class="material-icons">add_circle_outline</i>
                          <div class="ripple-container"></div>
                        </button>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label class="bmd-label force-top">Jadwal Praktik </label>
                      <textarea type="text" class="form-control" name="jadwalpraktik" maxlength="150"></textarea>
                    </div>
                    <!-- <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="centered-image-wrapper">
                                <img class="" src="{{asset('public/img/product3.jpg')}}" alt="" >
                            </div>
                            <input type="text" class="form-control" name="jabatan" maxlength="30" placeholder="caption" >
                        </div>
                    </div> -->
                  </div>
                </div>
              </div>
              <div class="card-collapse">
                <div class="card-header" role="tab">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#sip-form-3-{{$index}}" aria-expanded="false" class="">
                      TANGGAL
                      <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                  </h5>
                </div>
                <div id="sip-form-3-{{$index}}" class="collapse" role="tabpanel"
                  data-parent="#sip-form-accordion{{$index}}">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Online <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="date" class="form-control" name="tglonline" required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Masuk Dinas <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="date" class="form-control" name="tglmasukdinas" required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Verif & Cetak <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="date" class="form-control" name="tglverif" required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Surat </label>
                      <input type="date" class="form-control" name="tglsurat">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="form-sip-panjang-{{$index}}">
              <div class="card-collapse">
                <div class="card-header" role="tab">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#sip-form-21-{{$index}}" aria-expanded="true" class="collapsed">
                      NOMOR
                      <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                  </h5>
                </div>
                <div id="sip-form-21-{{$index}}" class="collapse show" role="tabpanel"
                  data-parent="#sip-form-accordion{{$index}}">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="bmd-label force-top">Praktik ke- <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="number" class="form-control bg-color-unset" name="instance" value="{{$index+1}}"
                        readonly required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor SIP <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <div>
                        <input type="text" class="form-control" name="nomor" maxlength="70"
                          value="400.7.5.4 /       / {{sprintf('%04d', $nakes->nomorregis)}} / {{integerToRoman($index+1)}} / IP.DU / 436.7.2 / {{date('Y')}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor Online</label>
                      <div>
                        <input type="text" class="form-control" name="nomoronline" maxlength="60">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor Rekom</label>
                      <div>
                        <input type="text" class="form-control" name="nomorrekom" maxlength="60">
                      </div>
                    </div>
                    @if(isset($sips[$index]['idprofesi']) and in_array($sips[$index]['idprofesi'],[5,6]))
                    <div class="form-group">
                      <label class="bmd-label force-top">Nomor Rekom KPS</label>
                      <div>
                        <input type="text" class="form-control" name="nomorrekomkps" maxlength="60">
                      </div>
                    </div>
                    @endif
                    <div class="form-group">
                      <label class="bmd-label force-top">Jabatan</label>
                      <div>
                        <input type="text" class="form-control" name="jabatan" maxlength="50">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-collapse">
                <div class="card-header" role="tab">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#sip-form-22-{{$index}}" aria-expanded="false" class="">
                      FASKES
                      <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                  </h5>
                </div>
                <div id="sip-form-22-{{$index}}" class="collapse" role="tabpanel"
                  data-parent="#sip-form-accordion{{$index}}">
                  <div class="card-body">
                    @if(isset($sips[$index]['idfaskes']))
                    <div class="form-group" id="faskesnonmandiri{{$index}}">
                      <label class="bmd-label force-top">Faskes <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <div class="input-group mb-3">
                        <input type="hidden" name="idfaskes" value="{{isset($sips[$index]['idfaskes']) ? $sips[$index]['idfaskes'] : null}}" required>
                        <input type="text" class="form-control" name="faskes" value="{{isset($sips[$index]['namafaskes']) ? $sips[$index]['namafaskes'] : null}}" required readonly>
                        <div class="input-group-append">
                          <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal"
                            data-target="#searchfaskes{{$index}}">
                            <i class="material-icons">search</i>
                          </button>
                        </div>
                      </div>
                    </div>
                    @elseif(isset($sips[$index]['saranapraktik']) and $sips[$index]['saranapraktik']=='PRAKTIK MANDIRI')
                    <div id="faskesmandiri{{$index}}">
                      <input type="hidden" id="ismandiri" name="ismandiri" value="on">
                      <div class="form-group">
                        <label class="bmd-label force-top">Alamat Faskes Mandiri <small
                            class="text-danger align-text-top">*wajib</small></label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="alamatfaskes" value="{{isset($sips[$index]['alamatfaskes']) ? $sips[$index]['alamatfaskes'] : null}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="bmd-label force-top">Wilayah Puskesmas <small
                            class="text-danger align-text-top">*wajib</small></label>
                        <select name="idwilayahpkm" id="idwilayahpkm" class="selectpicker form-control mb-2" data-size="7"
                          data-style="btn btn-primary btn-round">
                          <option value="" selected disabled>Pilih Puskesmas</option>
                          @foreach($puskesmas as $key=>$unit)
                          <option value="{{$unit->id}}" @if($unit->id === isset($sips[$index]['idwilayahpkm']) ? $sips[$index]['idwilayahpkm'] : 0) selected @else @endif>{{$unit->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label class="bmd-label force-top mb-0">PT. MOU Limbah Medis<small
                                class="text-danger align-text-top">*wajib</small></label>
                                <select name="idptmou" id="idptmou" class="selectpicker form-control mb-2" data-size="7"
                                  data-style="btn btn-primary btn-round">
                                  <option value="" selected disabled>Pilih PT MOU</option>
                                  @foreach($ptmou as $key=>$unit)
                                  <option value="{{$unit->id}}" @if($unit->id === isset($sips[$index]['idptmou']) ? $sips[$index]['idptmou'] : 0) selected @else @endif>{{$unit->nama}}</option>
                                  @endforeach
                                </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="bmd-label force-top">Nomor MOU <small
                                class="text-danger align-text-top">*wajib</small></label>
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" name="nomormou" value="{{isset($sips[$index]['nomormou']) ? $sips[$index]['nomormou'] : null}}">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="bmd-label force-top">Masa Berlaku MOU <small
                                class="text-danger align-text-top">*wajib</small></label>
                            <input type="date" class="form-control" name="masamou">
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    @else
                    
                    @endif
                    <div class="form-group">
                      <label class="bmd-label force-top">Jadwal Praktik </label>
                      <textarea type="text" class="form-control" name="jadwalpraktik" maxlength="150">{{isset($sips[$index]['jadwalpraktik']) ? $sips[$index]['jadwalpraktik'] : ''}}</textarea>
                    </div>
                    <!-- <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="centered-image-wrapper">
                                <img class="" src="{{asset('public/img/product3.jpg')}}" alt="" >
                            </div>
                            <input type="text" class="form-control" name="jabatan" maxlength="30" placeholder="caption" >
                        </div>
                    </div> -->
                  </div>
                </div>
              </div>
              <div class="card-collapse">
                <div class="card-header" role="tab">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#sip-form-23-{{$index}}" aria-expanded="false" class="">
                      TANGGAL
                      <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                  </h5>
                </div>
                <div id="sip-form-23-{{$index}}" class="collapse" role="tabpanel"
                  data-parent="#sip-form-accordion{{$index}}">
                  <div class="card-body">
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Online <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="date" class="form-control" name="tglonline" required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Masuk Dinas <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="date" class="form-control" name="tglmasukdinas" required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Verif & Cetak <small
                          class="text-danger align-text-top">*wajib</small></label>
                      <input type="date" class="form-control" name="tglverif" required>
                    </div>
                    <div class="form-group">
                      <label class="bmd-label force-top">Tanggal Surat </label>
                      <input type="date" class="form-control" name="tglsurat">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-link text-primary">Simpan</button>
          <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
        </div>
      </form>
    </div>
  </div>
</div>
@if(isset($str->idprofesi) and $str->idprofesi==7)
@for($i=1;$i<=3;$i++)
<div class="modal fade text-left bg-overlay-gray" id="searchfaskes{{$index}}{{$i}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable mt-4" role="document">
        <div class="modal-content" style="overflow: visible!important;">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" >Cari Faskes
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="typeahead__container ">
                    <div class="typeahead__field">
                        <div class="form-group typeahead__query">
                            <input class="form-control js-typeahead"
                                name="q"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endfor
@else
<div class="modal fade text-left bg-overlay-gray" id="searchfaskes{{$index}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable mt-4" role="document">
        <div class="modal-content" style="overflow: visible!important;">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" >Cari Faskes
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="typeahead__container ">
                    <div class="typeahead__field">
                        <div class="form-group typeahead__query">
                            <input class="form-control js-typeahead"
                                name="q"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endpush

@if(isset($sips[$index]))

<!-- FORM DELETE SIP -->
<form action="{{route('sip.destroy', ['str'=>$sips[$index]['id']])}}" method="POST" id="form-destroy-sip-{{$index}}">
@csrf
@method('DELETE')
</form>
<!-- END OF FORM DELETE SIP -->

<form id="form-update-sip-{{$index}}">
    <input type="hidden" name="id" value="{{$sips[$index]['id']}}">
    @csrf
    @method('PUT')
    <div class="row myform">
        <div class="col">
            <table class="table table-2-col">
                <tbody>
                    @if(!$str->isactive)
                    <tr>
                        <td><label>Status</label></td>
                        <td><strong class="text-danger">SIP Lawas / inactive</strong></td>
                    </tr>
                    @endif
                    <tr>
                        <td><label>Jenis Permohonan</label></td>
                        <td>@php 
                            switch($sips[$index]['jenispermohonan']){
                                case 'baru':
                                    echo 'Permohonan Baru';
                                    break;
                                case 'cabut':
                                    echo 'Cabut';
                                    break;
                                case 'cabutpindah':
                                    echo 'Cabut Pindah';
                                    break;
                                case 'perpanjangan':
                                    echo 'Perpanjangan';
                                    break;
                            }
                            @endphp
                            @if($sips[$index]['tgldeactive']) 
                             <span style="color:red;">(Dicabut tanggal {{Carbon\Carbon::parse($sips[$index]['tgldeactive'])->isoFormat('D MMMM Y')}})</span>
                            @endif
                          </td>
                    </tr>
                    <tr>
                        <td><label>Praktik Ke-</label></td>
                        <td>{{$sips[$index]['instance']}}</td>
                    </tr>
                    <tr>
                        <td><label>{{$sips[$index]['idprofesi'] == 32 ? 'Nomor STPT' : 'Nomor SIP'}}</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomor" value="{{$sips[$index]['nomor']}}" maxlength="70" >
                            </span>                            
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nomor Online</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomoronline" value="{{$sips[$index]['nomoronline']}}" maxlength="60" >
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>{{$sips[$index]['idprofesi'] == 32 ? 'Nomor BAP' : 'Nomor Rekom'}}</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomorrekom" value="{{$sips[$index]['nomorrekom']}}" maxlength="60" >
                            </span>
                        </td>
                    </tr>
                    @if(in_array($sips[$index]['idprofesi'],[5,6]))
                    <tr>
                        <td><label>Nomor Rekom KPS</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomorrekom" value="{{$sips[$index]['nomorrekomkps']}}" maxlength="60" >
                            </span>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td><label>Tanggal Online</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true  type="date" class="form-control" name="tglonline" value="{{$sips[$index]['tglonline']}}" required>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Masuk Dinas</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true  type="date" class="form-control" name="tglmasukdinas" value="{{$sips[$index]['tglmasukdinas']}}" required>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Verif & Cetak</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true  type="date" class="form-control" name="tglverif" value="{{$sips[$index]['tglverif']}}" required>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Surat</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true  type="date" class="form-control" name="tglsurat" value="{{$sips[$index]['tglsurat']}}">
                            </span>
                        </td>
                    </tr>
                    @if(isset($sips[$index]['idprofesi']) and $sips[$index]['idprofesi']==7)
                    @php
                    $namafaskes = explode(";", $sips[$index]['namafaskes']);
                    @endphp
                    <tr hidden>
                        <td><label>FASKES HIDDEN</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" id="idfaskes{{$index}}" name="idfaskes" value="{{$sips[$index]['idfaskes']}}" required hidden>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Sarana Praktik 1</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span class="input-group">
                                <input class="form-control" data-editable=true type="text" name="namafaskes1" value="{{$namafaskes[0]}}" required readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal" data-target="#searchfaskes{{$index}}1">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>  
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Sarana Praktik 2</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span class="input-group">
                                <input class="form-control" data-editable=true type="text" name="namafaskes2" value="{{$namafaskes[1]}}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal" data-target="#searchfaskes{{$index}}2">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>  
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Sarana Praktik 3</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span class="input-group">
                                <input class="form-control" data-editable=true type="text" name="namafaskes3" value="{{$namafaskes[2]}}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal" data-target="#searchfaskes{{$index}}3">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>  
                            </span>
                        </td>
                    </tr>
                    @else
                    @if($sips[$index]['namafaskes']!='PRAKTIK MANDIRI')
                    <tr hidden>
                        <td><label>FASKES HIDDEN</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" id="idfaskes{{$index}}" name="idfaskes" value="{{$sips[$index]['idfaskes']}}" required hidden>
                            </span>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td><label>Sarana Praktik</label></td>
                        @if($sips[$index]['namafaskes']=='PRAKTIK MANDIRI')
                        <td>PRAKTIK MANDIRI</td>
                        @else
                        <td>
                            <span data-text="true"></span>
                            <span class="input-group">
                                <input class="form-control" data-editable=true type="text" name="namafaskes" value="{{$sips[$index]['namafaskes']}}" required readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-info m-0" type="button" style="padding: 0 12px;" data-toggle="modal" data-target="#searchfaskes{{$index}}">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>  
                            </span>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <td><label>Alamat Praktik</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input class="form-control" data-editable=true type="text" name="alamatfaskes" value="{{$sips[$index]['alamatfaskes']}}" {{ $sips[$index]['namafaskes']=='PRAKTIK MANDIRI' ? '' : 'readonly' }}>
                            </span>
                        </td>
                    </tr>
                    @endif
                    @if($sips[$index]['namafaskes']=='PRAKTIK MANDIRI')
                    <tr>
                        <td><label>Wilayah Puskesmas</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <select data-editable=true class="selectpicker form-control" name="idwilayahpkm"  data-style="btn btn-default btn-link input-editable" title="Pilih Puskesmas">
                                @foreach($puskesmas as $jk)
                                    <option value="{{$jk->id}}" {{$sips[$index]['idwilayahpkm']==$jk->id ? 'selected' : ''}}>{{$jk->nama}}</option>
                                @endforeach
                            </select>
                            </span>
                        </td>
                    </tr>
                      @if(in_array($nakes['idprofesi'], $filter))
                      <tr>
                          <td><label>PT. MOU Limbah Medis</label></td>
                          <td>
                              <span data-text="true"></span>
                              <span>
                                <select data-editable=true class="selectpicker form-control" name="idptmou"  data-style="btn btn-default btn-link input-editable" title="Pilih PT MOU">
                                  @foreach($ptmou as $jk)
                                      <option value="{{$jk->id}}" {{$sips[$index]['idptmou']==$jk->id ? 'selected' : ''}}>{{$jk->nama}}</option>
                                  @endforeach
                                </select>
                              </span>
                          </td>
                      </tr>
                      <tr>
                          <td><label>Nomor MOU</label></td>
                          <td>
                              <span data-text="true"></span>
                              <span>
                                  <input data-editable=true type="text" class="form-control" value="{{$sips[$index]['nomormou']}}" name="nomormou" maxlength="150" >
                              </span>
                          </td>
                      </tr>
                      <tr>
                          <td><label>Masa Berlaku MOU</label></td>
                          <td>
                              <span data-text="true"></span>
                              <span>
                                  <input data-editable=true type="date" class="form-control" value="{{$sips[$index]['masamou']}}" name="masamou">
                              </span>
                          </td>
                      </tr>
                      @endif
                    @endif
                    <tr>
                        <td><label>Jadwal Praktik</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span id="jadwal{{$index}}">{{$sips[$index]['jadwalpraktik']}}</span>
                            <span>
                                <textarea data-editable=true type="text" class="form-control" name="jadwalpraktik" maxlength="150" >{{$sips[$index]['jadwalpraktik']}}</textarea>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Jabatan</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" value="{{$sips[$index]['jabatan']}}" name="jabatan" maxlength="50" >
                            </span>
                        </td>
                    </tr>
                    @if(in_array($sips[$index]['idprofesi'],[5,6]))
                    <tr>
                        <td><label>Kompetensi</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" value="{{$sips[$index]['kompetensi']}}" name="kompetensi" maxlength="100" >
                            </span>
                        </td>
                    </tr>
                    @endif
                    @if( in_array($sips[$index]['idprofesi'], [31]) )
                    <!-- KHUSUS Tenaga Kesehata Tradisional Interkontinental -->
                    <tr>
                        <td><label>Cetak SIP</label></td>
                        @if($sips[$index]['idjenispermohonan'])
                        <td><a target="_blank" href="{{route('cetak.sip', ['idsip'=>$sips[$index]['id']])}}" class="btn btn-outline-primary btn-round btn-sm" >Cetak SIP <i class="material-icons">open_in_new</i></a></td>
                        @else
                        <td>Harap Cetak Kitir Terlebih Dahulu</td>
                        @endif
                    </tr>
                    <tr>
                        <td><label>Cetak Kitir</label></td>
                        <td><button type="button" onclick="cetakKitir({{$sips[$index]['id']}},{{$sips[$index]['idjenispermohonan']}})" class="btn btn-outline-primary btn-round btn-sm" >Cetak Kitir <i class="material-icons">open_in_new</i></button></td>
                    </tr>
                    @else
                    <tr>
                        <td><label>Cetak Perstek</label></td>
                        @if($sips[$index]['idjenispermohonan'])
                        <td><a target="_blank" href="{{route('cetak.perstek', ['idsip'=>$sips[$index]['id']])}}" class="btn btn-outline-primary btn-round btn-sm" >Cetak Perstek <i class="material-icons">open_in_new</i></a></td>
                        @else
                        <td>Harap Cetak Kitir Terlebih Dahulu</td>
                        @endif
                    </tr>
                    <tr>
                        <td><label>Cetak Kitir</label></td>
                        <td><button type="button" onclick="cetakKitir({{$sips[$index]['id']}},{{$sips[$index]['idjenispermohonan']}})" class="btn btn-outline-primary btn-round btn-sm" >Cetak Kitir <i class="material-icons">open_in_new</i></button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col" style="flex-grow:0;">
            <div class="float-right absolute myform-actions">
                <div data-state="0" class="anim slide">
                    <button type="button" class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1); hideJadwal({{$index}})">
                        <i class="material-icons">edit_note</i>
                    </button>
                    <button  type="button" class="btn btn-primary btn-round btn-fab" onclick="openHistoriSIP({{$sips[$index]['instance']}}, {{$sips[$index]['idstr']}})">
                        <i class="material-icons">pending_actions</i>
                    </button>
                </div>
                <div data-state="1" class="anim slide">
                    <button type="button" class="btn btn-danger btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(0); hideJadwal({{$index}})">
                        <i class="material-icons">close</i>
                    </button>
                    <button type="submit" class="btn btn-success btn-round btn-fab">
                        <i class="material-icons">save</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@if($str->isactive)
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya" data-toggle="modal" data-target="#modal-sip{{$index}}"><i
            class="material-icons">priority_high</i> TINDAKAN PERIZINAN</button>
</div>
@endif
@else
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sip{{$index}}"><i
            class="material-icons">add</i> TAMBAH SIP</button>
</div>
@endif

@push('script2')
<script>
function gantiMandiri(self, index){
    var $modal=$('#faskesnonmandiri'+index);
    var $modal2=$('#faskesmandiri'+index);
    @php
    $result = in_array($nakes['idprofesi'], $filter);
    @endphp
    if(self.checked == true){
        // Faskes Mandiri
        $modal.find('input[name=idfaskes]').attr('required', false).attr('value','0');
        $modal.find('input[name=faskes]').attr('required', false);
        $modal.attr('hidden', true);

        $modal2.find('input[name=alamatfaskes]').attr('required', true);
        $modal2.find('select[name=idwilayahpkm]').attr('required', true);
        
        @if($result)
        $modal2.find('select[name=idptmou]').attr('required', true);
        $modal2.find('input[name=nomormou]').attr('required', true);
        $modal2.find('input[name=masamou]').attr('required', true);
        $modal2.find('.row').attr('hidden', false);
        @else
        $modal2.find('select[name=idptmou]').attr('required', false);
        $modal2.find('input[name=nomormou]').attr('required', false);
        $modal2.find('input[name=masamou]').attr('required', false);
        $modal2.find('.row').attr('hidden', true);
        @endif
        $modal2.attr('hidden', false);
    }
    else{
        // Faskes Non Mandiri
        $modal.find('input[name=idfaskes]').attr('required', true);
        $modal.find('input[name=faskes]').attr('required', true);
        $modal.attr('hidden', false);

        $modal2.find('input[name=alamatfaskes]').attr('required', false);
        $modal2.find('select[name=idwilayahpkm]').attr('required', false);
        
        $modal2.find('select[name=idptmou]').attr('required', false);
        $modal2.find('input[name=nomormou]').attr('required', false);
        $modal2.find('input[name=masamou]').attr('required', false);
        $modal2.find('.row').attr('hidden', true);
        
        $modal2.attr('hidden', true);
    }
}

function hideJadwal(index){
    // Untuk menampilkan value di textarea
    var text = $('#jadwal'+index);
    if(text.is(':hidden')){
        text.attr('hidden', false);
    }else{
        text.attr('hidden', true);
    }

    // Supaya praktik mandiri gk perlu idfaskes
    var idfaskes = $('#idfaskes'+index);
    var idfaskescontent = '{{isset($sips[$index]["idfaskes"])}}'
    if(!idfaskescontent){
        idfaskes.attr('required', false);
    }
}

function onBeforeDeleteFotoPendukung(self){
    //cabut
    swal({
        title: 'Yakin ingin menghapus foto?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-info',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Tidak',
        buttonsStyling: false
    }).then( function(isConfirm){
        if(isConfirm.value) {
            $(self).closest('.form-group').remove()
        }
    }).catch(swal.noop)
}

$(function(){

    $('#modal-sip{{$index}} form').submit(function(e){
        e.preventDefault();
        let formDOM = this
        let jenispermohonan = $(this).find('[name=jenispermohonan]:checked').val()
        
        if(jenispermohonan == 'cabut'){
            //cabut
            swal({
                title: 'Yakin ingin mencabut SIP?',
                text: "proses tidak dapat dilakukan lagi",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Tidak',
                buttonsStyling: false
            }).then( function(isConfirm){
                if(isConfirm.value) $('#form-destroy-sip-{{$index}}').submit();
            }).catch(swal.noop)
        }else{
            formDOM.submit()
        }
    })


    // EDITABLE NOMOR SIP
    $('#modal-sip{{$index}} [name="nomor[]"][data-editable2=true], #form-update-sip-{{$index}} [name="nomor[]"][data-editable2=true]').focusin(function(e,a){
        e.target.readOnly = false;
    }).focusout(function(e){
        e.target.readOnly = true;
    })
    // END OF EDITABLE NOMOR SIP

    // SEARCH FASKES
    @if(isset($str->idprofesi) and $str->idprofesi==7)
    @for($i=1;$i<=3;$i++)
    $('#searchfaskes{{$index}}{{$i}} .js-typeahead').typeahead({
        input: ".js-typeahead",
        dynamic: true, 
        hint: true,
        order: "asc",
        display: ["nama", "alamat"],
        template: function (query, item) {return item.nama+', '+item.alamat},
        emptyTemplate: "Tidak ditemukan",
        source: {
            faskes: {
                // Ajax Request
                ajax: function (query) {
                    return {
                        type: 'GET',
                        url: '{{route("data.searchfaskes")}}',
                        data: {'query':query}
                    }
                }
            }
        },
        callback: {
            onClick: function(node, a, item, event){
                $('#searchfaskes{{$index}}{{$i}}').modal('hide')

                if( $('#modal-sip{{$index}}').hasClass('show') ){
                    // CALLBACK UNTUK SEARCH FASKES PADA FORM MODAL SIP
                    let $modalsip = $('#modal-sip{{$index}}')
                    $modalsip.find('[name=faskes{{$i}}]').val(item.nama+', '+item.alamat)
                    $modalsip.find('[name=idfaskes{{$i}}]').val(item.id)
                }else{
                    // CALLBACK UNTUK SEARCH FASKES PADA FORM UPDATE SIP
                    let $form = $('#form-update-sip-{{$index}}')
                    $form.find('[name=namafaskes]').val(item.nama)
                    $form.find('[name=alamatfaskes]').val(item.alamat)
                    // console.log($form.find('[name=idfaskes]'))
                    $form.find('[name=idfaskes]').val(item.id)
                }
            }
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });
    @endfor
    @else
    $('#searchfaskes{{$index}} .js-typeahead').typeahead({
        input: ".js-typeahead",
        dynamic: true, 
        hint: true,
        order: "asc",
        display: ["nama", "alamat"],
        template: function (query, item) {return item.nama+', '+item.alamat},
        emptyTemplate: "Tidak ditemukan",
        source: {
            faskes: {
                // Ajax Request
                ajax: function (query) {
                    return {
                        type: 'GET',
                        url: '{{route("data.searchfaskes")}}',
                        data: {'query':query}
                    }
                }
            }
        },
        callback: {
            onClick: function(node, a, item, event){
                $('#searchfaskes{{$index}}').modal('hide')

                if( $('#modal-sip{{$index}}').hasClass('show') ){
                    // CALLBACK UNTUK SEARCH FASKES PADA FORM MODAL SIP
                    let $modalsip = $('#modal-sip{{$index}}')
                    $modalsip.find('[name=faskes]').val(item.nama+', '+item.alamat)
                    $modalsip.find('[name=idfaskes]').val(item.id)
                }else{
                    // CALLBACK UNTUK SEARCH FASKES PADA FORM UPDATE SIP
                    let $form = $('#form-update-sip-{{$index}}')
                    $form.find('[name=namafaskes]').val(item.nama)
                    $form.find('[name=alamatfaskes]').val(item.alamat)
                    // console.log($form.find('[name=idfaskes]'))
                    $form.find('[name=idfaskes]').val(item.id)
                }
            }
        },
        selector:{
            result: 'typeahead__result c-typeahead',
        }
    });
    @endif
    // END OF SEARCH FASKES

    // TOGGLE RADIO BUTTON JENISPERMOHONAN
    $('#modal-sip{{$index}} [name=jenispermohonan]').change(function(e){
        // console.log(this.value, this.dataset.target);
        var baru =  $('#form-sip-baru-{{$index}}');
        var panjang =  $('#form-sip-panjang-{{$index}}');
        
        if(this.value=='perpanjangan'){
          baru.find('input,select,textarea').prop("disabled", true)
          baru.attr('hidden', true)
          panjang.find('input,select,textarea').prop("disabled", false)
          panjang.attr('hidden', false)
        }else if(this.value=='cabutpindah'){
          panjang.find('input,select,textarea').prop("disabled", true)
          panjang.attr('hidden', true)
          baru.find('input,select,textarea').prop("disabled", false)
          baru.attr('hidden', false)
        }else if(this.value=='baru'){
          panjang.find('input,select,textarea').prop("disabled", true)
          panjang.attr('hidden', true)
          baru.find('input,select,textarea').prop("disabled", false)
          baru.attr('hidden', false)
        }else{
          baru.find('input,select,textarea').prop("disabled", true)
          baru.attr('hidden', true)
          panjang.find('input,select,textarea').prop("disabled", true)
          panjang.attr('hidden', true)
        }
        // $('#modal-sip{{$index}} [name=jenispermohonan]').each(function(k,elem){
        //     let section =  $(elem.dataset.target)
        //     if(!section.length) return;
        //     if(elem.checked){
        //       console.log(section)
        //       section.find('input,select,textarea').prop("disabled", false)
        //       section.attr('hidden', false)
        //     }else{
        //       section.find('input,select,textarea').prop("disabled", true)
        //       section.attr('hidden', true)
        //     }
        // })
    })
    // END OF TOGGLE RADIO BUTTON JENISPERMOHONAN

    @if(isset($sips[$index]))
    // UPDATE SIP HANDLER
    $('#form-update-sip-{{$index}}').submit(async function(e){
        LOADING.show()
        e.preventDefault()
        let $submitBtn = $(e.target).find('button[type=submit]')
        let $form = $(e.target)
        let data = my.getFormData($form)
        try {
            let url = "{{route('sip.update', ['idsip' => $sips[$index]['id']])}}";
            let res = await my.request.post(url, data)
            $submitBtn.myFormAndToggle().initInput()
            $submitBtn.myFormAndToggle().toggle(0)
            md.showNotification('check', 3, 'Berhasil Memperbarui Data')
        } catch (err) {
            console.log(err);
            md.showNotification('close', 2, Object.values(err.responseJSON.errors)[0])
        }
        LOADING.hide()
    })
    // END OF UPDATE SIP HANDLER
    @endif

    $('#modal-sip{{$index}} [name=jenispermohonan]').change();

    @if(!isset($sips[$index]) OR !$sips[$index]['isactive'])
    $('#modal-sip{{$index}} .modal-title').text('Tambahkan SIP');
    @endif

    //onuploadfotopendukung
    const $formUploadFotopendukung = $('#tambah-foto-fakes{{$index}} form');
    const $inputFotopendukung = $formUploadFotopendukung.find('.fotopendukung');

    $inputFotopendukung.change(async function(e){
        try{
            var formData = new FormData()
            formData.append('_token', "{{ csrf_token() }}")
            formData.append('idpegawai', "{{$nakes->id}}")
            var newfile = await my.noMoreBigFile(e.target.files[0])
            formData.append('file', newfile)
            console.log(formData)
            let res = await my.request.upload("{{route('sip.uploadFotoPendukung')}}", formData)

            if(res.url){
                let htmlstr = '<div class="form-group">'+
                        '<div style="width:fit-content;" class="position-relative">' +
                            '<div class="centered-image-wrapper">' +
                                '<img class="mb-2" src="'+res.url+'" alt="" >' +
                            '</div>' +
                            '<button onclick="onBeforeDeleteFotoPendukung(this)" type="button" class="btn btn-sm btn-round btn-fab btn-danger btn-absolute-r-corner" ><i class="material-icons">close</i><div class="ripple-container"></div></button>' +
                            '<input type="hidden" name="urlfoto[]" value="'+res.url+'">' +
                            '<input type="text" class="form-control" name="captionfoto[]" maxlength="30">' +
                        '</div>' +
                    '</div>';
                    $(htmlstr).insertBefore($('#tambah-foto-fakes{{$index}}'));
            }
        }catch(e){
            console.log(e)

        }
    })

    $('#tambah-foto-fakes{{$index}} button').click(function(){
        $inputFotopendukung.click();
    });
})
</script>
@endpush