<ul class="timeline timeline-simple">
    @foreach($surket as $key=>$unit)
    <li class="timeline-inverted @if($key==0) active @endif">
        <div class="timeline-badge primary">
            {{$key+1}}
        </div>
        <div class="timeline-panel">
            <div class="timeline-body">
                <div class="float-right tampilkan-wrapper">
                    <a class="nav-link p-0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_horiz</i>
                    </a>
                    <div class="dropdown-menu ">
                        <a class="dropdown-item" href="{{route('cetak.surket',['id'=>$unit->id])}}">Cetak</a>
                    </div>
                </div>
                <h5><strong>{{$unit->nosurat}}</strong></h5>
                <p>
                  <span><strong>Tgl Surat:</strong> {{isset($unit->tglsurat) ? Carbon\Carbon::parse($unit->tglsurat)->isoFormat('D MMMM Y') : 'Tanggal Surat Belum Diisi' }}</span><br>
                  <span><strong>No Permohonan:</strong> {{$unit->noonline}}</span><br>
                  <span><strong>Tgl Permohonan:</strong> {{isset($unit->tglonline) ? Carbon\Carbon::parse($unit->tglonline)->isoFormat('D MMMM Y') : '' }}</span><br>
                  <span><strong>Kota/Kab. Tujuan:</strong> {{$unit->kotatujuan}}</span><br>
                </p>
            </div>
        </div>
    </li>
    @endforeach
</ul>
