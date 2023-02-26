<div class="modal modal-custom-1 fade" id="modal-str" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="form-new-non" action="{{route('str.store')}}" method="POST" onsubmit="storeSTR(event)">
        @csrf
        <input type="hidden" name="idpegawai" value="{{$nakes->id}}">
        <div class="modal-header">
            <h4 class="modal-title">STR</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-check-group mb-3" id="aksistr-wrapper">
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="aksistr" value="baru" data-target='["#form-str-baru","#isperpanjangsip-wrapper"]' > Perpanjangan STR
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                    </label>
                </div>
                <div id="isperpanjangsip-wrapper">
                    <div class="form-check" style="padding-left:32px;">
                        <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="isperpanjangsip" value="1" checked> Perpanjang SIP
                        <span class="form-check-sign" style="transform: scale(0.8);">
                            <span class="check"></span>
                        </span>
                        </label>
                    </div>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="aksistr" value="nonaktif" checked data-target='["#form-str-nonaktif"]'> Nonaktifkan
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                    </label>
                </div>
            </div>
            <!-- Form Str Baru -->
            <div id="form-str-baru">
                <div class="form-group">
                    <label class="bmd-label-floating">Nomor <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="text" class="form-control" name="nomor" maxlength="40" required>
                </div>
                <div class="form-group">
                    <label class="bmd-label force-top">Tanggal Terbit <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="date" class="form-control" name="since" required>
                </div>
                <div class="form-group">
                    <label class="bmd-label force-top">Tanggal Berakhir <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="date" class="form-control" name="expiry" required>
                </div>
                <!-- <div class="form-group">
                    <label class="bmd-label force-top">Tanggal Penetapan <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div> -->
            </div>
            <!-- End of Form Str Baru -->
            <!-- Form Str Nonaktif -->
            <div id="form-str-nonaktif" hidden>
                <div class="form-group">
                    <label class="bmd-label-floating">Alasan Penonaktifan</label>
                    <textarea type="text" class="form-control" id="alasan" name="alasan" maxlength="100" onkeyup="copyVal()"></textarea>
                </div>
            </div>
            <!-- End of Form Str Nonaktif -->
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-link text-primary">SUBMIT</button>
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
        </div>
        </form>
        </div>
    </div>
</div>

@if(isset($str))
<!-- FORM DELETE STR -->
<form action="{{route('str.destroy', ['str'=>$str->id])}}" method="POST" id="form-destroy-str">
@csrf
@method('DELETE')
<input type="hidden" name="alasan" value="" id="value-alasan">
</form>
<!-- END OF FORM DELETE STR -->

