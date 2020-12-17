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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Health recommendation details</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Conditions</li>
                        <li class="breadcrumb-item active" aria-current="page">Health recommendation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    @include('shared.success')
    @include('shared.error')

    <!-- card -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered dynamic_container">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details Version {{ $inoculation->version }}</h3>
                @if($inoculation->archive)<span class="badge badge-warning">archived</span>@endif
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('inoculations.index') }}" class="btn-block-option"
                           title="Show All Inoculations">
                            <i class="si si-list"></i>
                        </a>

                        @if($inoculation->idversionbefore != 0)
                        <a href="{{ route('inoculations.show', $inoculation->idversionbefore) }}" class="btn-block-option"
                           title="Show version before">
                            <i class="si si-control-rewind"></i>
                        </a>
                        @endif

                        @if($inoculation->idversionnext != 0)
                        <a href="{{ route('inoculations.show', $inoculation->idversionnext) }}" class="btn-block-option"
                           title="Show next version">
                            <i class="si si-control-forward"></i>
                        </a>
                        @endif

                        <a href="{{ route('inoculations.create') }}" class="btn-block-option"
                           title="Create New Inoculation">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        @if($inoculation->archive != 1)
                        <a href="{{ route('inoculations.edit', $inoculation->id ) }}" class="btn-block-option"
                           title="Edit Inoculation">
                            <span class="si si-pencil" aria-hidden="true"></span>
                        </a>
                        <!-- add result to redis -->
                        <a href="javascript:void(0)" class="btn-block-option" id="add_to_cache"
                            title="Add to cache">
                            <span class="fa fa-server" aria-hidden="true"></span>
                        </a>
                        <!-- add result to mongodb -->
                        <a href="javascript:void(0)" class="btn-block-option"
                            title="Add to database">
                            <span class="fa fa-database" aria-hidden="true"></span>
                        </a>
                        @endif

                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                    </div>
                </div>

            </div>
            <div class="block-content">
                <div class="card-body">
                    <div class="row justify-content-left py-sm-3 py-md-5" style="padding-top: 1rem !important;">
                        <div class="col-sm-10 col-md-3">
                            <div class="custom-control custom-block custom-control-success">
                                <input type="checkbox" class="custom-control-input" id="active"
                                       name="active" @if($inoculation->active)checked=""@endif disabled>
                                <label class="custom-control-label" for="active">
                                <span class="d-block text-center">
                                    <i class="fa fa-check fa-2x mb-2 text-black-50"></i><br>
                                    Active
                                </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-10 col-md-3">
                            <div class="custom-control custom-block custom-control-warning">
                                <input type="checkbox" class="custom-control-input" id="importantchange"
                                       name="importantchange" @if($inoculation->importantchange)checked=""@endif disabled>
                                <label class="custom-control-label" for="importantchange">
                                <span class="d-block text-center">
                                    <i class="fa fa-exclamation fa-2x mb-2 text-black-50"></i><br>
                                    Important change
                                </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-10 col-md-3">
                            <div class="custom-control custom-block custom-control-info">
                                <input type="checkbox" class="custom-control-input" id="checkedandok"
                                       name="checkedandok"
                                       @if($inoculation->checkedandok) checked="" @endif
                                       @if($inoculation->archive || $inoculation->checkedandnotok) disabled @endif>
                                <label class="custom-control-label" for="checkedandok">
                                <span class="d-block text-center">
                                    <i class="fa fa-info fa-2x mb-2 text-black-50"></i><br>
                                    Checked and OK
                                </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-10 col-md-3">
                            <div class="custom-control custom-block custom-control-danger">
                                <input type="checkbox" class="custom-control-input" id="checkedandnotok"
                                       name="checkedandnotok"
                                       @if($inoculation->checkedandnotok) checked="" @endif
                                       @if($inoculation->archive || $inoculation->checkedandok) disabled @endif>
                                <label class="custom-control-label" for="checkedandnotok">
                                <span class="d-block text-center">
                                    <i class="fa fa-times fa-2x mb-2 text-black-50"></i><br>
                                    Checked and not OK
                                </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Destination</h2>
                </div>

                <div class="col-sm-10 col-md-12">
                    <div class="form-group {{ $errors->has('countrytocode') ? 'is-invalid' : '' }}">
                        {!! $inoculation->countrytocode !!} ( {{ $inoculation->country->name ?? '' }} )
                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Infos come from</h2>

                    <p>{!! $inoculation->linkresource !!}</p>
                    <p>{!! $inoculation->textresource !!}</p>
                </div>

                <div class="col-sm-10 col-md-12 mt-4">
                    <h2 class="content-heading">Availability</h2>

                    @if($inoculation->no_info_available)
                        <p>No infos available (deactivated)</p>
                    @endif
                </div>

                @if(!$inoculation->no_info_available)
                    <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                        <h2 class="content-heading">Health requirements</h2>
                        <ul>
                        @foreach ($inoculation->requirement_immunisations as $requirement_immunisation)
                            @if ($requirement_immunisation->pivot->active)
                                <li>
                                    {{ $requirement_immunisation->content }}
                                    @if ($requirement_immunisation->pivot->longtermstay || $requirement_immunisation->pivot->specialexposure)
                                        &nbsp &nbsp
                                        @if ($requirement_immunisation->pivot->longtermstay)
                                            ✓ long-term stay &nbsp
                                        @endif
                                        @if ($requirement_immunisation->pivot->specialexposure)
                                            ✓ special exposure
                                        @endif
                                    @endif
                                </li>
                            @endif
                        @endforeach
                        </ul>
                    </div>

                    <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                        <h2 class="content-heading">Health recommendations</h2>
                        <ul>
                        @foreach ($inoculation->recommendation_immunisations as $recommendation_immunisation)
                            @if ($recommendation_immunisation->pivot->active)
                                <li>
                                    {{ $recommendation_immunisation->content }}
                                    @if ($recommendation_immunisation->pivot->longtermstay || $recommendation_immunisation->pivot->specialexposure)
                                        &nbsp &nbsp
                                        @if ($recommendation_immunisation->pivot->longtermstay)
                                            ✓ long-term stay &nbsp
                                        @endif
                                        @if ($recommendation_immunisation->pivot->specialexposure)
                                            ✓ special exposure
                                        @endif
                                    @endif
                                </li>
                            @endif
                        @endforeach
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                            <h2 class="content-heading">Contains info for pregnant</h2>
                            {{ ($inoculation->pregnant) ? 'Yes' : 'No' }}
                            <br>
                            <h5 style="margin-top:20px;">Options</h5>
                            <ul>
                            @foreach($inoculation->optionpregnants as $optionpregnant)
                                @if($optionpregnant->pivot->active)
                                    <li>{{ $optionpregnant->content }}</li>
                                @endif
                            @endforeach
                            </ul>
                            @if($inoculation->pregnant_contentadditionals->count() > 0)
                                <div id="pregnant_contentadditionals" class="col-sm-10 col-md-12 mb-3">
                                    <h5 class="content-heading mb-2">Additional Contents</h5>

                                    @foreach($inoculation->pregnant_contentadditionals as $indexKey => $contentadditional)
                                        <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                            <div class="block-header block-header-default">
                                                <a data-toggle="collapse" data-parent="#pregnant_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                                    <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                                </a>
                                            </div>
                                            <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#pregnant_contentadditionals">
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
                        </div>

                        <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                            <h2 class="content-heading">Contains info for child</h2>
                            {{ ($inoculation->child) ? 'Yes' : 'No' }}
                            <br>
                            <h5 style="margin-top:20px;">Options</h5>
                            <ul>
                            @foreach($inoculation->optionchildren as $optionchild)
                                @if($optionchild->pivot->active)
                                    <li>{{ $optionchild->content }}</li>
                                @endif
                            @endforeach
                            </ul>
                            @if($inoculation->child_contentadditionals->count() > 0)
                                <div id="child_contentadditionals" class="col-sm-10 col-md-12 mb-3">
                                    <h5 class="content-heading mb-2">Additional Contents</h5>

                                    @foreach($inoculation->child_contentadditionals as $indexKey => $contentadditional)
                                        <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                            <div class="block-header block-header-default">
                                                <a data-toggle="collapse" data-parent="#child_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                                    <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                                </a>
                                            </div>
                                            <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#child_contentadditionals">
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
                        </div>
                    </div>

                    @if($inoculation->yf)
                        <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                            <h2 class="content-heading">Yellowfever</h2>

                            @if(isset($inoculation->yellowfever))
                                <p>{{ $inoculation->yellowfever->content }}
                                    @if($inoculation->ggmonth)
                                    <br>>= {{ $inoculation->ggmonth }} months
                                    @endif
                                    @if($inoculation->transitingeneral)
                                        <br>Transit in general
                                    @endif
                                    @if($inoculation->transittime12hours)
                                        <br>Transit time 12 hours
                                    @endif
                                </p>
                            @endif
                        </div>
                    @endif

                    <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                        <h2 class="content-heading">Specifics</h2>
                    </div>

                    <div class="col-sm-10 col-md-12">
                        <ul>
                        @foreach($inoculation->inoculationspecifics as $inoculationspecific)
                            @if($inoculationspecific->pivot->active)
                                <li>{{ $inoculationspecific->content }}</li>
                            @endif
                        @endforeach
                        </ul>
                    </div>

                    @if($inoculation->specific_contentadditionals->count() > 0)
                        <div id="specific_contentadditionals" class="col-sm-10 col-md-12 mb-3">
                            <h5 class="content-heading mb-2">Additional Contents</h5>

                            @foreach($inoculation->specific_contentadditionals as $indexKey => $contentadditional)
                                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                    <div class="block-header block-header-default">
                                        <a data-toggle="collapse" data-parent="#specific_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                        </a>
                                    </div>
                                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#specific_contentadditionals">
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
                @endif

                @if($inoculation->footer_contentadditionals->count() > 0)
                    <div id="footer_contentadditionals" class="col-sm-10 col-md-12 mb-3">
                        <h5 class="content-heading mb-2">Additional Contents</h5>

                        @foreach($inoculation->footer_contentadditionals as $indexKey => $contentadditional)
                            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                <div class="block-header block-header-default">
                                    <a data-toggle="collapse" data-parent="#footer_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                    </a>
                                </div>
                                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#footer_contentadditionals">
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

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Activities</h2>
                </div>

                <div class="row block-content" style="margin-bottom:40px;">
                    <div class="col-4">
                        <h5 class="">Created</h5>
                        {{ $inoculation->created_at }}
                        <br>{{ $inoculation->created_username }} <!-- change to username -->
                        <br>{{ $inoculation->created_ip }}
                    </div>

                    <div class="col-4">
                        <h5 class="">Updated</h5>
                        {{ $inoculation->updated_at }}
                        <br>{{ $inoculation->updated_username }} <!-- change to username -->
                        <br>{{ $inoculation->updated_ip }}
                    </div>

                    <div class="col-4">
                        <h5 class="">Controlled</h5>
                        {{ $inoculation->controlled_at }}
                        <br>{{ $inoculation->controlled_username }} <!-- change to username -->
                        <br>{{ $inoculation->controlled_ip }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end card -->

    <!-- check result -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Show result of request</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="row" style="padding:20px;">
                    @foreach($languages as $language)
                    <button type="button" class="btn btn-sm btn-success mr-1 mb-3" data-toggle="modal" data-target="#modalHRReport" data-lang="{{ $language->code }}">
                        {{ $language->content }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- end check result -->

    <!-- compare versions -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Compare versions</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="compare-version-first">First version number</label>
                            <input class="form-control form-control-alt" name="compare-version-first"
                                   type="number" id="compare-version-first" maxlength="40"
                                   placeholder="Enter first version number here...">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="compare-version-second">Second version number</label>
                            <input class="form-control form-control-alt" name="compare-version-second"
                                   type="number" id="compare-version-second" maxlength="40"
                                   placeholder="Enter second version number here...">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group" style="margin-top:35px;">
                            <button class="btn btn-sm btn-success" id="compare_versions">
                                <i class="fa fa-check"></i> compare
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end compare versions -->

    <!-- list of all inoculations with the same assignto ID -->
    <div class="content content-full">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded block-bordered dynamic_container">
            <div class="block-header block-header-default">
                <h3 class="block-title">List of all versions</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id='inoculationversions_datatable' class="table table-bordered table-striped table-vcenter text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Version</th>
                            <th>Important Change</th>
                            <th>Created User</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- end list of all inoculations with the same assignto ID -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
    <script src="/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/js/plugins/jquery-validation/additional-methods.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/pages/be_forms_wizard.min.js"></script>
    <script src="/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/js/plugins/simplemde/simplemde.min.js"></script>
    <script src="/js/plugins/ckeditor/ckeditor.js"></script>

    <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.print.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.html5.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.flash.min.js"></script>
    <script src="/js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

    <!-- <script src="/js/pages/be_tables_datatables.min.js"></script> -->

    @include('inoculations.modals.report')
    @include('inoculations.modals.compare')

    <!-- Page JS Helpers (Summernote + SimpleMDE + CKEditor plugins) -->
    <script>
        jQuery(function(){
            Dashmix.helpers(['datepicker', 'summernote', 'simplemde', 'ckeditor', 'select2']);
        });

        $(document).ready(function () {
            var inoculationversions_datatable = $('#inoculationversions_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: true,
                ajax: {
                    url: "{{ route('api.inoculations.search_versions') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('.dynamic_container').addClass('block-mode-loading');
                        d.assignto = {{ $inoculation->assignto }};
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
                    { data: 'id' },
                    { data: 'version' },
                    { data: 'importantchange',
                        render: function(data, type, full, meta) {
                            return data ? '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-circle text-danger"></i>';
                        }
                    },
                    { data: 'created_username', orderable: false },
                    { data: 'created_at' },
                    { data: 'id', className: "text-right", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("inoculations.index") }}/' + data + '" class="btn btn-sm btn-primary" title="Open Content"><span class="si si-doc" aria-hidden="true"></span></a>';
                        }
                    },
                ],
                createdRow: function( row, data, dataIndex){
                    if (data.id == {{ $inoculation->id }}) {
                        $(row).css('background-color', '#ffecc8');
                    }
                    $(row).attr('id', 'version-'+data.version);
                    $(row).data('id', data.id);
                },
                order: [
                    [ 1, 'desc' ]
                ]
            });

            $('#compare_versions').click(function (event) {
                var v1 = $('#compare-version-first').val();
                var v2 = $('#compare-version-second').val();
                if (v1 <= 0 || v2 <= 0 || v1 == v2) {
                    alert('version invalid');
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.inoculations.get_id") }}',
                    data: {
                        assignto: {{ $inoculation->assignto }},
                        version: v1,
                    },
                    success: function(res){
                        $('#compare_versions').data('assigntoold', res);
                        $.ajax({
                            type: 'POST',
                            url: '{{ route("api.inoculations.get_id") }}',
                            data: {
                                assignto: {{ $inoculation->assignto }},
                                version: v2,
                            },
                            success: function(res){
                                $('#compare_versions').data('assigntonew', res);
                                $('#modalInoculationCompare').modal('show', $('#compare_versions'));
                            },
                            error: function() {
                                alert('version invalid');
                            }
                        });
                    },
                    error: function() {
                        alert('version invalid');
                    },
                });
            });

            $('#checkedandok').change(function () {
                $('#checkedandnotok').prop("disabled", $(this).prop('checked'));
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.inoculations.check") }}',
                    data: {
                        user_id: {{ Auth::user()->id }},
                        inoculation_id: "{{ $inoculation->id }}",
                        key: 'checkedandok',
                        value: $(this).prop('checked') ? 1 : 0,
                    }
                })
            });
            $('#checkedandnotok').change(function () {
                $('#checkedandok').prop("disabled", $(this).prop('checked'));
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.inoculations.check") }}',
                    data: {
                        user_id: {{ Auth::user()->id }},
                        inoculation_id: "{{ $inoculation->id }}",
                        key: 'checkedandnotok',
                        value: $(this).prop('checked') ? 1 : 0,
                    }
                })
            });

            $('#add_to_cache').click(function() {
                $('.dynamic_container').addClass('block-mode-loading');
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.inoculations.add_to_cache") }}',
                    data: {
                        id: {{ $inoculation->id }},
                    },
                    success: function (res){
                        $.notify({
                            title: 'Cache',
                            message: `Health is added to cache successfully`
                        },{
                            type: 'success'
                        });
                    },
                    error: function (err) {
                        $.notify({
                            title: 'Cache',
                            message: `Failed to add health to cache`
                        },{
                            type: 'danger'
                        });
                    },
                    complete: function () {
                        $('.dynamic_container').removeClass('block-mode-loading');
                    }
                });
            });

        });
    </script>
@endsection
