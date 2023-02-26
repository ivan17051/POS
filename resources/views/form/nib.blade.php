<div class="modal modal-custom-1 fade" id="modal-nib" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="form-new-non" action="{{route('nib.store')}}" method="POST" onsubmit="storeNIB(event)">
        @csrf
        <input type="hidden" name="idfaskes" value="{{$data['faskes']->id}}">
        <div class="modal-header">
            <h4 class="modal-title">NIB</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-check-group mb-3" id="aksinib-wrapper">
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="aksinib" value="perpanjangan" data-target='["#form-nib-baru"]' > Perpanjangan NIB
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="aksinib" value="nonaktif" checked data-target='["#form-nib-nonaktif"]'> Nonaktifkan
                    <span class="circle">
                        <span class="check"></span>
                    </span>
                    </label>
                </div>
            </div>
            <!-- Form NIB Baru -->
            <div id="form-nib-baru">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <label class="bmd-label-floating">No NIB <small class="text-danger align-text-top">*wajib</small></label>
                            <input type="text" class="form-control" name="nib" maxlength="20" required>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                        <label class="bmd-label-floating">No Sertif <small class="text-danger align-text-top">*wajib</small></label>
                            <input type="text" class="form-control" name="no_sertif" maxlength="80" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating">Pemohon <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="text" class="form-control" name="pemohon" maxlength="100" required>
                </div>
                <div class="form-group">
                    <label class="bmd-label force-top">Tanggal Terbit <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="date" class="form-control" name="tgl_terbit" required>
                </div>
                <div class="form-group">
                    <label class="bmd-label force-top">Tanggal Mulai <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="date" class="form-control" name="since" required>
                </div>
                <div class="form-group">
                    <label class="bmd-label force-top">Tanggal Berakhir <small class="text-danger align-text-top">*wajib</small></label>
                    <input type="date" class="form-control" name="expiry" required>
                </div>
            </div>
            <!-- End of Form Str Baru -->
            
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-link text-primary">SUBMIT</button>
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">TUTUP</button>
        </div>
        </form>
        </div>
    </div>
</div>

@if(isset($data['nib']))
<!-- FORM DELETE NIB -->
<form action="{{route('nib.destroy', ['id'=>$data['nib']->id])}}" method="POST" id="form-destroy-nib">
@csrf
@method('DELETE')
</form>
<!-- END OF FORM DELETE STR -->

<form onsubmit="updateNIB(event)">
    <input type="hidden" name="id" value="{{$data['nib']->id}}">
    @csrf
    @method('PUT')
    <div class="row myform">
        <div class="col">
            <table class="table table-2-col">
                <tbody>
                    <tr>
                        <td><label>No NIB</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nib" maxlength="20" value="{{$data['nib']->nib}}" required="true" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>No Sertif</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="no_sertif" maxlength="80" value="{{$data['nib']->no_sertif}}" required="true" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Pemohon</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="pemohon" maxlength="40" value="{{$data['nib']->pemohon}}" required="true" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Terbit</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="tgl_terbit" class="form-control" required value="{{$data['nib']->tgl_terbit}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Mulai</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="since" class="form-control" required value="{{$data['nib']->since}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Berakhir</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" name="expiry" class="form-control" required value="{{$data['nib']->expiry}}" />
                            </span>
                        </td>
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
                    <button  type="button" class="btn btn-primary btn-round btn-fab" onclick="openHistoriNIB({{$data['faskes']->id}})">
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
@if($data['nib']->isactive==1)
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya" data-toggle="modal" data-target="#modal-nib" ><i
            class="material-icons">priority_high</i> TINDAKAN PADA NIB</button>
</div>
@else
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-nib"><i
            class="material-icons">add</i> TAMBAH NIB</button>
</div>
@endif
@else
<div class="w-100 text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-nib"><i
            class="material-icons">add</i> TAMBAH NIB</button>
</div>
@endif

@push('script2')
<script>
    function openModalNIB(){
        $modal = $('modal-nib');
    }

    function storeNIB(e){
        e.preventDefault();
        let $form = $(e.target)
        let formDOM = $form[0]
        let data = my.getFormData($form)
        
        if(data['aksinib'] == 'nonaktif'){
            $('#form-destroy-nib').submit();
        }else{
            formDOM.submit()
        }
    }

    @if(isset($data['nib']))
    async function updateNIB(e){
        LOADING.show()
        e.preventDefault()
        let $submitBtn = $(e.submitter)
        let $form = $(e.target)
        let data = my.getFormData($form)
        try {
            let url = "{{route('nib.update', ['id' => $data['nib']->id])}}";
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
        // toggle radio button aksinib
        let form = $('#form-new-non');
        $('[name=aksinib]').change(function(e){
            $('[name=aksinib]').each(function(k,elem){
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
        // end of toggle radio button aksinib

        $('[name=aksinib][value=baru]').prop('checked',true).change();

        @if(!isset($data['nib']) OR !$data['nib']->isactive)
        $('#aksinib-wrapper').remove();
        $('#modal-str .modal-title').text('Tambahkan NIB');
        @endif
    })
</script>
@endpush