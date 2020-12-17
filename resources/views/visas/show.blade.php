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
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Visa details</h1>
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

    <!-- card -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered dynamic_container">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details Version {{ $visa->version }}</h3>
                @if($visa->archive)<span class="badge badge-warning">archived</span>@endif
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('visas.index') }}" class="btn-block-option"
                           title="Show All Visas">
                            <i class="si si-list"></i>
                        </a>

                        @if($visa->idversionbefore != 0)
                        <a href="{{ route('visas.show', $visa->idversionbefore) }}" class="btn-block-option"
                           title="Show version before">
                            <i class="si si-control-rewind"></i>
                        </a>
                        @endif

                        @if($visa->idversionnext != 0)
                        <a href="{{ route('visas.show', $visa->idversionnext) }}" class="btn-block-option"
                           title="Show next version">
                            <i class="si si-control-forward"></i>
                        </a>
                        @endif

                        <a href="{{ route('visas.create') }}" class="btn-block-option"
                           title="Create New Visa">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        @if($visa->archive != 1)
                        <a href="{{ route('visas.edit', $visa->id ) }}" class="btn-block-option"
                           title="Edit Visa">
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
                                       name="active" @if($visa->active)checked=""@endif disabled>
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
                                       name="importantchange" @if($visa->importantchange)checked=""@endif disabled>
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
                                       @if($visa->checkedandok) checked="" @endif
                                       @if($visa->archive || $visa->checkedandnotok) disabled @endif>
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
                                       @if($visa->checkedandnotok) checked="" @endif
                                       @if($visa->archive || $visa->checkedandok) disabled @endif>
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
                        {!! $visa->countrytocode !!} ( {{ $visa->country->name ?? '' }} )
                    </div>
                </div>

                <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                    <h2 class="content-heading">Infos come from</h2>

                    <p>{!! $visa->linkresource !!}</p>
                    <p>{!! $visa->textresource !!}</p>
                </div>

                <div class="col-sm-10 col-md-12 mt-4">
                    <h2 class="content-heading">Availability</h2>

                    @if($visa->no_info_available)
                        <p>No infos available (deactivated)</p>
                    @endif
                </div>

                @if(!$visa->no_info_available)
                    <div class="col-sm-10 col-md-12 mt-4">
                        <h2 class="content-heading">Required</h2>

                        @if($visa->require1 == 1)
                            <p>Visa is required</p>
                        @elseif($visa->require1 == 0)
                            <p>Visa is not required</p>
                        @elseif($visa->require1 == 2)
                            <p>Visa is free
                            @if($visa->freedays)
                                for {!! $visa->freedays !!} days
                            @endif
                            </p>
                        @endif
                    </div>

                    @if($visa->required_contentadditionals->count() > 0)
                        <div id="required_contentadditionals" class="col-sm-10 col-md-12">
                            <h2 class="content-heading">Additional Content for Visa Required section</h2>

                            @foreach($visa->required_contentadditionals as $indexKey => $contentadditional)
                                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                    <div class="block-header block-header-default">
                                        <a data-toggle="collapse" data-parent="#required_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                        </a>
                                    </div>
                                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#required_contentadditionals">
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

                    @if($visa->require1 == 1)
                        <div class="col-sm-10 col-md-12" style="margin-top:20px;">
                            <h2 class="content-heading">Visa order</h2>
                        </div>

                        <div class="col-sm-10 col-md-12">
                            <ul>
                                @if($visa->foreignrepresentation)
                                    <li>
                                        foreign representation : processing time
                                        @if($visa->foreign_foreign_handlingtime_from > 0)
                                            @if($visa->foreign_handlingtime_to > 0)
                                                from {!! $visa->foreign_handlingtime_from !!} to {!! $visa->foreign_handlingtime_to !!} days
                                            @else
                                                for {!! $visa->foreign_handlingtime_from !!} days
                                            @endif
                                        @elseif($visa->foreign_weeks)
                                            for few weeks
                                        @endif
                                    </li>
                                    @if($visa->orderforeign_contentadditionals->count() > 0)
                                        <div id="orderforeign_contentadditionals" class="col-sm-10 col-md-12">
                                            <h2 class="content-heading">Additional Content for Order Foreign Representation section</h2>

                                            @foreach($visa->orderforeign_contentadditionals as $indexKey => $contentadditional)
                                                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                                    <div class="block-header block-header-default">
                                                        <a data-toggle="collapse" data-parent="#orderforeign_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                                        </a>
                                                    </div>
                                                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#orderforeign_contentadditionals">
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

                                @if($visa->online)
                                    <li>
                                        online : processing time
                                        @if($visa->online_handlingtime_from > 0)
                                            @if($visa->online_handlingtime_to > 0)
                                                from {!! $visa->online_handlingtime_from !!} to {!! $visa->online_handlingtime_to !!} days
                                            @else
                                                for {!! $visa->online_handlingtime_from !!} days
                                            @endif
                                        @elseif($visa->online_weeks)
                                            for few weeks
                                        @endif
                                    </li>
                                    <p>EVisa Link: {!! $visa->evisalink !!}</p>
                                    @if($visa->orderonline_contentadditionals->count() > 0)
                                        <div id="orderonline_contentadditionals" class="col-sm-10 col-md-12">
                                            <h2 class="content-heading">Additional Content for Order Online section</h2>

                                            @foreach($visa->orderonline_contentadditionals as $indexKey => $contentadditional)
                                                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                                    <div class="block-header block-header-default">
                                                        <a data-toggle="collapse" data-parent="#orderonline_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                                        </a>
                                                    </div>
                                                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#orderonline_contentadditionals">
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

                                @if($visa->onarrival)
                                    <li>on arrival</li>
                                    @if($visa->orderonarrival_contentadditionals->count() > 0)
                                        <div id="orderonarrival_contentadditionals" class="col-sm-10 col-md-12">
                                            <h2 class="content-heading">Additional Content for Order On Arrival section</h2>

                                            @foreach($visa->orderonarrival_contentadditionals as $indexKey => $contentadditional)
                                                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                                    <div class="block-header block-header-default">
                                                        <a data-toggle="collapse" data-parent="#orderonarrival_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                                        </a>
                                                    </div>
                                                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#orderonarrival_contentadditionals">
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
                            </ul>
                        </div>
                    @endif
                @endif

                @if($visa->beforedocument_contentadditionals->count() > 0)
                    <div id="beforedocument_contentadditionals" class="col-sm-10 col-md-12">
                        <h2 class="content-heading">Additional Content before documents required section</h2>

                        @foreach($visa->beforedocument_contentadditionals as $indexKey => $contentadditional)
                            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                <div class="block-header block-header-default">
                                    <a data-toggle="collapse" data-parent="#beforedocument_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                    </a>
                                </div>
                                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#beforedocument_contentadditionals">
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
                    <h2 class="content-heading">Documents required</h2>
                </div>

                <div class="col-sm-10 col-md-12">
                    <ul>
                    @foreach($visa->visadocuments as $visadocument)
                        @if($visadocument->pivot->active)
                            <li>{{ $visadocument->content }}</li>
                        @endif
                    @endforeach
                    </ul>
                </div>

                @if($visa->afterdocument_contentadditionals->count() > 0)
                    <div id="afterdocument_contentadditionals" class="col-sm-10 col-md-12">
                        <h2 class="content-heading">Additional Content after documents required section</h2>

                        @foreach($visa->afterdocument_contentadditionals as $indexKey => $contentadditional)
                            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                <div class="block-header block-header-default">
                                    <a data-toggle="collapse" data-parent="#afterdocument_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                    </a>
                                </div>
                                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#afterdocument_contentadditionals">
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

                @if($visa->entrybyland_contentadditionals->count() > 0)
                    <div id="entrybyland_contentadditionals" class="col-sm-10 col-md-12">
                        <h2 class="content-heading">Additional Content for Entry by land section</h2>

                        @foreach($visa->entrybyland_contentadditionals as $indexKey => $contentadditional)
                            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                <div class="block-header block-header-default">
                                    <a data-toggle="collapse" data-parent="#entrybyland_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                    </a>
                                </div>
                                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#entrybyland_contentadditionals">
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

                @if($visa->entrybysea_contentadditionals->count() > 0)
                    <div id="entrybysea_contentadditionals" class="col-sm-10 col-md-12">
                        <h2 class="content-heading">Additional Content for Entry by sea section</h2>

                        @foreach($visa->entrybysea_contentadditionals as $indexKey => $contentadditional)
                            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                <div class="block-header block-header-default">
                                    <a data-toggle="collapse" data-parent="#entrybysea_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                    </a>
                                </div>
                                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#entrybysea_contentadditionals">
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

                @if($visa->afterentrybysea_contentadditionals->count() > 0)
                    <div id="afterentrybysea_contentadditionals" class="col-sm-10 col-md-12">
                        <h2 class="content-heading">Additional Content after Entry by sea section</h2>

                        @foreach($visa->afterentrybysea_contentadditionals as $indexKey => $contentadditional)
                            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}">
                                <div class="block-header block-header-default">
                                    <a data-toggle="collapse" data-parent="#afterentrybysea_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed">
                                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                    </a>
                                </div>
                                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#afterentrybysea_contentadditionals">
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

                @if($visa->footer_contentadditionals->count() > 0)
                    <div id="footer_contentadditionals" class="col-sm-10 col-md-12">
                        <h2 class="content-heading">Additional Content for footer</h2>

                        @foreach($visa->footer_contentadditionals as $indexKey => $contentadditional)
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
                        {{ $visa->created_at }}
                        <br>{{ $visa->created_username }} <!-- change to username -->
                        <br>{{ $visa->created_ip }}
                    </div>

                    <div class="col-4">
                        <h5 class="">Updated</h5>
                        {{ $visa->updated_at }}
                        <br>{{ $visa->updated_username }} <!-- change to username -->
                        <br>{{ $visa->updated_ip }}
                    </div>

                    <div class="col-4">
                        <h5 class="">Controlled</h5>
                        {{ $visa->controlled_at }}
                        <br>{{ $visa->controlled_username }} <!-- change to username -->
                        <br>{{ $visa->controlled_ip }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end card -->

    <!-- list of all assigned nationalities -->
    <div class="content content-full">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">List of Nationalities</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id='visanats_datatable' class="table table-bordered table-striped table-vcenter text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Name DE</th>
                            <th>Code</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full Pagination -->
    </div>
    <!-- end list of all assigned nationalities -->

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
                    <button type="button" class="btn btn-sm btn-success mr-1 mb-3" data-toggle="modal" data-target="#modalVisaReport" data-lang="{{ $language->code }}">
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

    <!-- list of all visas with the same assignto ID -->
    <div class="content content-full">
        <!-- Dynamic Table Full Pagination -->
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">List of all versions</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table id='visaversions_datatable' class="table table-bordered table-striped table-vcenter text-center">
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
    <!-- end list of all visas with the same assignto ID -->

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

    @include('visas.modals.report')
    @include('visas.modals.compare')

    <!-- Page JS Helpers (Summernote + SimpleMDE + CKEditor plugins) -->
    <script>
        jQuery(function(){
            Dashmix.helpers(['datepicker', 'summernote', 'simplemde', 'ckeditor', 'select2']);
        });

        $(document).ready(function () {
            var visaversions_datatable = $('#visaversions_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: true,
                ajax: {
                    url: "{{ route('api.visas.search_versions') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('#visaversions_datatable').closest('.block').addClass('block-mode-loading');
                        d.assignto = {{ $visa->assignto }};
                    }
                },
                drawCallback: function( settings ) {
                    $('#visaversions_datatable').closest('.block').removeClass('block-mode-loading');
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
                            return '<a href="{{ route("visas.index")}}/' + data + '" class="btn btn-sm btn-primary" title="Open Content"><span class="si si-doc" aria-hidden="true"></span></a>';
                        }
                    },
                ],
                createdRow: function( row, data, dataIndex){
                    if (data.id == {{ $visa->id }}) {
                        $(row).css('background-color', '#ffecc8');
                    }
                    $(row).attr('id', 'version-'+data.version);
                    $(row).data('id', data.id);
                },
                order: [
                    [ 1, 'desc' ]
                ]
            });

            var visanats_datatable = $('#visanats_datatable').DataTable( {
                serverSide: true,
                processing: true,
                searching: true,
                ajax: {
                    url: "{{ route('api.visas.search_nats') }}",
                    type: "POST",
                    headers: {
                        'CSRFToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function ( d ) {
                        $('#visanats_datatable').closest('.block').addClass('block-mode-loading');
                        d.id = {{ $visa->id }};
                    }
                },
                drawCallback: function( settings ) {
                    $('#visanats_datatable').closest('.block').removeClass('block-mode-loading');
                },
                lengthMenu: [
                    [ 50, 100, 500 ],
                    [ '50', '100', '500' ]
                ],
                columns: [
                    { data: 'id' },
                    { data: 'name_en', className: "text-left" },
                    { data: 'name_de', className: "text-left" },
                    { data: 'code' },
                    { data: 'id', className: "text-right", orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="{{ route("nationalities.index")}}/' + data + '" class="btn btn-sm btn-primary" title="Open Nationality"><span class="si si-doc" aria-hidden="true"></span></a>';
                        }
                    },
                ],
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
                    url: '{{ route("api.visas.get_id") }}',
                    data: {
                        assignto: {{ $visa->assignto }},
                        version: v1,
                    },
                    success: function(res){
                        $('#compare_versions').data('assigntoold', res);
                        $.ajax({
                            type: 'POST',
                            url: '{{ route("api.visas.get_id") }}',
                            data: {
                                assignto: {{ $visa->assignto }},
                                version: v2,
                            },
                            success: function(res){
                                $('#compare_versions').data('assigntonew', res);
                                $('#modalVisaCompare').modal('show', $('#compare_versions'));
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
                    url: '{{ route("api.visas.check") }}',
                    data: {
                        user_id: {{ Auth::user()->id }},
                        visa_id: "{{ $visa->id }}",
                        key: 'checkedandok',
                        value: $(this).prop('checked') ? 1 : 0,
                    }
                })
            });
            $('#checkedandnotok').change(function () {
                $('#checkedandok').prop("disabled", $(this).prop('checked'));
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.visas.check") }}',
                    data: {
                        user_id: {{ Auth::user()->id }},
                        visa_id: "{{ $visa->id }}",
                        key: 'checkedandnotok',
                        value: $(this).prop('checked') ? 1 : 0,
                    }
                })
            });

            $('#add_to_cache').click(function() {
                $('.dynamic_container').addClass('block-mode-loading');
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.visas.add_to_cache") }}',
                    data: {
                        id: {{ $visa->id }},
                    },
                    success: function (res){
                        $.notify({
                            title: 'Cache',
                            message: `Visa is added to cache successfully`
                        },{
                            type: 'success'
                        });
                    },
                    error: function (err) {
                        $.notify({
                            title: 'Cache',
                            message: `Failed to add visa to cache`
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
