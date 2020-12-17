@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
@endsection

@section('content')

    <!-- Head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Adr Head</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Adr Head</li>
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
                <form method="POST" enctype="multipart/form-data" id="form_adrhead_search">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="col-form-label" style="margin-top:15px;" for="matchcode">Matchcode</label>
                                        <input type="text" class="form-control form-control-alt" id="matchcode" name="matchcode" placeholder="Enter code here...">
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
                        <a href="{{ route('adrheads.create') }}" class="btn-block-option" title="Create New Inoculation">
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
                <table id="adrheads_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Matchcode</th>
                            <th>Type</th>
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

    <!-- Page JS Code -->
    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->

    <script>
        $(document).ready(function() {
            var adrheads_datatable = $('#adrheads_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                ajax: {
                    url: "{{ route('api.adrheads.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
                        d.filters = {
                            matchcode: '',
                            time_containment: '',
                            active: 0,
                        };
                        var formData = $('#form_adrhead_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'matchcode') {
                                d.filters.matchcode = element.value;
                            } else if (element.name == 'time_containment') {
                                d.filters.time_containment = element.value;
                            } else if (element.name == 'active') {
                                d.filters.active = 1;
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
                            return '<a href="{{ route("adrheads.index") }}/' + data + '">' + data + '</a>';
                        }
                    },
                    { data: 'matchcode', className: "font-w600" },
                    { data: 'adr_head_kind_id', width: "200px" },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("adrheads.index") }}/' + data + '/edit" class="btn btn-sm btn-info mr-1" title="Edit Inoculation"><i class="si si-pencil"></i></a>' +
                                '<a href="{{ route("adrheads.index") }}/' + data + '" class="btn btn-sm btn-primary" title="Show Inoculation"><i class="si si-doc"></i></a>';
                        }
                    },
                ],
            });

            $('#form_adrhead_search').submit(function() {
                adrheads_datatable.ajax.reload();
                return false;
            });
        })
    </script>
@endsection