<form onsubmit="updateSTR(event)">
    <input type="hidden" name="id" value="{{$str->id}}">
    @csrf
    @method('PUT')
    <div class="row myform">
        <div class="col">
            <table class="table table-2-col">
                <tbody>
                    @if(!$str->isactive)
                    <tr>
                        <td><label>Status</label></td>
                        <td><strong class="text-danger">STR Lawas / inactive</strong></td>
                    </tr>
                    <tr>
                        <td><label>Alasan Penonaktifan</label></td>
                        <td><strong>{{isset($str->alasan) ? $str->alasan : ''}}</strong></td>
                    </tr>
                    @endif
                    <tr>
                        <td><label>Nomor STR</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nomor" maxlength="40" value="{{$str->nomor}}" required="true" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Terbit</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="since" class="form-control" required value="{{$str->since}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Berakhir</label></td>
                        <!-- Jika profesi ppds, ppdgs, intern -->
                        @if(in_array($str->idprofesi, [5,6,7]) and isset($str->berakhir->keterangan))
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <select data-editable=true class="selectpicker form-control" name="expiry"  data-style="btn btn-default btn-link input-editable" title="Single Select">
                                @foreach($berakhir as $jk)
                                    <option value="{{$jk->tanggal}}" {{$str->berakhir->tanggal==$jk->tanggal ? 'selected' : ''}}>{{$jk->keterangan}}</option>
                                @endforeach
                            </select>
                            </span>
                        </td>
                        @else
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="expiry" class="form-control" required value="{{$str->expiry}}" />
                            </span>
                        </td>
                        @endif
                    </tr>
                    <!-- <tr>
                        <td><label>Tanggal Penetapan</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="tanggal" class="form-control" required value="{{$str->tanggal}}" />
                            </span>
                        </td>
                    </tr> -->
                    <tr>
                        <td><label>Peruntukan</label></td>
                        <td>{{isset($nakes->profesi)? $nakes->profesi : '-'}}</td>
                    </tr>
                    <tr>
                        <td><label>Spesialis</label></td>
                        <td>{{isset($nakes->spesialisasi)? $nakes->spesialisasi : '-'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col" style="flex-grow:0;">
            <div class="float-right absolute myform-actions">
                <div data-state="0" class="anim slide">
                    <button type="button" class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1)">
                        <i class="material-icons">edit_note</i>
                    </button>
                    <button  type="button" class="btn btn-primary btn-round btn-fab" onclick="openHistoriSTR({{$str->id}})">
                        <i class="material-icons">pending_actions</i>
                    </button>
                </div>
                <div data-state="1" class="anim slide">
                    <button type="button" class="btn btn-danger btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(0)">
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
@if($str->isactive==1)
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya" data-toggle="modal" data-target="#modal-str" ><i
            class="material-icons">priority_high</i> TINDAKAN PADA STR</button>
</div>
@else
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-str"><i
            class="material-icons">add</i> TAMBAH STR</button>
</div>
@endif
@else
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-str"><i
            class="material-icons">add</i> TAMBAH STR</button>
</div>
@endif

@push('script2')
<script>
    function copyVal(){
        var alasan = document.getElementById("alasan").value
        $('#value-alasan').attr('value', alasan);
    }

    function openModalSTR(){
        $modal = $('modal-str');
    }

    function storeSTR(e){
        e.preventDefault();
        let $form = $(e.target)
        let formDOM = $form[0]
        let data = my.getFormData($form)
        
        if(data['aksistr'] == 'nonaktif'){
            //nonaktifkan
            // swal({
            //     title: 'Yakin menonaktifkan STR?',
            //     text: "proses tidak dapat dilakukan lagi",
            //     type: 'warning',
            //     showCancelButton: true,
            //     confirmButtonClass: 'btn btn-success',
            //     cancelButtonClass: 'btn btn-danger',
            //     confirmButtonText: 'Yakin',
            //     cancelButtonText: 'Tidak',
            //     buttonsStyling: false
            // }).then( function(result){
                // if(isConfirm.value)
            $('#form-destroy-str').submit();
            // }).catch(swal.noop)
        }else{
            formDOM.submit()
        }
    }

    @if(isset($str))
    async function updateSTR(e){
        LOADING.show()
        e.preventDefault()
        let $submitBtn = $(e.submitter)
        let $form = $(e.target)
        let data = my.getFormData($form)
        try {
            let url = "{{route('str.update', ['idstr' => $str->id])}}";
            let res = await my.request.post(url, data)
            $submitBtn.myFormAndToggle().initInput()
            $submitBtn.myFormAndToggle().toggle(0)
            md.showNotification('check', 3, 'Berhasil Memperbarui Data')
        } catch (err) {
            md.showNotification('close', 2, Object.values(err.responseJSON.errors)[0])
        }
        LOADING.hide()
    }
    @endif

    $(function(){
        // toggle radio button aksistr
        let form = $('#form-new-non');
        $('[name=aksistr]').change(function(e){
            $('[name=aksistr]').each(function(k,elem){
                let targets = $(elem).data('target');
                if(!targets) return
                for (const target of targets) {
                    let section =  $(target)
                    if(!section.length) return;
                    if(elem.checked){
                        section.find('input,select').prop("disabled", false)
                        section.attr('hidden', false)
                    }else{
                        section.find('input,select').prop("disabled", true)
                        section.attr('hidden', true)
                    }
                }
            })
        })
        // end of toggle radio button aksistr

        $('[name=aksistr][value=baru]').prop('checked',true).change();

        @if(!isset($str) OR !$str->isactive)
        $('#aksistr-wrapper').remove();
        $('#modal-str .modal-title').text('Tambahkan STR');
        @endif
    })
</script>
@endpush