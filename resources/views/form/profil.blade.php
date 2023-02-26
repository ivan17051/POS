<form onsubmit="submitProfil(event)">
@csrf
@method('PUT')
    <input type="hidden" name="id" value="{{$nakes->id}}">
    <div class="row myform">
        
        <div class="col">
            <table class="table table-2-col td-30">
                <tbody>
                    <tr>
                        <td><label>NIK</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nik" maxlength="16" required value="{{$nakes->nik}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nama</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nama" maxlength="150" required value="{{$nakes->nama}}"/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tempat Lahir</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="tempatlahir" maxlength="20" value="{{$nakes->tempatlahir}}"/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tanggal Lahir</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="date" class="form-control datepicker2" name="tanggallahir" value="{{isset($nakes->tanggallahir) ? $nakes->tanggallahir->format('Y-m-d') : ''}}" />
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Nomor HP</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="nohp" maxlength="30" value="{{$nakes->nohp}}"/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Alamat KTP</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="alamatktp" maxlength="250" value="{{$nakes->alamatktp}}"/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Alamat Domisili</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="alamat" maxlength="250" value="{{$nakes->alamat}}"/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Jenis Kelamin</label></td>
                        <td>
                            <span data-text="true"></span>
                            <select data-editable=true class="selectpicker" name="jeniskelamin"  data-style="btn btn-default btn-link input-editable" title="Pilih Jenis Kelamin">
                                @foreach([['L','LAKI-LAKI'],['P','Perempuan']] as $jk)
                                    <option value="{{$jk[0]}}" {{$nakes->jeniskelamin==$jk[0] ? 'selected' : ''}}>{{$jk[1]}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Perguruan Tinggi</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="perguruantinggi" maxlength="100" value="{{$nakes->perguruantinggi}}"/>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tahun Lulus</label></td>
                        <td>
                            <span data-text="true"></span>
                            <span>
                                <input data-editable=true type="text" class="form-control" name="tahunlulus" maxlength="4" value="{{$nakes->tahunlulus}}"/>
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
<script>
    async function submitProfil(e){
        LOADING.show()
        e.preventDefault()
        let $submitBtn = $(e.submitter)
        let $form = $(e.target)
        let data = my.getFormData($form)
        try {
            let res = await my.request.post("{{route('nakes.update')}}", data)
            $submitBtn.myFormAndToggle().initInput()
            $submitBtn.myFormAndToggle().toggle(0)
            md.showNotification('check', 3, 'Berhasil Memperbarui Data')
        } catch (err) {
            md.showNotification('close', 2, Object.values(err.responseJSON.errors)[0])
        }
        LOADING.hide()
    }
</script>