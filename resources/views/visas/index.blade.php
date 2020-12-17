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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Visa</h1>
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
                <form method="POST" enctype="multipart/form-data" id="form_visa_search">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="col-form-label" style="margin-top:15px;" for="countrytocode">Destination</label>
                                        <input type="text" class="form-control form-control-alt" id="countrytocode" name="countrytocode" placeholder="Enter code 1 here...">
                                        <label class="col-form-label" style="margin-top:15px;" for="version">Version</label>
                                        <input type="text" class="form-control form-control-alt" id="version" name="version" placeholder="Enter version number here...">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tagtype"><h4 class="font-w400">Nationalities</h4></label>
                                <div class="form-group">
                                    <select class="js-select2 form-control" id="nationality_ids"
                                            name="nationality_ids[]"
                                            data-placeholder="Choose many.." multiple>
                                        <option></option>
                                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}">{{ $nationality->name_en.($nationality->code?' ('.$nationality->code.')':'') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="d-block"><h4 class="font-w400">Created</h4></label>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-all"
                                                   name="time_containment" value="all" checked="">
                                            <label class="custom-control-label" for="time-all">all</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-thismonth"
                                                   name="time_containment" value="this_month">
                                            <label class="custom-control-label" for="time-thismonth">this month</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-today"
                                                   name="time_containment" value="today">
                                            <label class="custom-control-label" for="time-today">today</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-lastmonth"
                                                   name="time_containment" value="last_month">
                                            <label class="custom-control-label" for="time-lastmonth">last month</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-thisweek"
                                                   name="time_containment" value="this_week">
                                            <label class="custom-control-label" for="time-thisweek">this week</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-thisyear"
                                                   name="time_containment" value="this_year">
                                            <label class="custom-control-label" for="time-thisyear">this year</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-lastweek"
                                                   name="time_containment" value="last_week">
                                            <label class="custom-control-label" for="time-lastweek">last week</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-radio custom-control-inline custom-control-primary">
                                            <input type="radio" class="custom-control-input" id="time-lastyear"
                                                   name="time_containment" value="last_year">
                                            <label class="custom-control-label" for="time-lastyear">last year</label>
                                        </div>
                                    </div>
                                </div>

                                <label class="d-block" style="margin-top:30px;"><h4 class="font-w400">Status</h4></label>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" id="status-active"
                                                   name="active" checked="">
                                            <label class="custom-control-label" for="status-active">active</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" id="status-archive"
                                                   name="archive">
                                            <label class="custom-control-label" for="status-archive">archive</label>
                                        </div>
                                    </div>
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
                        <a href="{{ route('visas.create') }}" class="btn-block-option" title="Create New Visa">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id="visas_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Destination</th>
                            <th>Version</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- End List Pagination -->

    <!-- tools -->
    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Tools</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <form method="POST" enctype="multipart/form-data" id="form_visa_check">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="col-form-label" for="checkcountrytocode">Destination</label>
                                        <input type="text" class="form-control form-control-alt" id="checkcountrytocode" name="checkcountrytocode" placeholder="Enter code 1 here...">
                                    </div>
                                    <div class="col-6" style="margin-top: 15px;">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" style="margin-top: 15px;">
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="check" name="toolaction" checked="">
                                <label class="custom-control-label" for="check">check</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="checkall" name="toolaction" >
                                <label class="custom-control-label" for="checkall">check all</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="export" name="toolaction" >
                                <label class="custom-control-label" for="export">export</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                <input type="radio" class="custom-control-input" id="exportall" name="toolaction" >
                                <label class="custom-control-label" for="exportall">export all</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success my-4" id="start_check">start</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end tools -->

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
            var visas_datatable = $('#visas_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                ajax: {
                    url: "{{ route('api.visas.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
                        d.filters = {
                            countrytocode: '',
                            version: '',
                            time_containment: '',
                            active: 0,
                            archive: 0,
                            nationality_ids: [],
                        };
                        var formData = $('#form_visa_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'countrytocode') {
                                d.filters.countrytocode = element.value;
                            } else if (element.name == 'version') {
                                d.filters.version = element.value;
                            } else if (element.name == 'time_containment') {
                                d.filters.time_containment = element.value;
                            } else if (element.name == 'active') {
                                d.filters.active = 1;
                            } else if (element.name == 'archive') {
                                d.filters.archive = 1;
                            } else if (element.name == 'nationality_ids[]') {
                                d.filters.nationality_ids.push(element.value);
                            }
                        })
                    }
                },
                drawCallback: function( settings ) {
                    $('.dynamic_container').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'id', className: "text-center", width: "80px",
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("visas.index")}}/' + data + '">' + data + '</a>';
                        }
                    },
                    { data: 'countrytocode', className: "font-w600" },
                    { data: 'version', className: "d-none d-sm-table-cell", width: "15%" },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("visas.index")}}/' + data + '/edit" class="btn btn-sm btn-info mr-1" title="Edit Visa"><i class="si si-pencil"></i></a>' +
                                '<a href="{{ route("visas.index")}}/' + data + '" class="btn btn-sm btn-primary" title="Show Visa"><i class="si si-doc"></i></a>';
                        }
                    },
                ],
            });

            $('#form_visa_search').submit(function() {
                visas_datatable.ajax.reload();
                return false;
            });
            $('#form_visa_search').on('reset', function () {
                $('#nationality_ids').val('').trigger('change');
            });

            $('#start_check').click(function(event) {
                event.preventDefault();
                if ($('#check').prop('checked') == true) {
                    let checkcountrytocode = $('#checkcountrytocode').val();
                    window.location.href = '/visas/check/natassign/' + checkcountrytocode;
                } else if ($('#checkall').prop('checked') == true) {
                    window.location.href = "{{ route('visas.check.assign') }}";
                }
            });
        })
    </script>
@endsection
