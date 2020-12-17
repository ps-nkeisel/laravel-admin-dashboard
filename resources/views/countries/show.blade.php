@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Country details</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">country</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    <!-- card -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('countries.index') }}" class="btn-block-option" title="Show All Country">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('countries.create') }}" class="btn-block-option" title="Create New Country">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('countries.edit', $country->id ) }}" class="btn-block-option" title="Edit Country">
                            <span class="si si-pencil" aria-hidden="true"></span>
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
            <div class="block-content">
                <div class="card-body">
                    @if($country->active == 1)
                        <button type="button" class="btn btn-sm btn-success mr-1 mb-3">
                            active
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-warning mr-1 mb-3">
                            inactive
                        </button>
                    @endif
                    <div class="row">
                        <div class="col-sm-10 col-md-6">
                            <dt style="margin-top:15px;">Code</dt>
                            <dd>{{ $country->code }}</dd>
                            <dt style="margin-top:15px;">Name</dt>
                            <dd>{{ $country->name }}</dd>
                            <dt style="margin-top:15px;">Name Local</dt>
                            <dd>{{ $country->name_local }}</dd>
                            <dt style="margin-top:15px;">Name En</dt>
                            <dd>{{ $country->name_en }}</dd>
                            <dt style="margin-top:15px;">Name Fr</dt>
                            <dd>{{ $country->name_fr }}</dd>
                            <dt style="margin-top:15px;">Name It</dt>
                            <dd>{{ $country->name_it }}</dd>
                            <dt style="margin-top:15px;">Name Nl</dt>
                            <dd>{{ $country->name_nl }}</dd>
                            <dt style="margin-top:15px;">Name Pl</dt>
                            <dd>{{ $country->name_pl }}</dd>
                            <dt style="margin-top:15px;">Name Es</dt>
                            <dd>{{ $country->name_es }}</dd>
                            <dt style="margin-top:15px;">Name Pt</dt>
                            <dd>{{ $country->name_pt }}</dd>
                            <dt style="margin-top:15px;">Name Ru</dt>
                            <dd>{{ $country->name_ru }}</dd>
                            <dt style="margin-top:15px;">Url1</dt>
                            <dd>{{ $country->url1 }}</dd>
                            <dt style="margin-top:15px;">Prio</dt>
                            <dd>{{ $country->prio }}</dd>
                            <dt style="margin-top:15px;">Google Static Map Code</dt>
                            <dd>{{ $country->google_static_map_code }}</dd>
                        </div>
                        <div class="col-sm-10 col-md-6">
                            <dt style="margin-top:15px;">Continent</dt>
                            <dd>{{ $country->continent }}</dd>
                            <dt style="margin-top:15px;">Capital</dt>
                            <dd>{{ $country->capital }}</dd>
                            <dt style="margin-top:15px;">Population</dt>
                            <dd>{{ $country->population }}</dd>
                            <dt style="margin-top:15px;">Area</dt>
                            <dd>{{ $country->area }}</dd>
                            <dt style="margin-top:15px;">Coastline</dt>
                            <dd>{{ $country->coastline }}</dd>
                            <dt style="margin-top:15px;">Governmentform</dt>
                            <dd>{{ $country->governmentform }}</dd>
                            <dt style="margin-top:15px;">Currency</dt>
                            <dd>{{ $country->currency }}</dd>
                            <dt style="margin-top:15px;">Currencycode</dt>
                            <dd>{{ $country->currencycode }}</dd>
                            <dt style="margin-top:15px;">Dialingprefix</dt>
                            <dd>{{ $country->dialingprefix }}</dd>
                            <dt style="margin-top:15px;">Birthrate</dt>
                            <dd>{{ $country->birthrate }}</dd>
                            <dt style="margin-top:15px;">Deathrate</dt>
                            <dd>{{ $country->deathrate }}</dd>
                            <dt style="margin-top:15px;">Lifeexpectancy</dt>
                            <dd>{{ $country->lifeexpectancy }}</dd>
                            <dt style="margin-top:15px;">Transitvisa</dt>
                            <dd>{{ $country->transitvisa }}</dd>
                            <dt style="margin-top:15px;">Transitvisatext</dt>
                            <dd>{{ $country->transitvisatext }}</dd>
                        </div>
                    </div>

                    @foreach ($contentadditionalSections as $key => $contentadditionalSection)
                        @if(count($contentadditionalSection['contentadditionals']) > 0)
                            <div id="{{ $key }}_contentadditionals" class="col-sm-10 col-md-12">
                                <h2 class="content-heading">Additional Content for {{ $contentadditionalSection['label'] }}</h2>

                                @foreach($contentadditionalSection['contentadditionals'] as $indexKey => $contentadditional)
                                    <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                        <div class="block-header block-header-default">
                                            <a data-toggle="collapse" data-parent="#{{ $key }}_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                                <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                            </a>
                                        </div>
                                        <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#{{ $key }}_contentadditionals">
                                            <div class="block-content">
                                                <div>Remind Date: {{ $contentadditional->reminder }}</div>
                                                <div class="js-wizard-simple block block block-rounded block-bordered">
                                                    <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                                        @foreach($languages as $language)
                                                            <li class="nav-item">
                                                                <a class="nav-link language-tab-link" href="#language-{{ $contentadditional->position }}-{{ $language->id }}" data-toggle="tab">{{ $language->content }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                                        @foreach($languages as $language)
                                                            <div class="tab-pane" id="language-{{ $contentadditional->position }}-{{ $language->id }}" role="tabpanel">
                                                            @php
                                                                $contentadditional_language = $contentadditional->languages->where('code', $language->code)->first()
                                                            @endphp
                                                            @if(optional(optional($contentadditional_language)->pivot)->main == 1)
                                                                <p>Main Language</p>
                                                            @endif
                                                                <p>{{ translationStatusNum2Text(old('', optional(optional($contentadditional_language)->pivot)->translatedfrom)) }}</p>

                                                                <h5>{{ old('', optional(optional($contentadditional_language)->pivot)->headline) }}</h5>
                                                                <p>{!! nl2br(old('', optional(optional($contentadditional_language)->pivot)->content)) !!}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach

                    <div class="row" style="margin-bottom:40px;">
                        <div class="col-sm-10 col-md-6">
                            <dt style="margin-top:15px;">Created At</dt>
                            <dd>{{ $country->created_at }}</dd>
                            <dt style="margin-top:15px;">Created User</dt>
                            <dd>{{ $country->createdUser->name ?? '' }}</dd>
                            <dt style="margin-top:15px;">Created Ip</dt>
                            <dd>{{ $country->created_ip }}</dd>
                        </div>
                        <div class="col-sm-10 col-md-6">
                            <dt style="margin-top:15px;">Updated At</dt>
                            <dd>{{ $country->updated_at }}</dd>
                            <dt style="margin-top:15px;">Updated User</dt>
                            <dd>{{ $country->updatedUser->name ?? '' }}</dd>
                            <dt style="margin-top:15px;">Updated Ip</dt>
                            <dd>{{ $country->updated_ip }}</dd>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

    <!-- list of all assigned currency -->
    <div class="content content-full">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">List of Currency</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id='countrycurrency_datatable' class="table table-bordered table-striped table-vcenter text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Base</th>
                            <th>Rate</th>
                            <th>Refresh</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- end list of all assigned currency -->

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

    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->

    <script>
        $(document).ready(function () {
            var countrycurrency_datatable = $('#countrycurrency_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: true,
                ajax: {
                    url: "{{ route('api.countries.search_currency') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('#countrycurrency_datatable').closest('.block').addClass('block-mode-loading');
                        d.id = {{ $country->id }};
                    }
                },
                drawCallback: function( settings ) {
                    $('#countrycurrency_datatable').closest('.block').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 20, 50, 100 ],
                    [ '20', '50', '100' ]
                ],
                columns: [
                    { data: 'id', className: "text-center", width: "80px" },
                    { data: 'base', className: "d-none d-sm-table-cell" },
                    { data: 'rate', className: "d-none d-sm-table-cell" },
                    { data: 'refresh', className: "d-none d-sm-table-cell" },
                ],
            });
        });
    </script>
@endsection
