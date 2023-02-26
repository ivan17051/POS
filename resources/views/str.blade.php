@extends('layouts.layout')
@extends('layouts.sidebar')

@section('title')
Data SIP
@endsection

@section('strStatus')
active
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">list_alt</i>
            </div>
            <h4 class="card-title">Data SIP</h4>
        </div>
        <div class="card-body">
            <div class="filter-tags" data-select="#selectrole" data-tags="#tagsinput" data-col="3">
                <div class="form-group d-inline-block" style="width: 250px;">
                    <div class="row">
                        <div class="col">
                        <select id="selectrole" class="selectpicker" data-style2="btn-default btn-round btn-sm text-white" data-style="select-with-transition" multiple title="Filter Status" data-size="7">
                            <optgroup label="Status">
                                <option value="1">Valid</option>
                                <option value="0">Akan Expired</option>
                                <option value="-1">Expired</option>
                                <!-- <option value="-2">Belum memiliki SIP</option> -->
                            </optgroup>
                        </select>
                        </div>
                        <!-- <div class="col pl-0">
                        <select id="selectpkm" class="selectpicker" data-style2="btn-default btn-round btn-sm text-white" data-style="select-with-transition" title="Filter Puskesmas" data-size="7">
                            <optgroup label="Puskesmas">
                                <option value="PUSKESMAS TANJUNGSARI">TANJUNGSARI</option>
                                <option value="PUSKESMAS SIMOMULYO">SIMOMULYO</option>
                                <option value="PUSKESMAS MANUKANKULON">MANUKAN KULON</option>
                                <option value="PUSKESMAS BALONGSARI">BALONGSARI</option>
                                <option value="PUSKESMAS ASEMROWO">ASEMROWO</option>
                                <option value="PUSKESMAS SEMEMI">SEMEMI</option>
                                <option value="PUSKESMAS BENOWO">BENOWO</option>
                                <option value="PUSKESMAS JERUK">JERUK</option>
                                <option value="PUSKESMAS LIDAHKULON">LIDAH KULON</option>
                                <option value="PUSKESMAS LONTAR">LONTAR</option>
                                <option value="PUSKESMAS PENELEH">PENELEH</option>
                                <option value="PUSKESMAS KETABANG">KETABANG</option>
                                <option value="PUSKESMAS KEDUNGDORO">KEDUNGDORO</option>
                                <option value="PUSKESMAS DRSOETOMO">DR. SOETOMO</option>
                                <option value="PUSKESMAS TEMBOKDUKUH">TEMBOK DUKUH</option>
                                <option value="PUSKESMAS GUNDIH">GUNDIH</option>
                                <option value="PUSKESMAS TAMBAKREJO">TAMBAKREJO</option>
                                <option value="PUSKESMAS SIMOLAWANG">SIMOLAWANG</option>
                                <option value="PUSKESMAS PERAKTIMUR">PERAK TIMUR</option>
                                <option value="PUSKESMAS PEGIRIAN">PEGIRIAN</option>
                                <option value="PUSKESMAS SIDOTOPO">SIDOTOPO</option>
                                <option value="PUSKESMAS WONOKUSUMO">WONOKUSUMO</option>
                                <option value="PUSKESMAS KREMBANGANSELATAN">KREMBANGAN SELATAN</option>
                                <option value="PUSKESMAS DUPAK">DUPAK</option>
                                <option value="PUSKESMAS KENJERAN">KENJERAN</option>
                                <option value="PUSKESMAS TAKAL">TANAH KALI KEDINDING</option>
                                <option value="PUSKESMAS SIDOTOPOWETAN">SIDOTOPO WETAN</option>
                                <option value="PUSKESMAS RANGKAH">RANGKAH</option>
                                <option value="PUSKESMAS PACARKELING">PACAR KELING</option>
                                <option value="PUSKESMAS GADING">GADING</option>
                                <option value="PUSKESMAS PUCANGSEWU">PUCANGSEWU</option>
                                <option value="PUSKESMAS MOJO">MOJO</option>
                                <option value="PUSKESMAS KALIRUNGKUT">KALIRUNGKUT</option>
                                <option value="PUSKESMAS MEDOKANAYU">MEDOKAN AYU</option>
                                <option value="PUSKESMAS TENGGILIS">TENGGILIS</option>
                                <option value="PUSKESMAS GUNUNGANYAR">GUNUNG ANYAR</option>
                                <option value="PUSKESMAS MENUR">MENUR</option>
                                <option value="PUSKESMAS KLAMPISNGASEM">KLAMPIS NGASEM</option>
                                <option value="PUSKESMAS MULYOREJO">MULYOREJO</option>
                                <option value="PUSKESMAS SAWAHAN">SAWAHAN</option>
                                <option value="PUSKESMAS PUTATJAYA">PUTAT JAYA</option>
                                <option value="PUSKESMAS BANYUURIP">BANYU URIP</option>
                                <option value="PUSKESMAS PAKIS">PAKIS</option>
                                <option value="PUSKESMAS JAGIR">JAGIR</option>
                                <option value="PUSKESMAS WONOKROMO">WONOKROMO</option>
                                <option value="PUSKESMAS NGAGELREJO">NGAGEL REJO</option>
                                <option value="PUSKESMAS KEDURUS">KEDURUS</option>
                                <option value="PUSKESMAS DUKUHKUPANG">DUKUH KUPANG</option>
                                <option value="PUSKESMAS WIYUNG">WIYUNG</option>
                                <option value="PUSKESMAS GAYUNGAN">GAYUNGAN</option>
                                <option value="PUSKESMAS JEMURSARI">JEMURSARI</option>
                                <option value="PUSKESMAS SIDOSERMO">SIDOSERMO</option>
                                <option value="PUSKESMAS KEBONSARI">KEBONSARI</option>
                                <option value="PUSKESMAS BANGKINGAN">BANGKINGAN</option>
                                <option value="PUSKESMAS MADE">MADE</option>
                                <option value="PUSKESMAS MOROKREMBANGAN">MORO KREMBANGAN </option>
                                <option value="PUSKESMAS TAMBAKWEDI">TAMBAK WEDI</option>
                                <option value="PUSKESMAS BULAKBANTENG">BULAK BANTENG</option>
                                <option value="PUSKESMAS KEPUTIH">KEPUTIH</option>
                                <option value="PUSKESMAS KALIJUDAN">KALIJUDAN</option>
                                <option value="PUSKESMAS BALASKLUMPRIK">BALAS KLUMPRIK</option>
                                <option value="PUSKESMAS SIWALANKERTO">SIWALANKERTO</option>
                                <option value="PUSKESMAS SAWAHPULO">SAWAH PULO</option>
                            </optgroup>
                        </select>
                        </div> -->
                    </div>
                    
                </div>
                <div class="h-100 d-inline-block">
                    <input id="tagsinput" hidden type="text" value="" class="form-control tagsinput" data-role="tagsinput" data-size="md" data-color="primary" data-role="filter">
                </div>
            </div>
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection

