<ul class="timeline timeline-simple">
    @foreach($str as $key=>$unit)
    <li class="timeline-inverted @if($unit->id==$idstr) active @endif">
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
                        <a class="dropdown-item" href="{{route('bio').$urlparam.'&idstrlawas='.$unit->id}}">Tampilkan</a>
                    </div>
                </div>
                <h5><strong>{{Carbon\Carbon::parse($unit->since)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($unit->expiry)->isoFormat('D MMMM Y')}}</strong></h5>
                <p>
                    <span><strong>No:</strong> {{$unit->nomor}}</span><br> 
                    <span>{{$unit->profesi->nama}}</span>
                </p>
            </div>
        </div>
    </li>
    @endforeach
</ul>
