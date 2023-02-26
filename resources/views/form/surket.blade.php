<div class="modal modal-custom-1 fade" id="modal-surket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="form-new-non" action="{{route('surket.store')}}" method="POST" onsubmit="storeSurket(event)">
        @csrf
        <input type="hidden" name="idpegawai" value="{{$nakes->id}}">
        <div class="modal-header">
            <h4 class="modal-title">Surat Keterangan Baru</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form Surket Baru -->
            <div id="form-surket-baru">
                <input type="hidden" name="idpegawai" value="{{$nakes->id}}">
                <input type="hidden" name="idstr" value="{{$str->id}}">
                <input type="hidden" name="idsip" id="idsip">
                <div class="form-group mb-2" id="containerSip">
                <label class="bmd-label-floating mb-0">SIP</label>
                @foreach($sips as $unit)
                    @if(isset($unit))
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input sips" type="checkbox" value="{{$unit->id}}"> {{$unit->nomor}}
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
                    @endif
                @endforeach
                </div>
                <div class="form-group">
                <label class="bmd-label-floating">No Surat <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="text" class="form-control" name="nosurat" maxlength="50" required>
                </div>
                <div class="form-group">
                <label class="bmd-label-floating">No Online <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="text" class="form-control" name="noonline" maxlength="20" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label force-top">Tanggal Online <small class="text-danger align-text-top">*wajib</small></label>
                            <input type="date" class="form-control" name="tglonline" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label force-top">Tanggal Verif <small class="text-danger align-text-top">*wajib</small></label>
                            <input type="date" class="form-control" name="tglverif" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="bmd-label force-top">Tanggal Surat</label>
                    <input type="date" class="form-control" name="tglsurat">
                </div>
                <div class="form-group">
                <label class="bmd-label-floating">Kota/Kab. Tujuan <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="text" class="form-control" name="kotatujuan" maxlength="100" required>
                </div>
            </div>
            <!-- End of Form Surket Baru -->
            
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-link text-primary" onclick="copyData('baru')">SUBMIT</button>
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
        </div>
        </form>
        </div>
    </div>
</div>

@if(isset($surket))
<form onsubmit="updateSurket(event)">
    <input type="hidden" name="id" value="{{$surket->id}}">
    @csrf
    @method('PUT')
    <div class="row myform">
        <div class="col">
            <table class="table table-2-col">
                <tbody>
                    <tr>
                        <td><label>SIP</label></td>
                        <td id="editSip">
                            @foreach($sips as $unit)
                                @if(isset($unit))
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input sips" name="sips" type="checkbox" value="{{$unit->id}}" @if(in_array($unit->id,$idsip)) checked @endif disabled> {{$unit->nomor}}
                                    <span class="circle">
                                    <span class="check"></span>
                                    </span>
                                </label>
                                </div>
                                @endif
                            @endforeach
                            <input type="hidden" name="idsip">
                        </td>
                    </tr>
                    <tr>
                        <td><label>No Surat</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nosurat" maxlength="40" value="{{$surket->nosurat}}" required="true" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>No Permohonan</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="noonline" maxlength="20" value="{{$surket->noonline}}" required="true" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Online</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="tglonline" class="form-control" required value="{{$surket->tglonline}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Verif</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="tglverif" class="form-control" required value="{{$surket->tglverif}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Surat</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="tglsurat" class="form-control" value="{{$surket->tglsurat}}" />
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><label>Kota/Kab. Tujuan</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="kotatujuan" maxlength="20" value="{{$surket->kotatujuan}}" required="true" />
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col" style="flex-grow:0;">
            <div class="float-right absolute myform-actions">
                <div data-state="0" class="anim slide">
                    <button type="button" class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1);changeAttr(false)">
                        <i class="material-icons">edit_note</i>
                    </button>
                    <button  type="button" class="btn btn-primary btn-round btn-fab" onclick="openHistoriSurket({{$nakes->id}})">
                        <i class="material-icons">pending_actions</i>
                    </button>
                    @if($surket->tglsurat)
                    <a class="btn btn-info btn-round btn-fab" href="{{route('cetak.surket',['idsurket'=>$surket->id])}}" target="_blank" data-toggle="tooltip" title="Cetak Surket">
                        <i class="material-icons">print</i>
                    </a>
                    
                    <button type="button" class="btn btn-warning btn-round btn-fab" onclick="cetakKitirSurket('{{route('cetak.kitir', ['idsip'=>$surket->id, 'jenis'=>'surket']) }}')">
                        <i class="material-icons">print</i>
                    </button>
                    <a class="btn btn-warning btn-round btn-fab" href="{{route('cetak.kitir',['idsip'=>$surket->id, 'jenis'=>'surket'])}}" target="_blank" data-toggle="tooltip" title="Cetak Kitir">
                        <i class="material-icons">print</i>
                    </a>
                    @endif
                </div>
                <div data-state="1" class="anim slide">
                    <button type="button" class="btn btn-danger btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(0);changeAttr(true)">
                        <i class="material-icons">close</i>
                    </button>
                    <button type="submit" class="btn btn-success btn-round btn-fab" onclick="copyData();changeAttr(true)">
                        <i class="material-icons">save</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-surket"><i
            class="material-icons">add</i> Buat Surket Baru</button>
</div>

@else
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-surket"><i
            class="material-icons">add</i> Buat Surket Baru</button>
</div>
@endif

@push('script2')
<script>
    function copyData(con){
        var checkedValue = ''; 
        var inputElements = document.getElementsByClassName('sips');
        for(var i=0; i<inputElements.length; i++){
            if(inputElements[i].checked){
                if(checkedValue=='') checkedValue = inputElements[i].value;
                else checkedValue = checkedValue+','+inputElements[i].value;
            }
        }
        if(con == 'baru') {
            $('#idsip').val(checkedValue).change();
        }
        else{
            var field = $('#editSip').find('input[name=idsip]');
            field.val(checkedValue).change();
        } 
    }

    function changeAttr(c){
        let $sips = $('#editSip').find('input[name=sips]');
        $sips.prop('disabled',c);
    }
    
    function storeSurket(e){
        e.preventDefault();
        let $form = $(e.target)
        let formDOM = $form[0]
        let data = my.getFormData($form)
        
        formDOM.submit()
    }

    @if(isset($surket))
    async function updateSurket(e){
        LOADING.show()
        e.preventDefault()
        let $submitBtn = $(e.submitter)
        let $form = $(e.target)
        let data = my.getFormData($form)
        try {
            let url = "{{route('surket.update', ['surket' => ''])}}/"+{{$surket->id}};
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
        $('#editSip').find('input[name=sips]').prop('disabled',true);
    })
</script>
@endpush