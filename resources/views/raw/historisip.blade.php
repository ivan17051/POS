<ul class="timeline timeline-simple">
    @foreach($sip as $key=>$unit)
    <li class="timeline-inverted @if($key==0) active @endif">
        <div class="timeline-badge primary">
            {{$key+1}}
        </div>
        <div class="timeline-panel">
            <div class="timeline-body">
                <!-- <div class="float-right tampilkan-wrapper">
                    <a class="nav-link p-0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_horiz</i>
                    </a>
                    <div class="dropdown-menu ">
                        <a class="dropdown-item" href="#">Tampilkan</a>
                    </div>
                </div> -->
                <h5><strong>{{isset($unit->tglverif) ? Carbon\Carbon::parse($unit->tglverif)->isoFormat('D MMMM Y') : 'Tanggal Verif Belum Diisi' }}</strong></h5>
                <p>
                    <span><strong>SIP {{strtoupper($unit->jenispermohonan)}} 
                        @if(isset($unit->tgldeactive)) <span style="color:red;"> (DICABUT Tgl {{Carbon\Carbon::parse($unit->tgldeactive)->isoFormat('D MMMM Y')}}) </span> @endif
                        @if($unit->idstr != $strnow) <span style="color:red;"> (STR Lama) </span> @endif
                        </strong><br> 
                    <span><strong>No SIP:</strong> {{$unit->nomor}}</span><br>
                    <span><strong>No Rekom:</strong> {{$unit->nomorrekom}}</span><br>
                    <span><strong>No Online:</strong> {{$unit->nomoronline}}</span><br>
                    <span>{{$unit->namafaskes}}</span><br>
                    <span>{{$unit->alamatfaskes}}</span>
                </p>
            </div>
        </div>
    </li>
    @endforeach
</ul>
