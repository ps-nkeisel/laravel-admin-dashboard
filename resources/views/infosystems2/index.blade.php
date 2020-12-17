@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Infosystem2</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Infosystem2</li>
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
                <form method="POST" enctype="multipart/form-data" id="form_infosystem2_search">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="d-block"><h4 class="font-w400">Languages</h4></label>
                                <div class="row">
                                    <div class="col-6">
                                        <div
                                            class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" id="languages-all"
                                                name="language_ids[]" value=0 checked="">
                                            <label class="custom-control-label" for="languages-all">All</label>
                                        </div>
                                    </div>
                                    @foreach($languages as $key => $row)
                                        <div class="col-6">
                                            <div
                                                class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                                <input type="checkbox" class="custom-control-input language_id" id="languages-{{ $row->id }}"
                                                       name="language_ids[]"
                                                       value="{{ $row->id }}">
                                                <label class="custom-control-label" for="languages-{{ $row->id }}">{{ $row->content }} ( ID: {{ $row->id }} )</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row" style="margin-top:30px;">
                                    <div class="col-6">
                                        <label for="tagdate">Tag date</label>
                                        <input class="js-datepicker form-control form-control-alt"
                                                name="tagdate" type="text" id="tagdate" data-week-start="1" data-autoclose="true"
                                                data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                                                maxlength="40"
                                                placeholder="Enter tagdate here...">
                                    </div>
                                    <div class="col-6">

                                    </div>
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
                    <div class="form-group">
                        <label for="content">Country</label>
                        <input class="form-control form-control-alt" name="country"
                            type="text" id="country" maxlength="40"
                            placeholder="Enter country code here...">
                    </div>
                    <div class="form-group">
                        <label for="content">Nationality</label>
                        <input class="form-control form-control-alt" name="nat"
                            type="text" id="nat" maxlength="40"
                            placeholder="Enter nationality here...">
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4" style="margin-top:20px;">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="info1" name="info1" value="1">
                                    <label class="custom-control-label" for="info1">show into Infosystem</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="info2" name="info2" value="1">
                                    <label class="custom-control-label" for="info2">show into Corona Info</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="info3" name="info3" value="1">
                                    <label class="custom-control-label" for="info3">show into Infosystem 3</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="info4" name="info4" value="1">
                                    <label class="custom-control-label" for="info4">show into Infosystem 4</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" style="margin-top:20px;">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="entry" name="entry" value="1">
                                    <label class="custom-control-label" for="entry">show behind Entry</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="visa" name="visa" value="1">
                                    <label class="custom-control-label" for="visa">show behind Visa</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="transitvisa" name="transitvisa" value="1">
                                    <label class="custom-control-label" for="transitvisa">show behind Transitvisa</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="health" name="health" value="1">
                                    <label class="custom-control-label" for="health">show behind Health</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="cruise" name="cruise" value="1">
                                    <label class="custom-control-label" for="cruise">show behind Cruise</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4" style="margin-top:20px;">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="corona" name="corona" value="1">
                                    <label class="custom-control-label" for="corona">is Corona info</label>
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
                <h3 class="block-title">List</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('infosystems2.create') }}" class="btn-block-option">
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
                <table id="infosystems2_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Headline</th>
                            <th>Is Corona</th>
                            <th>Country</th>
                            <th>Show into Infosystem</th>
                            <th>Tag date</th>
                            <th>Created at</th>
                            <th></th>
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
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Page JS Code -->
    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->

    <!-- Page JS Helpers (BS Datepicker) -->
    <script>jQuery(function () {
            Dashmix.helpers(['datepicker']);
        });
    </script>

    <script>
        $(document).ready(function() {
            var infosystems2_datatable = $('#infosystems2_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                ajax: {
                    url: "{{ route('api.infosystems2.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
                        d.filters = {
                            language_ids: [],
                            time_containment: '',
                            active: 0,
                            archive: 0,
                            tagdate: '',
                            country: '',
                            nat: ''
                        };
                        var formData = $('#form_infosystem2_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'language_ids[]') {
                                d.filters.language_ids.push(element.value);
                            } else if (element.name == 'time_containment') {
                                d.filters.time_containment = element.value;
                            } else if (element.name == 'active') {
                                d.filters.active = 1;
                            } else if (element.name == 'archive') {
                                d.filters.archive = 1;
                            } else if (element.name == 'tagdate') {
                                d.filters.tagdate = element.value;
                            } else if (element.name == 'country') {
                                d.filters.country = element.value;
                            } else if (element.name == 'nat') {
                                d.filters.nat = element.value;
                            }
                            let arrAddinfo = ['info1', 'info2', 'info3', 'info4', 'entry', 'visa', 'transitvisa', 'health', 'cruise', 'corona'];
                            arrAddinfo.forEach(function(addinfo) {
                                if (element.name == addinfo) {
                                    d.filters[addinfo] = 1;
                                }
                            })
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
                            return '<a href="{{ route("infosystems2.index")}}/' + data + '/edit">' + data + '</a>';
                        }
                    },
                    { data: 'language_headline', className: "d-none d-sm-table-cell", width: "30%" },
                    { data: 'corona', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return `${data ? 'Yes' : 'No'}`;
                        }
                    },
                    { data: 'country', className: "font-w600", orderable: false },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return `
                                ${data.info1 == 1 ? '1 ' : ''}
                                ${data.info2 == 1 ? '2 ' : ''}
                                ${data.info3 == 1 ? '3 ' : ''}
                                ${data.info4 == 1 ? '4 ' : ''}
                            `;
                        }
                    },
                    { data: 'tagdate', className: "d-none d-sm-table-cell", width: "15%" },
                    { data: 'created_at', className: "d-none d-sm-table-cell", width: "15%" },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("infosystems2.index")}}/' + data + '/edit" class="btn btn-sm btn-info" style="margin-right:5px;"><i class="si si-pencil"></i></a>' +
                                '<a href="{{ route("infosystems2.index")}}/' + data + '" class="btn btn-sm btn-primary"><i class="si si-doc"></i></a>';
                        }
                    },
                ],
            });

            $('#languages-all').change(function() {
                if ($(this).prop('checked')) {
                    $('form input.language_id:checked').each(function() {
                        $(this).prop('checked', false);
                    });
                }
            });
            $('form input.language_id').change(function() {
                if ($(this).prop('checked')) {
                    $('form #languages-all').prop('checked', false);
                }
            });

            $('#form_infosystem2_search').submit(function() {
                infosystems2_datatable.ajax.reload();
                return false;
            });
        })
    </script>
@endsection
