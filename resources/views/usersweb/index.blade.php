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
                <form method="POST" enctype="multipart/form-data" id="form_usersweb_search">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label class="col-form-label" for="username">Username</label>
                                <input type="text" class="form-control form-control-alt" id="username" name="username" placeholder="Enter user name here...">
                            </div>
                            <div class="col-3">
                                <label class="col-form-label" for="realname">Realname</label>
                                <input type="text" class="form-control form-control-alt" id="realname" name="realname" placeholder="Enter real name here...">
                            </div>
                            <div class="col-3">
                                <label class="col-form-label" for="address1">Address1</label>
                                <input type="text" class="form-control form-control-alt" id="address1" name="address1" placeholder="Enter address here...">
                            </div>
                            <div class="col-3">
                                <label class="col-form-label" for="zip">Zip</label>
                                <input type="text" class="form-control form-control-alt" id="zip" name="zip" placeholder="Enter zip here...">
                            </div>
                            <div class="col-3">
                                <label class="col-form-label" for="agency">Agency</label>
                                <input type="text" class="form-control form-control-alt" id="agency" name="agency" placeholder="Enter agency here...">
                            </div>
                            <div class="col-3">
                                <label class="col-form-label" for="cooperation_include">Cooperation / Chain</label>
                                <select class="js-select2 form-control" id="cooperation_include"
                                        name="cooperation_include[]"
                                        data-placeholder="Enter Cooperation / Chain here..." multiple>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach($adrheadcooperations as $adrheadcooperation)
                                        <option value="{{ $adrheadcooperation->code }}">{{ $adrheadcooperation->content_en }}({{ $adrheadcooperation->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label class="col-form-label" for="tags_include">Tags</label>
                                <select class="js-select2 form-control" id="tags_include"
                                        name="tags_include[]"
                                        data-placeholder="Enter Tags here..." multiple>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach($adrheadtags as $adrheadtag)
                                        <option value="{{ $adrheadtag->code }}">{{ $adrheadtag->content_en }}({{ $adrheadtag->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Status</label>
                        <div class="row">
                            <div class="col-3">
                                <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="status-active"
                                            name="active" checked="">
                                    <label class="custom-control-label" for="status-active">active</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="status-revised"
                                            name="revised" >
                                    <label class="custom-control-label" for="status-revised">revised</label>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                            <div class="col-3">

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4 style="margin-top:15px;margin-left:-10px;">and not</h4>
                        <div class="row">
                            <div class="col-3">
                                <label class="col-form-label" for="cooperation_exclude">Cooperation / Chain</label>
                                <select class="js-select2 form-control" id="cooperation_exclude"
                                        name="cooperation_exclude[]"
                                        data-placeholder="Enter Cooperation / Chain here..." multiple>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach($adrheadcooperations as $adrheadcooperation)
                                        <option value="{{ $adrheadcooperation->code }}">{{ $adrheadcooperation->content_en }}({{ $adrheadcooperation->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label class="col-form-label" for="tags_exclude">Tags</label>
                                <select class="js-select2 form-control" id="tags_exclude"
                                        name="tags_exclude[]"
                                        data-placeholder="Enter Tags here..." multiple>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach($adrheadtags as $adrheadtag)
                                        <option value="{{ $adrheadtag->code }}">{{ $adrheadtag->content_en }}({{ $adrheadtag->code }})</option>
                                    @endforeach
                                </select>
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
                        <a href="{{ route('usersweb.create') }}" class="btn-block-option" title="Create New Inoculation">
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
                <table id="userswebs_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Realname</th>
                            <th>Address1</th>
                            <th>Zip</th>
                            <th>Agency</th>
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
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>

    <!-- Page JS Code -->
    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->
    <script>jQuery(function () {
            Dashmix.helpers(['select2']);
        });</script>

    <script>
        $(document).ready(function() {
            var userswebs_datatable = $('#userswebs_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                ajax: {
                    url: "{{ route('api.usersweb.search') }}",
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
                            revised: 0,
                            cooperation_include: [],
                            cooperation_exclude: [],
                            tags_include: [],
                            tags_exclude: [],
                        };
                        var formData = $('#form_usersweb_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'username') {
                                d.filters.username = element.value;
                            } else if (element.name == 'realname') {
                                d.filters.realname = element.value;
                            } else if (element.name == 'address1') {
                                d.filters.address1 = element.value;
                            } else if (element.name == 'zip') {
                                d.filters.zip = element.value;
                            } else if (element.name == 'agency') {
                                d.filters.agency = element.value;
                            } else if (element.name == 'active') {
                                d.filters.active = 1;
                            } else if (element.name == 'revised') {
                                d.filters.revised = 1;
                            } else if (element.name == 'cooperation_include[]') {
                                d.filters.cooperation_include.push(element.value);
                            } else if (element.name == 'cooperation_exclude[]') {
                                d.filters.cooperation_exclude.push(element.value);
                            } else if (element.name == 'tags_include[]') {
                                d.filters.tags_include.push(element.value);
                            } else if (element.name == 'tags_exclude[]') {
                                d.filters.tags_exclude.push(element.value);
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
                            return '<a href="{{ route("usersweb.index") }}/' + data + '">' + data + '</a>';
                        }
                    },
                    { data: 'username' },
                    { data: 'realname' },
                    { data: 'address1' },
                    { data: 'zip' },
                    { data: 'agency' },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return `
                                <a href="{{ route("usersweb.index") }}/${data}/edit" class="btn btn-sm btn-info mr-1" title="Edit Inoculation"><i class="si si-pencil"></i></a>
                                <a href="{{ route("usersweb.index") }}/${data}" class="btn btn-sm btn-primary" title="Show Inoculation"><i class="si si-doc"></i></a>
                            `;
                        }
                    },
                ],
            });

            $('#form_usersweb_search').submit(function() {
                userswebs_datatable.ajax.reload();
                return false;
            });

            $('#form_usersweb_search').on('reset', function () {
                $('#cooperation_include').val('').trigger('change');
                $('#cooperation_exclude').val('').trigger('change');
                $('#tags_include').val('').trigger('change');
                $('#tags_exclude').val('').trigger('change');
            });

        })
    </script>
@endsection
