@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Translations</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Translation</li>
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
                <form method="POST" enctype="multipart/form-data" id="form_translation_search">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="col-form-label" style="margin-top:15px;" for="code">Language Code</label>
                                        <input type="text" class="form-control form-control-alt" id="code" name="code" placeholder="Enter language code here...">
                                        <label class="col-form-label" style="margin-top:15px;" for="item">Item</label>
                                        <input type="text" class="form-control form-control-alt" id="item" name="item" placeholder="Enter item here...">
                                        <label class="col-form-label" style="margin-top:15px;" for="text">Content</label>
                                        <input type="text" class="form-control form-control-alt" id="text" name="text" placeholder="Enter content here...">
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
                        <a href="{{ route('translations.create') }}" class="btn-block-option" title="Create New Translation">
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
                <table id="translations_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Namespace</th>
                        <th>Group</th>
                        <th>Item</th>
                        <th>Text</th>
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
            var translations_datatable = $('#translations_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: false,
                ajax: {
                    url: "{{ route('api.translations.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
                        d.filters = {
                            code: '',
                            item: '',
                            text: '',
                        };
                        var formData = $('#form_translation_search').serializeArray();
                        formData.forEach(function(element) {
                            if (element.name == 'code') {
                                d.filters.code = element.value;
                            } else if (element.name == 'item') {
                                d.filters.item = element.value;
                            } else if (element.name == 'text') {
                                d.filters.text = element.value;
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
                    { data: 'id', className: "text-center", width: "80px",
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("translations.index")}}/' + data + '">' + data + '</a>';
                        }
                    },
                    { data: 'code', className: "font-w600" },
                    { data: 'namespace', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'group', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'item', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'text', className: "d-none d-sm-table-cell", width: "30%" },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("translations.index")}}/' + data + '/edit" class="btn btn-sm btn-info mr-1" title="Edit Translation"><i class="si si-pencil"></i></a>' +
                                '<a href="{{ route("translations.index")}}/' + data + '" class="btn btn-sm btn-primary" title="Show Translation"><i class="si si-doc"></i></a>';
                        }
                    },
                ],
            });
            $('#form_translation_search').submit(function() {
                translations_datatable.ajax.reload();
                return false;
            });
        })
    </script>
@endsection
