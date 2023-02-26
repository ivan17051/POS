<ul class="timeline timeline-simple">
    @foreach($nib as $key=>$unit)
    <li class="timeline-inverted @if($unit->isactive==1) active @endif">
        <div class="timeline-badge primary">
            {{$key+1}}
        </div>
        <div class="timeline-panel">
            <div class="timeline-body">
                <h5><strong>{{Carbon\Carbon::parse($unit->since)->isoFormat('D MMMM Y')}} - {{Carbon\Carbon::parse($unit->expiry)->isoFormat('D MMMM Y')}}</strong></h5>
                <p>
                    <span><strong>No NIB:</strong> {{$unit->nib}}</span><br> 
                    <span><strong>No Sertif:</strong> {{$unit->no_sertif}}</span><br>
                    <span><strong>Pemohon:</strong> {{$unit->pemohon}}</span><br> 
                </p>
            </div>
        </div>
    </li>
    @endforeach
</ul>
