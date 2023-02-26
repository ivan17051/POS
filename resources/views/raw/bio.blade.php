<div class="row">
    <div class="col-md-4">
        <ul class="nav nav-pills nav-pills-primary flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#link-profil" role="tablist">
                    Profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#link-profesi" role="tablist">
                    Profesi
                </a>
            </li>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="tab-content">
            <div class="tab-pane active" id="link-profil">
                @include('form.profil')
            </div>
            <div class="tab-pane" id="link-profesi">
                @include('form.profesi')
            </div>
        </div>
    </div>
</div>