@section('script')
<script>
    var oTable;
    var now = moment();

    // Datatable
    function showTable(){

        if ($.fn.dataTable.isDataTable('#datatables') ) {
            $('#datatables').DataTable().clear();
            $('#datatables').DataTable().destroy();
            $('#datatables').empty();
        }
        
        @if(Auth::user()->role=='Bidang')
        oTable = $("#datatables").DataTable({
            // select:{
            //     className: 'dataTable-selector form-select'
            // },
            // scrollX: isMobile?true:false,
            // stateSave: true,
            // searching: false,
            processing: true,
            serverSide: true,
            ajax: {type: "POST", url: '{{route("data")}}', data:{'_token':@json(csrf_token())}},
            columnDefs: [{
                targets: '_all',
                defaultContent: ""
            }],
            columns: [
                { data:'nama', title:'Nama'},
                { data:'nomorsip', title:'Nomor SIP'},
                { data:'profesi', title:'Profesi'},
                { data:'validstatus', title:'Status', render: function(e,d,row){
                    switch (parseInt(e)) {
                        case -2:
                            return '<strong>No SIP</strong>';
                        case -1:
                            return '<strong>Expired</strong>';
                        case 0:
                            return '<strong>Akan Expired</strong>';
                        default:
                            return '<strong>Valid</strong>';
                    }
                }},
                { data:'expirystr', title:'Tanggal Exp.',  render: function(e,d,row){
                    if(!e) return '';
                    return moment(e).format('L');} 
                },
                { data:'faskes', title:'Faskes'},
            ],
            createdRow: function (row, data, dataIndex) {
                switch (parseInt(data['validstatus'])) {
                    case -2:
                        $(row).addClass('is-no-data');        
                    case -1:
                        $(row).addClass('is-expired');    
                        break;
                    case 0:
                        $(row).addClass('is-expired-soon');    
                        break;
                }
            },
        });
        @else
        oTable = $("#datatables").DataTable({
            // select:{
            //     className: 'dataTable-selector form-select'
            // },
            // scrollX: isMobile?true:false,
            // stateSave: true,
            // searching: false,
            processing: true,
            serverSide: true,
            ajax: {type: "POST", url: '{{route("data")}}', data:{'_token':@json(csrf_token())}},
            columnDefs: [{
                targets: '_all',
                defaultContent: ""
            }],
            columns: [
                { data:'nama', title:'Nama'},
                { data:'nomorsip', title:'Nomor SIP'},
                { data:'profesi', title:'Profesi'},
                { data:'validstatus', title:'Status', render: function(e,d,row){
                    switch (parseInt(e)) {
                        case -2:
                            return '<strong>No SIP</strong>';
                        case -1:
                            return '<strong>Expired</strong>';
                        case 0:
                            return '<strong>Akan Expired</strong>';
                        default:
                            return '<strong>Valid</strong>';
                    }
                }},
                { data:'expirystr', title:'Tanggal Exp.',  render: function(e,d,row){
                    if(!e) return '';
                    return moment(e).format('L');} 
                },
                { data:'id', title:'Aksi', class:"text-right", render: function(e,d,row){
                    return '<a href="{{route("bio")}}?nakes='+e+'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i> Cek</a>'
                }},
            ],
            createdRow: function (row, data, dataIndex) {
                switch (parseInt(data['validstatus'])) {
                    case -2:
                        $(row).addClass('is-no-data');        
                    case -1:
                        $(row).addClass('is-expired');    
                        break;
                    case 0:
                        $(row).addClass('is-expired-soon');    
                        break;
                }
            },
        });
        @endif
    }

    $(document).ready(function(){
        showTable(); 

        //event pada tags filter
        $(".filter-tags").each(function(){
            var sel= $($(this).data('select'));
            var put=$($(this).data('tags'));
            var col=parseInt($(this).data('col'));
            put.tagsinput('input').attr('hidden',true);
            
            // filter selectpicker on change
            sel.change(function(){
                put.tagsinput('removeAll');

                for (const opt of sel[0].selectedOptions) {
                    put.tagsinput('add', opt.textContent);
                }

                //search nya pakai regex misal "Pusat|Spesial" artinya boleh Pusat atau Spesial
                if(!sel.val().length){
                    oTable.column(col).search( '' ).draw();
                }
                else{
                    var searchStr='^('+sel.val().join('|')+')$';
                    oTable.column(col).search( searchStr , true, false).draw();
                    
                    // switch (label) {
                    //     case "Status":
                    //         var searchStr='^('+sel.val().join('|')+')$';
                    //         oTable.column(col).search( searchStr , true, false).draw();
                    //         break;
                    //     case "Puskesmas":
                    //         var searchStr='^('+sel.val().join('|')+')$';
                    //         oTable.column('faskes:name').search( searchStr , true, false).draw();
                    //         break;
                    // }
                }
            });

            // filter tags input on removed
            put.on('itemRemoved', function(event) {
                let text = event.item;
                let items = []
                for (const opt of sel[0].selectedOptions) {
                    if(opt.textContent != text){
                        items.push(opt.value)
                    }
                }
                sel.selectpicker('val', items);
            });
        });

        $(".filter-tags").each(function(){
            var sel= $($(this).data('select'));
            var put=$($(this).data('tags'));
            var col=parseInt($(this).data('col'));
            put.tagsinput('input').attr('hidden',true);
            
            // filter selectpicker on change
            sel.change(function(){
                put.tagsinput('removeAll');

                for (const opt of sel[0].selectedOptions) {
                    put.tagsinput('add', opt.textContent);
                }

                //search nya pakai regex misal "Pusat|Spesial" artinya boleh Pusat atau Spesial
                if(!sel.val().length){
                    oTable.column(col).search( '' ).draw();
                }
                else{
                    var searchStr='^('+sel.val().join('|')+')$';
                    oTable.column(col).search( searchStr , true, false).draw();
                }
            });

            
        });
    });
</script>
@endsection