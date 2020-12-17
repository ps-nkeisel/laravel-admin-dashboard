@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')

    <!-- Head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Clients</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Clients</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end Head -->

    @include('shared.success')
    @include('shared.error')

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
                <form method="POST" enctype="multipart/form-data" id="form_requestinfo_search">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="datefrom">Date from</label>
                                <input class="js-datepicker form-control form-control-alt"
                                        name="datefrom" type="text" id="datefrom" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd"
                                        placeholder="Enter start date (YYYY-MM-DD) here..." required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="dateto">Date to</label>
                                <input class="js-datepicker form-control form-control-alt"
                                        name="dateto" type="text" id="dateto" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd"
                                        placeholder="Enter stop date (YYYY-MM-DD) here..." required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="dest">Destination</label>
                                <input class="form-control form-control-alt" name="dest"
                                    type="text" id="dest" maxlength="2"
                                    placeholder="Enter destination here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="nat">Nationality</label>
                                <input class="form-control form-control-alt" name="nat"
                                    type="text" id="nat" maxlength="2"
                                    placeholder="Enter nationality here...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="lang">Language</label>
                                <input class="form-control form-control-alt" name="lang"
                                    type="text" id="lang" maxlength="2"
                                    placeholder="Enter language here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="bookingnr">Booking number</label>
                                <input class="form-control form-control-alt" name="bookingnr"
                                    type="number" id="bookingnr" maxlength="40"
                                    placeholder="Enter booking number here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="traveldate">Travel Date</label>
                                <input class="js-datepicker form-control form-control-alt"
                                        name="traveldate" type="text" id="traveldate" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd"
                                        placeholder="Enter travel date (YYYY-MM-DD) here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="requestid">Request Id</label>
                                <input class="form-control form-control-alt" name="requestid"
                                    type="text" id="requestid"
                                    placeholder="Enter request id here...">
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
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Show Requests</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id="requestinfos_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="width:400px">Request Id</th>
                            <th>Created At</th>
                            <th>Dest</th>
                            <th>Nat</th>
                            <th>Lang</th>
                            <th>B.Nr.</th>
                            <th>Travel Date</th>
                            <th>CI</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
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
    <script src="/js/plugins/moment/moment.min.js"></script>

    @include('requestinfos.modals.report')

    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->
    <script>jQuery(function () {
            Dashmix.helpers(['select2']);
        });</script>

    <script>
        $(document).ready(function() {
            var requestinfos_datatable = $('#requestinfos_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                deferLoading: 0,
                ajax: {
                    url: "{{ route('api.requestinfo.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('#requestinfos_datatable').closest('.block').addClass('block-mode-loading');
                        d.filters = {};
                        var formData = $('#form_requestinfo_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'datefrom') {
                                d.filters.datefrom = element.value;
                            } else if (element.name == 'dateto') {
                                d.filters.dateto = element.value;
                            } else if (element.name == 'dest') {
                                d.filters.dest = element.value;
                            } else if (element.name == 'nat') {
                                d.filters.nat = element.value;
                            } else if (element.name == 'lang') {
                                d.filters.lang = element.value;
                            } else if (element.name == 'bookingnr') {
                                d.filters.bookingnr = element.value;
                            } else if (element.name == 'traveldate') {
                                d.filters.traveldate = element.value;
                            } else if (element.name == 'requestid') {
                                d.filters.requestid = element.value;
                            }
                        })
                    }
                },
                drawCallback: function( settings ) {
                    $('#requestinfos_datatable').closest('.block').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'requestid' },
                    { data: 'created_at',
                        render: function(data, type, full, meta) {
                            return moment(data, 'D/M/YYYY h:mm A').format('YYYY-MM-DD hh:mm a');
                        }
                    },
                    { data: 'dest' },
                    { data: 'nat' },
                    { data: 'lang' },
                    { data: 'bookingnr' },
                    { data: 'traveldate' },
                    { data: 'checkimportant' },
                    { data: 'created_at', width: '150px', orderable: false,
                        render: function(data, type, full, meta) {
                            return `
                                <button class="btn btn-sm btn-info mr-1" data-request-id="${ full.requestid }" data-mode="json" title="Open Request Link" data-toggle="modal" data-target="#modalRequestinfoReport"><i class="si si-eye"></i></button>
                                <button class="btn btn-sm btn-info mr-1" data-request-id="${ full.requestid }" data-mode="html" title="Show Request Report" data-toggle="modal" data-target="#modalRequestinfoReport"><i class="si si-doc"></i></button>
                            `;
                        }
                    },
                ],
                order: [[ 2, "desc" ]],     // order by created_at by default
            });

            $('#form_requestinfo_search').submit(function() {
                requestinfos_datatable.ajax.reload();
                return false;
            });

        })
    </script>
@endsection
