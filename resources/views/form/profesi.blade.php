<div class="row">
    <div class="col">
        <table class="table table-2-col td-30">
            <tbody>
                @if(isset($str))
                <tr>
                    <td><label>Nomor STR</label></td>
                    <td>{{$str->nomor}}</td>
                </tr>
                <tr>
                    <td><label>Tanggal Terbit</label></td>
                    <td>{{$str->since}}</td>
                </tr>
                <tr>
                    <td><label>Tanggal Expired</label></td>
                    <td><strong class="text-danger">{{$str->expiry}}</strong></td>
                </tr>
                @else
                <tr>
                    <td><label>Nomor STR</label></td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><label>Tanggal Terbit</label></td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><label>Tanggal Expired</label></td>
                    <td><strong class="text-danger">-</strong></td>
                </tr>
                @endif
                <tr>
                    <td><label>Peruntukan</label></td>
                    <td>{{isset($nakes->profesi)? $nakes->profesi : '-'}}</td>
                </tr>
                <tr>
                    <td><label>Spesialisasi</label></td>
                    <td>{{isset($nakes->spesialisasi)? $nakes->spesialisasi : '-'}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>