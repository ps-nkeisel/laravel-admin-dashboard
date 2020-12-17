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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Contentadditionals</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item">Basicdatas</li>
                        <li class="breadcrumb-item active" aria-current="page">Contentadditional</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    @include('shared.success')
    @include('shared.error')


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
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id="contentadditionals_datatable" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Headline</th>
                            <th>Position</th>
                            <th>Section</th>
                            <th>Section ID</th>
                            <th>Contentgroup ID</th>
                            <th>Remind Date</th>
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
                <form method="POST" enctype="multipart/form-data" id="form_contentadditional_check">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="col-form-label" for="lang">Language</label>
                                        <select class="form-control form-control-alt" id="lang" name="lang">
                                            <option value="">choose</option>
                                            @foreach($languages as $language)
                                                <option value="{{ $language->code }}">{{ $language->content }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6" style="margin-top: 15px;">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success my-4" id="export">export</button>
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

    <!-- Page JS Code -->
    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->

    <script>
        $(document).ready(function() {
            var contentadditionals_datatable = $('#contentadditionals_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: true,
                ordering: false,
                ajax: {
                    url: "{{ route('api.contentadditionals.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
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
                    { data: 'id', className: "text-center", width: "80px" },
                    { data: 'headline', className: "d-none d-sm-table-cell", width: "50%" },
                    { data: 'position', className: "d-none d-sm-table-cell"},
                    { data: 'section', className: "d-none d-sm-table-cell"},
                    { data: 'section_id', className: "d-none d-sm-table-cell"},
                    { data: 'contentgroup_id', className: "d-none d-sm-table-cell"},
                    { data: 'reminder', className: "d-none d-sm-table-cell"},
                ],
            });

            $('#export').click(function(event) {
                event.preventDefault();

                const lang = $('#lang').val();

                if (lang) {
                    window.location.href = '/contentadditionals/export/' + lang;
                }
            });
        })
    </script>
@endsection
