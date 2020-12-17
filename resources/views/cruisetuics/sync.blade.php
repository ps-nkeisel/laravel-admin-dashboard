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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Synced Cruisetuics</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">TUI Cruises</li>
                        <li class="breadcrumb-item active" aria-current="page">Cruisetuic</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    @include('shared.success')
    @include('shared.error')

    @if(isset($messages))
        <div class="content content-full">
        @if(count($messages) > 0)
            @foreach($messages as $message)
                <div class="alert alert-warning">
                    {{ $message }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @else
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok"></span>
                No updates

                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif
        </div>
    @endif

    <!-- Start Cruisetuics List -->
    <div class="content content-full">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded block-bordered dynamic_container">
            <div class="block-header block-header-default">
                <h3 class="block-title">Liste</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('cruisetuics.index') }}" title="Show All Cruisetuic" class="btn-block-option">
                            <i class="si si-list"></i>
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
                <table id="cruisetuics_datatable" class="table table-bordered table-striped table-vcenter text-break">
                    <thead>
                    <tr>
                        <th width="100px" class="text-center">ID</th>
                        <th width="30%">Scrcode</th>
                        <th width="30%">Scrcodeext</th>
                        <th width="20%">Scrname</th>
                        <th width="100px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cruisetuics as $cruisetuic)
                        <tr>
                            <td class="text-center">{{ $cruisetuic->id }}</td>
                            <td>{{ $cruisetuic->scrcode }}</td>
                            <td>{{ $cruisetuic->scrcodeext }}</td>
                            <td>{{ $cruisetuic->scrname }}</td>
                            <td>
                                <a href="{{ route('cruisetuics.edit', $cruisetuic->id) }}" class="btn btn-sm btn-info mr-1" title="Edit Cruisetuic"><i class="si si-pencil"></i></a>
                                <a href="{{ route('cruisetuics.show', $cruisetuic->id) }}" class="btn btn-sm btn-primary" title="Show Cruisetuic"><i class="si si-doc"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End List -->

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
            var cruisetuics_datatable = $('#cruisetuics_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: true,
                ajax: {
                    url: "{{ route('api.cruisetuics.search') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
                    },
                },
                drawCallback: function( TUI Cruises ) {
                    $('.dynamic_container').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'id', className: "text-center", width: "80px",
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("cruisetuics.index")}}/' + data + '">' + data + '</a>';
                        }
                    },
                    { data: 'sccode', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'scname', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'scrcode', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'scrcodeext', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'scrname', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'visa', className: "d-none d-sm-table-cell", width: "10%" },
                    { data: 'id', className: "text-right", width: "15%", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("cruisetuics.index")}}/' + data + '/edit" class="btn btn-sm btn-info mr-1" title="Edit Cruisetuic"><i class="si si-pencil"></i></a>' +
                                '<a href="{{ route("cruisetuics.index")}}/' + data + '" class="btn btn-sm btn-primary" title="Show Cruisetuic"><i class="si si-doc"></i></a>';
                        }
                    },
                ],
            });
        })
    </script>
@endsection
