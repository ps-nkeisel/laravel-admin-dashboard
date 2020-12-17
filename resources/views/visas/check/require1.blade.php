@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Check required visa</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Conditions</li>
                        <li class="breadcrumb-item active" aria-current="page">Visa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    <!-- filter -->
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Filter</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-12">
                        Prüfen, ob sich bestimmte Nationalitäten in bestimmten Datensätzen wiederfinden oder nicht. Eingegrenzt wird nach Zielgebiet, Nationalität (mehrere Nationalitäten) und "Requirre-Status".
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data" id="form_nats_search">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label" style="margin-top:15px;" for="countrytocode">Destination</label>
                                <input class="form-control form-control-alt"
                                    name="countrytocode" type="text" id="countrytocode"
                                    value="" min="0" max="2"
                                    placeholder="Enter country code here...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" style="margin-top:15px;" for="countrytocodelist">
                                    <h4 class="font-w400">Nationalities</h4>
                                </label>
                                <input class="form-control form-control-alt mb-3"
                                    name="countrytocodelist" type="text" id="countrytocodelist"
                                    placeholder="Enter list of country codes separated by comma here, if available">
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="nationality_ids"
                                            name="nationality_ids[]"
                                            data-placeholder="Choose many.." multiple>
                                        <option></option>
                                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}" data-code="{{ $nationality->code }}">
                                                {{ $nationality->name_en.($nationality->code?' ('.$nationality->code.')':'') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="font-w400">Required</h4>

                            <div class="form-group" style="padding-top:5px;">
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="require1-yes"
                                            name="require1" value="1" checked>
                                    <label class="custom-control-label" for="require1-yes">Visa is required</label>
                                </div>
                            </div>
                            <div class="form-group" style="padding-top:5px;">
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="require1-no"
                                            name="require1" value="0">
                                    <label class="custom-control-label" for="require1-no">Visa is not required</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="require1-freefordays"
                                        name="require1" value="2">
                                    <label class="custom-control-label" for="require1-freefordays">Visa free for</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success my-4">use filter</button>
                    <button type="reset" class="btn btn-secondary">reset filter</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end filter -->

    <!-- Start List Pagination -->
    <div class="content content-full">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded block-bordered dynamic_container">
            <div class="block-header block-header-default">
                <h3 class="block-title">Liste</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id="nationalities_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Required</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- End List Pagination -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.print.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>

    <!-- Page JS Code -->
    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->
    <script>jQuery(function () {
            Dashmix.helpers(['select2']);
        });</script>

    <script>
        $(document).ready(function() {
        // Textarea enter key event
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    if (event.target.tagName == 'TEXTAREA') {
                        return;
                    }
                    event.preventDefault();
                    return false;
                }
            });

        // Nationalities multi select
            var arrNats_IdCode = [], arrNats_CodeId = [];
            $('#nationality_ids > option').each((index, nat) => {
                var id = $(nat).val();
                var code = $(nat).data('code');
                arrNats_IdCode[id] = code;
                arrNats_CodeId[code] = id;
            })
            $('#countrytocodelist').change(function() {
                var codestr = $(this).val();
                codestr = codestr.toUpperCase().replace(/\s/g, '');
                $(this).val(codestr);
                var arrCodes = codestr.split(',');
                var arrIds = [];
                arrCodes.forEach(function(code) {
                    var id = arrNats_CodeId[code];
                    if (id != undefined) {
                        arrIds.push(id);
                    }
                });
                $('#nationality_ids').val(arrIds);
                $('#nationality_ids').trigger('change');
            });
            $('#nationality_ids').change(function() {
                var arrIds = $(this).val();
                var arrCodes = [];
                arrIds.forEach(function(id) {
                    var code = arrNats_IdCode[id];
                    arrCodes.push(code);
                });
                var codestr = arrCodes.join(',');
                $('#countrytocodelist').val(codestr);
            }).trigger('change');

            var nationalities_datatable = $('#nationalities_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                ajax: {
                    url: "{{ route('api.visas.check.require1') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').removeClass('block-mode-loading');
                        d.filters = {
                            countrytocode: '',
                            nationality_ids: [],
                            require1: -1,
                        };
                        var formData = $('#form_nats_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'countrytocode') {
                                d.filters.countrytocode = element.value;
                            } else if (element.name == 'nationality_ids[]') {
                                d.filters.nationality_ids.push(element.value);
                            } else if (element.name == 'require1') {
                                d.filters.require1 = element.value;
                            }
                        })
                    },
                },
                drawCallback: function( settings ) {
                    $('.dynamic_container').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'code', className: "text-center" },
                    { data: 'require1', className: "text-center" },
                ],
                createdRow: function( row, data, dataIndex) {
                    if (data.require1 == 'no') {
                        $(row).css('background-color', 'red');
                        $(row).css('color', 'white');
                    }
                },
            });

            nationalities_datatable.on('xhr.dt', function ( e, settings, json, xhr ) {
                if (json.status === 'error') {
                    alert('There is no matching data');
                }
            } )

            $('#form_nats_search').submit(function(event) {
                event.preventDefault();

                if ($('#countrytocode').val() === '') {
                    alert('Destination field is required');
                    return;
                }
                if ($('#countrytocodelist').val() === '') {
                    alert('Input at least one nationality');
                    return;
                }
                nationalities_datatable.ajax.reload();
            });
            $('#form_nats_search').on('reset', function () {
                $('#nationality_ids').val('').trigger('change');
            });
        });
    </script>
@endsection
