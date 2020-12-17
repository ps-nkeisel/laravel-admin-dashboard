<div class="col-sm-10 col-md-3">
    <div class="custom-control custom-block custom-control-success">
        <input type="checkbox" class="custom-control-input" id="active"
               name="active" {{ $errors->has('active') ? 'is-invalid' : '' }}
               value="{{ old('active', optional($inoculation)->active) }}" {{ old('active', optional($inoculation)->active == '1' ? 'checked' : '' ) }}>
        <label class="custom-control-label" for="active">
            <span class="d-block text-center">
                <i class="fa fa-check fa-2x mb-2 text-black-50"></i><br>
                Record is active
            </span>
        </label>
        <span class="custom-block-indicator">
            <i class="fa fa-check"></i>
        </span>
    </div>
</div>

<div class="col-sm-10 col-md-3">
    <div class="custom-control custom-block custom-control-warning">
        <input type="checkbox" class="custom-control-input" id="importantchange"
               name="importantchange" {{ $errors->has('importantchange') ? 'is-invalid' : '' }}
               value="{{ old('importantchange', optional($inoculation)->importantchange) }}">
        <label class="custom-control-label" for="importantchange">
            <span class="d-block text-center">
                <i class="fa fa-exclamation fa-2x mb-2 text-black-50"></i><br>
                Important change
            </span>
        </label>
        <span class="custom-block-indicator">
            <i class="fa fa-check"></i>
        </span>
    </div>
</div>

@if(isset($inoculation))
    <div class="col-sm-10 col-md-3">
        <div class="custom-control custom-block custom-control-info">
            <input type="checkbox" class="custom-control-input" id="checkedandok"
                name="checkedandok" {{ $errors->has('checkedandok') ? 'is-invalid' : '' }}
                value="{{ old('checkedandok', optional($inoculation)->checkedandok) }}">
            <label class="custom-control-label" for="checkedandok">
                <span class="d-block text-center">
                    <i class="fa fa-info fa-2x mb-2 text-black-50"></i><br>
                    Checked and OK
                </span>
            </label>
            <span class="custom-block-indicator">
                <i class="fa fa-check"></i>
            </span>
        </div>
    </div>

    <div class="col-sm-10 col-md-3">
        <div class="custom-control custom-block custom-control-danger">
            <input type="checkbox" class="custom-control-input" id="checkedandnotok"
                name="checkedandnotok" {{ $errors->has('checkedandnotok') ? 'is-invalid' : '' }}
                value="{{ old('checkedandnotok', optional($inoculation)->checkedandnotok) }}">
            <label class="custom-control-label" for="checkedandnotok">
                <span class="d-block text-center">
                    <i class="fa fa-times fa-2x mb-2 text-black-50"></i><br>
                    Checked and not OK
                </span>
            </label>
            <span class="custom-block-indicator">
                <i class="fa fa-check"></i>
            </span>
        </div>
    </div>
@endif

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Destination<span class="country-name"></span></h2>
</div>

<div class="col-sm-10 col-md-12">
    <div class="form-group {{ $errors->has('countrytocode') ? 'is-invalid' : '' }}">
        <input class="form-control form-control-alt {{ $errors->has('countrytocode') ? 'is-invalid' : '' }} "
               name="countrytocode" type="text" id="countrytocode"
               value="{{ old('countrytocode', optional($inoculation)->countrytocode) }}" min="0" max="2"
               placeholder="Enter countrytocode here...">
        {!! $errors->first('countrytocode', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="col-sm-10 col-md-12 mt-4">
    <h2 class="content-heading">Availability</h2>

    <div class="row">
        <div class="col-sm-10 col-md-12">
            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="no_info_available"
                    name="no_info_available"
                    value="{{ old('no_info_available', optional($inoculation)->no_info_available) }}" {{ optional($inoculation)->no_info_available ? 'checked' : '' }}>
                <label class="custom-control-label" for="no_info_available">No Infos available (deactivated)</label>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Health requirements</h2>
</div>

@foreach($requirement_immunisations as $requirement_immunisation)
<div class="col-sm-10 col-md-12 requirement_immunisation-container">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="requirement_immunisation custom-control-input" id="requirement_immunisation-{{ $requirement_immunisation->id }}"
                        name="requirement_immunisations[]"
                        value="{{ $requirement_immunisation->id }}" {{ $requirement_immunisation->active == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="requirement_immunisation-{{ $requirement_immunisation->id }}">{!! $requirement_immunisation->content !!}</label>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="requirement_longtermstay custom-control-input" id="requirement_longtermstay-{{ $requirement_immunisation->id }}"
                        name="requirement_longtermstays[]"
                        value="{{ $requirement_immunisation->id }}" {{ $requirement_immunisation->longtermstay == '1' ? 'checked' : '' }}
                        {{ $requirement_immunisation->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="requirement_longtermstay-{{ $requirement_immunisation->id }}">long-term stay</label>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="requirement_specialexposure custom-control-input" id="requirement_specialexposure-{{ $requirement_immunisation->id }}"
                        name="requirement_specialexposures[]"
                        value="{{ $requirement_immunisation->id }}" {{ $requirement_immunisation->specialexposure == '1' ? 'checked' : '' }}
                        {{ $requirement_immunisation->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="requirement_specialexposure-{{ $requirement_immunisation->id }}">special exposure</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Health recommendations</h2>
</div>

@foreach($recommendation_immunisations as $recommendation_immunisation)
<div class="col-sm-10 col-md-12 recommendation_immunisation-container">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="recommendation_immunisation custom-control-input" id="recommendation_immunisation-{{ $recommendation_immunisation->id }}"
                        name="recommendation_immunisations[]"
                        value="{{ $recommendation_immunisation->id }}" {{ $recommendation_immunisation->active == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="recommendation_immunisation-{{ $recommendation_immunisation->id }}">{!! $recommendation_immunisation->content !!}</label>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="recommendation_longtermstay custom-control-input" id="recommendation_longtermstay-{{ $recommendation_immunisation->id }}"
                        name="recommendation_longtermstays[]"
                        value="{{ $recommendation_immunisation->id }}" {{ $recommendation_immunisation->longtermstay == '1' ? 'checked' : '' }}
                        {{ $recommendation_immunisation->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="recommendation_longtermstay-{{ $recommendation_immunisation->id }}">long-term stay</label>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="recommendation_specialexposure custom-control-input" id="recommendation_specialexposure-{{ $recommendation_immunisation->id }}"
                        name="recommendation_specialexposures[]"
                        value="{{ $recommendation_immunisation->id }}" {{ $recommendation_immunisation->specialexposure == '1' ? 'checked' : '' }}
                        {{ $recommendation_immunisation->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="recommendation_specialexposure-{{ $recommendation_immunisation->id }}">special exposure</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Contains info for pregnant</h2>
    <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
        <input type="checkbox" class="pregnant custom-control-input" id="pregnant"
               name="pregnant" {{ old('pregnant', optional($inoculation)->pregnant) == '1' ? 'checked' : '' }}>
        <label class="custom-control-label" for="pregnant">Pregnant</label>
    </div>
    <br>
    <h5 style="margin-top:20px;">Options</h5>
    @foreach($optionpregnants as $optionpregnant)
        <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
            <input type="checkbox" class="optionpregnant custom-control-input" id="optionpregnant-{{ $optionpregnant->id }}"
                name="optionpregnants[]"
                value="{{ $optionpregnant->id }}" {{ $optionpregnant->active == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="optionpregnant-{{ $optionpregnant->id }}">{!! $optionpregnant->content !!}</label>
        </div>
        <br>
    @endforeach
    <br>
    <div id="pregnant-contentadditionals" class="contentadditionals-container" data-section="op">
        <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
            add new additional content
        </button>

        @if(isset($pregnant_contentadditionals))
            @foreach($pregnant_contentadditionals as $indexKey => $contentadditional)
                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                    <div class="block-header block-header-default">
                        <a data-toggle="collapse" data-parent="#pregnant-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                        </a>
                        <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                    </div>
                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#pregnant-contentadditionals">
                        <div class="block-content">
                            <div class="row mb-4">
                                <div class="col-8 contentgroups-container">
                                @if(count($pregnant_contentgroups) > 0)
                                    <label class="control-label">Content Group</label>
                                    <select class="js-select2 form-control contentgroups"
                                            name="contentgroups[{{ $contentadditional->position }}]"
                                            style="width: 100%;">
                                        <option></option>
                                        @foreach($pregnant_contentgroups as $contentgroup)
                                            <option value="{{ $contentgroup->id }}"
                                                @if (optional($contentadditional->contentgroup)->id == $contentgroup->id)
                                                    selected="selected"
                                                @endif
                                            >{{ $contentgroup->content }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                </div>
                                <div class="col-4">
                                    <label class="control-label reminder-label" for="reminder-{{ $contentadditional->position }}">Remind Date</label>
                                    <input class="js-datepicker form-control form-control-alt reminder"
                                        name="reminders[{{ $contentadditional->position }}]" type="text" id="reminder-{{ $contentadditional->position }}" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                                        value="{{ $contentadditional->reminder }}" maxlength="40"
                                        placeholder="Enter remind date here...">
                                </div>
                            </div>
                            <div class="js-wizard-simple block block-rounded block-bordered dynamic_container">
                                <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="op">
                                <input type="hidden" class="language-section-id" name="languageSectionIds[{{ $contentadditional->position }}]" value="0">
                                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                    @foreach($languages as $language)
                                        <li class="nav-item">
                                            <a class="nav-link language-tab-link" href="#language-{{ $contentadditional->position }}-{{ $language->id }}" data-toggle="tab" data-lang-id="{{ $language->id }}">{{ $language->content }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                    @foreach($languages as $language)
                                        <div class="tab-pane language-container" id="language-{{ $contentadditional->position }}-{{ $language->id }}" data-lang="{{ $language->code }}" data-lang-id="{{ $language->id }}" role="tabpanel">
                                            @php
                                                $contentadditional_language = $contentadditional->languages->where('code', $language->code)->first()
                                            @endphp

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input language-main"
                                                        id="language_main-{{ $contentadditional->position }}-{{ $language->id }}]"
                                                        name="languageMains[{{ $contentadditional->position }}][]"
                                                        value="{{ $language->id }}"
                                                        {{ optional(optional($contentadditional_language)->pivot)->main == 1 ? 'checked' : '' }}
                                                    >
                                                    <label class="custom-control-label" for="language_main-{{ $contentadditional->position }}-{{ $language->id }}]">Main Language</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Translation Status</label>
                                                <select class="translatedfrom js-select2 form-control"
                                                        name="translatedfroms[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                        style="width: 100%;">
                                                    <option value=0>choose</option>
                                                    @foreach($translation_status as $index => $trans_stat)
                                                        <option value="{{ $index+1 }}"
                                                            @if(optional(optional($contentadditional_language)->pivot)->translatedfrom == $index+1)
                                                                selected="selected"
                                                            @endif
                                                        >{{ $trans_stat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label>{{ $language->content }} saved content</label>

                                            <div class="translate-deepl row mb-4">
                                                <div class="col-6">
                                                    Get content from
                                                    <select class="form-control form-control-alt d-inline-block w-auto source-lang">
                                                        <option value="">choose</option>
                                                        @foreach($languages as $language2)
                                                            <option value="{{ $language2->id }}" @if($language2->code == "de")
                                                            selected="selected"@endif
                                                            >{{ $language2->content }}</option>
                                                        @endforeach
                                                    </select>
                                                    tab and
                                                    <button type="button" class="btn btn-sm btn-success mr-1 do-translate-from">
                                                        translate
                                                    </button>
                                                    it to {{ $language->content }}
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-sm btn-success mr-1 mb-3 do-translate-to-all">
                                                        translate this to all
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Headline:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-control-alt language-headline"
                                                            name="languageHeadlines[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                            value="{{ old('headline', optional(optional($contentadditional_language)->pivot)->headline) }}" maxlength="1000"
                                                            placeholder="Enter Headline here...">
                                                </div>
                                            </div>
                                            <textarea class="form-control form-control-alt language-content" name="languageContents[{{ $contentadditional->position }}][{{ $language->id }}]" rows="15">{{ old('content', optional(optional($contentadditional_language)->pivot)->content) }}</textarea>

                                            <p>languageables: [{{ optional(optional($contentadditional_language)->pivot)->id }}]</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Contains info for child</h2>
    <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
        <input type="checkbox" class="child custom-control-input" id="child"
               name="child" {{ old('child', optional($inoculation)->child) == '1' ? 'checked' : '' }}>
        <label class="custom-control-label" for="child">Child</label>
    </div>
    <br>
    <h5 style="margin-top:20px;">Options</h5>
    @foreach($optionchildren as $optionchild)
        <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
            <input type="checkbox" class="optionchild custom-control-input" id="optionchild-{{ $optionchild->id }}"
                   name="optionchildren[]"
                   value="{{ $optionchild->id }}" {{ $optionchild->active == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="optionchild-{{ $optionchild->id }}">{!! $optionchild->content !!}</label>
        </div>
        <br>
    @endforeach
    <br>
    <div id="child-contentadditionals" class="contentadditionals-container" data-section="oc">
        <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
            add new additional content
        </button>

        @if(isset($child_contentadditionals))
            @foreach($child_contentadditionals as $indexKey => $contentadditional)
                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                    <div class="block-header block-header-default">
                        <a data-toggle="collapse" data-parent="#child-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                        </a>
                        <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                    </div>
                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#child-contentadditionals">
                        <div class="block-content">
                            <div class="row mb-4">
                                <div class="col-8 contentgroups-container">
                                @if(count($child_contentgroups) > 0)
                                    <label class="control-label">Content Group</label>
                                    <select class="js-select2 form-control contentgroups"
                                            name="contentgroups[{{ $contentadditional->position }}]"
                                            style="width: 100%;">
                                        <option></option>
                                        @foreach($child_contentgroups as $contentgroup)
                                            <option value="{{ $contentgroup->id }}"
                                                @if (optional($contentadditional->contentgroup)->id == $contentgroup->id)
                                                    selected="selected"
                                                @endif
                                            >{{ $contentgroup->content }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                </div>
                                <div class="col-4">
                                    <label class="control-label reminder-label" for="reminder-{{ $contentadditional->position }}">Remind Date</label>
                                    <input class="js-datepicker form-control form-control-alt reminder"
                                        name="reminders[{{ $contentadditional->position }}]" type="text" id="reminder-{{ $contentadditional->position }}" data-week-start="1" data-autoclose="true"
                                        data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                                        value="{{ $contentadditional->reminder }}" maxlength="40"
                                        placeholder="Enter remind date here...">
                                </div>
                            </div>
                            <div class="js-wizard-simple block block-rounded block-bordered dynamic_container">
                                <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="oc">
                                <input type="hidden" class="language-section-id" name="languageSectionIds[{{ $contentadditional->position }}]" value="0">
                                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                    @foreach($languages as $language)
                                        <li class="nav-item">
                                            <a class="nav-link language-tab-link" href="#language-{{ $contentadditional->position }}-{{ $language->id }}" data-toggle="tab" data-lang-id="{{ $language->id }}">{{ $language->content }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                    @foreach($languages as $language)
                                        <div class="tab-pane language-container" id="language-{{ $contentadditional->position }}-{{ $language->id }}" data-lang="{{ $language->code }}" data-lang-id="{{ $language->id }}" role="tabpanel">
                                            @php
                                                $contentadditional_language = $contentadditional->languages->where('code', $language->code)->first()
                                            @endphp

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input language-main"
                                                        id="language_main-{{ $contentadditional->position }}-{{ $language->id }}]"
                                                        name="languageMains[{{ $contentadditional->position }}][]"
                                                        value="{{ $language->id }}"
                                                        {{ optional(optional($contentadditional_language)->pivot)->main == 1 ? 'checked' : '' }}
                                                    >
                                                    <label class="custom-control-label" for="language_main-{{ $contentadditional->position }}-{{ $language->id }}]">Main Language</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Translation Status</label>
                                                <select class="translatedfrom js-select2 form-control"
                                                        name="translatedfroms[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                        style="width: 100%;">
                                                    <option value=0>choose</option>
                                                    @foreach($translation_status as $index => $trans_stat)
                                                        <option value="{{ $index+1 }}"
                                                            @if(optional(optional($contentadditional_language)->pivot)->translatedfrom == $index+1)
                                                                selected="selected"
                                                            @endif
                                                        >{{ $trans_stat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label>{{ $language->content }} saved content</label>

                                            <div class="translate-deepl row mb-4">
                                                <div class="col-6">
                                                    Get content from
                                                    <select class="form-control form-control-alt d-inline-block w-auto source-lang">
                                                        <option value="">choose</option>
                                                        @foreach($languages as $language2)
                                                            <option value="{{ $language2->id }}" @if($language2->code == "de")
                                                            selected="selected"@endif
                                                            >{{ $language2->content }}</option>
                                                        @endforeach
                                                    </select>
                                                    tab and
                                                    <button type="button" class="btn btn-sm btn-success mr-1 do-translate-from">
                                                        translate
                                                    </button>
                                                    it to {{ $language->content }}
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-sm btn-success mr-1 mb-3 do-translate-to-all">
                                                        translate this to all
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Headline:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control form-control-alt language-headline"
                                                            name="languageHeadlines[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                            value="{{ old('headline', optional(optional($contentadditional_language)->pivot)->headline) }}" maxlength="1000"
                                                            placeholder="Enter Headline here...">
                                                </div>
                                            </div>
                                            <textarea class="form-control form-control-alt language-content" name="languageContents[{{ $contentadditional->position }}][{{ $language->id }}]" rows="15">{{ old('content', optional(optional($contentadditional_language)->pivot)->content) }}</textarea>

                                            <p>languageables: [{{ optional(optional($contentadditional_language)->pivot)->id }}]</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Yellowfever</h2>
</div>

<div class="col-sm-10 col-md-12">
    <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
        <input type="checkbox" class="custom-control-input" id="yf"
               name="yf" {{ old('yf', optional($inoculation)->yf) == '1' ? 'checked' : '' }}>
        <label class="custom-control-label" for="yf">Yellowfever</label>
    </div>
</div>

@foreach($yellowfevers as $yellowfever)
    <div class="col-sm-10 col-md-6 yellowfever-container" style="margin-top:20px;">
        <div class="custom-control custom-radio custom-control-lg custom-control-inline">
            <input type="radio" class="yellowfever custom-control-input" id="yellowfever-{{ $yellowfever->id }}"
                name="yellowfever_id"
                value="{{ $yellowfever->id }}" {{ $yellowfever->active ? 'checked' : '' }}>
            <label class="custom-control-label" for="yellowfever-{{ $yellowfever->id }}">{!! $yellowfever->content !!}</label>
        </div>
        <br>
        <div class="custom-control" style="padding-top:15px;">
            <div class="form-group">
                >=
                <input class="ggmonth form-control form-control-alt"
                    name="ggmonths[{{ $yellowfever->id }}]" type="number" id="ggmonth-{{ $yellowfever->id }}"
                    value="{{ $yellowfever->ggmonth }}" maxlength="10" min="0"
                    {{ $yellowfever->active ? '' : 'disabled' }}
                    style="width: 60px; display: inline-block; margin-right: 10px;margin-left: 5px;">month
            </div>
        </div>
        <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
            <input type="checkbox" class="transitingeneral custom-control-input" id="transitingeneral-{{ $yellowfever->id }}"
                name="transitingenerals[{{ $yellowfever->id }}]"
                value="{{ $yellowfever->id }}" {{ $yellowfever->transitingeneral == $yellowfever->id ? 'checked' : '' }}
                {{ $yellowfever->active ? '' : 'disabled' }}>
            <label class="custom-control-label" for="transitingeneral-{{ $yellowfever->id }}">Transit in general</label>
        </div>
        <br>
        <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
            <input type="checkbox" class="transittime12hours custom-control-input" id="transittime12hours-{{ $yellowfever->id }}"
                name="transittime12hours[{{ $yellowfever->id }}]"
                value="{{ $yellowfever->id }}" {{ $yellowfever->transittime12hours == $yellowfever->id ? 'checked' : '' }}
                {{ $yellowfever->active ? '' : 'disabled' }}>
            <label class="custom-control-label" for="transittime12hours-{{ $yellowfever->id }}">Transit time 12 hours</label>
        </div>
        <br>
    </div>
@endforeach

<div id="yellowfever-contentadditionals" class="contentadditionals-container col-sm-10 col-md-12 mt-3" data-section="yf">
    <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
        add new additional content
    </button>

    @if(isset($yellowfever_contentadditionals))
        @foreach($yellowfever_contentadditionals as $indexKey => $contentadditional)
            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                <div class="block-header block-header-default">
                    <a data-toggle="collapse" data-parent="#yellowfever-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                    </a>
                    <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                </div>
                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#yellowfever-contentadditionals">
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-8 contentgroups-container">
                            @if(count($yellowfever_contentgroups) > 0)
                                <label class="control-label">Content Group</label>
                                <select class="js-select2 form-control contentgroups"
                                        name="contentgroups[{{ $contentadditional->position }}]"
                                        style="width: 100%;">
                                    <option></option>
                                    @foreach($yellowfever_contentgroups as $contentgroup)
                                        <option value="{{ $contentgroup->id }}"
                                            @if (optional($contentadditional->contentgroup)->id == $contentgroup->id)
                                                selected="selected"
                                            @endif
                                        >{{ $contentgroup->content }}</option>
                                    @endforeach
                                </select>
                            @endif
                            </div>
                            <div class="col-4">
                                <label class="control-label reminder-label" for="reminder-{{ $contentadditional->position }}">Remind Date</label>
                                <input class="js-datepicker form-control form-control-alt reminder"
                                    name="reminders[{{ $contentadditional->position }}]" type="text" id="reminder-{{ $contentadditional->position }}" data-week-start="1" data-autoclose="true"
                                    data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                                    value="{{ $contentadditional->reminder }}" maxlength="40"
                                    placeholder="Enter remind date here...">
                            </div>
                        </div>
                        <div class="js-wizard-simple block block-rounded block-bordered dynamic_container">
                            <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="yf">
                            <input type="hidden" class="language-section-id" name="languageSectionIds[{{ $contentadditional->position }}]" value="0">
                            <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                @foreach($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link language-tab-link" href="#language-{{ $contentadditional->position }}-{{ $language->id }}" data-toggle="tab" data-lang-id="{{ $language->id }}">{{ $language->content }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                @foreach($languages as $language)
                                    <div class="tab-pane language-container" id="language-{{ $contentadditional->position }}-{{ $language->id }}" data-lang="{{ $language->code }}" data-lang-id="{{ $language->id }}" role="tabpanel">
                                        @php
                                            $contentadditional_language = $contentadditional->languages->where('code', $language->code)->first()
                                        @endphp

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                                                <input type="checkbox" class="custom-control-input language-main"
                                                    id="language_main-{{ $contentadditional->position }}-{{ $language->id }}]"
                                                    name="languageMains[{{ $contentadditional->position }}][]"
                                                    value="{{ $language->id }}"
                                                    {{ optional(optional($contentadditional_language)->pivot)->main == 1 ? 'checked' : '' }}
                                                >
                                                <label class="custom-control-label" for="language_main-{{ $contentadditional->position }}-{{ $language->id }}]">Main Language</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Translation Status</label>
                                            <select class="translatedfrom js-select2 form-control"
                                                    name="translatedfroms[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                    style="width: 100%;">
                                                <option value=0>choose</option>
                                                @foreach($translation_status as $index => $trans_stat)
                                                    <option value="{{ $index+1 }}"
                                                        @if(optional(optional($contentadditional_language)->pivot)->translatedfrom == $index+1)
                                                            selected="selected"
                                                        @endif
                                                    >{{ $trans_stat }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label>{{ $language->content }} saved content</label>

                                        <div class="translate-deepl row mb-4">
                                            <div class="col-6">
                                                Get content from
                                                <select class="form-control form-control-alt d-inline-block w-auto source-lang">
                                                    <option value="">choose</option>
                                                    @foreach($languages as $language2)
                                                        <option value="{{ $language2->id }}" @if($language2->code == "de")
                                                        selected="selected"@endif
                                                        >{{ $language2->content }}</option>
                                                    @endforeach
                                                </select>
                                                tab and
                                                <button type="button" class="btn btn-sm btn-success mr-1 do-translate-from">
                                                    translate
                                                </button>
                                                it to {{ $language->content }}
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-sm btn-success mr-1 mb-3 do-translate-to-all">
                                                    translate this to all
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Headline:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-alt language-headline"
                                                        name="languageHeadlines[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                        value="{{ old('headline', optional(optional($contentadditional_language)->pivot)->headline) }}" maxlength="1000"
                                                        placeholder="Enter Headline here...">
                                            </div>
                                        </div>
                                        <textarea class="form-control form-control-alt language-content" name="languageContents[{{ $contentadditional->position }}][{{ $language->id }}]" rows="15">{{ old('content', optional(optional($contentadditional_language)->pivot)->content) }}</textarea>

                                        <p>languageables: [{{ optional(optional($contentadditional_language)->pivot)->id }}]</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Specifics</h2>
    <div class="form-group">
        @foreach($inoculationspecifics as $inoculationspecific)
            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                <input type="checkbox" class="inoculationspecific custom-control-input" id="inoculationspecific-{{ $inoculationspecific->id }}"
                       name="inoculationspecifics[]"
                       value="{{ $inoculationspecific->id }}" {{ $inoculationspecific->active == '1' ? 'checked' : '' }}>
                <label class="custom-control-label" for="inoculationspecific-{{ $inoculationspecific->id }}">{!! $inoculationspecific->content !!}</label>
            </div>
        @endforeach
    </div>
</div>

<div id="specific-contentadditionals" class="contentadditionals-container col-sm-10 col-md-12" data-section="sp">
    <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
        add new additional content
    </button>

    @if(isset($specific_contentadditionals))
        @foreach($specific_contentadditionals as $indexKey => $contentadditional)
            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                <div class="block-header block-header-default">
                    <a data-toggle="collapse" data-parent="#specific-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                    </a>
                    <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                </div>
                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#specific-contentadditionals">
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-8 contentgroups-container">
                            @if(count($specific_contentgroups) > 0)
                                <label class="control-label">Content Group</label>
                                <select class="js-select2 form-control contentgroups"
                                        name="contentgroups[{{ $contentadditional->position }}]"
                                        style="width: 100%;">
                                    <option></option>
                                    @foreach($specific_contentgroups as $contentgroup)
                                        <option value="{{ $contentgroup->id }}"
                                            @if (optional($contentadditional->contentgroup)->id == $contentgroup->id)
                                                selected="selected"
                                            @endif
                                        >{{ $contentgroup->content }}</option>
                                    @endforeach
                                </select>
                            @endif
                            </div>
                            <div class="col-4">
                                <label class="control-label reminder-label" for="reminder-{{ $contentadditional->position }}">Remind Date</label>
                                <input class="js-datepicker form-control form-control-alt reminder"
                                    name="reminders[{{ $contentadditional->position }}]" type="text" id="reminder-{{ $contentadditional->position }}" data-week-start="1" data-autoclose="true"
                                    data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                                    value="{{ $contentadditional->reminder }}" maxlength="40"
                                    placeholder="Enter remind date here...">
                            </div>
                        </div>
                        <div class="js-wizard-simple block block-rounded block-bordered dynamic_container">
                            <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="sp">
                            <input type="hidden" class="language-section-id" name="languageSectionIds[{{ $contentadditional->position }}]" value="0">
                            <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                @foreach($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link language-tab-link" href="#language-{{ $contentadditional->position }}-{{ $language->id }}" data-toggle="tab" data-lang-id="{{ $language->id }}">{{ $language->content }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                @foreach($languages as $language)
                                    <div class="tab-pane language-container" id="language-{{ $contentadditional->position }}-{{ $language->id }}" data-lang="{{ $language->code }}" data-lang-id="{{ $language->id }}" role="tabpanel">
                                        @php
                                            $contentadditional_language = $contentadditional->languages->where('code', $language->code)->first()
                                        @endphp

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                                                <input type="checkbox" class="custom-control-input language-main"
                                                    id="language_main-{{ $contentadditional->position }}-{{ $language->id }}]"
                                                    name="languageMains[{{ $contentadditional->position }}][]"
                                                    value="{{ $language->id }}"
                                                    {{ optional(optional($contentadditional_language)->pivot)->main == 1 ? 'checked' : '' }}
                                                >
                                                <label class="custom-control-label" for="language_main-{{ $contentadditional->position }}-{{ $language->id }}]">Main Language</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Translation Status</label>
                                            <select class="translatedfrom js-select2 form-control"
                                                    name="translatedfroms[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                    style="width: 100%;">
                                                <option value=0>choose</option>
                                                @foreach($translation_status as $index => $trans_stat)
                                                    <option value="{{ $index+1 }}"
                                                        @if(optional(optional($contentadditional_language)->pivot)->translatedfrom == $index+1)
                                                            selected="selected"
                                                        @endif
                                                    >{{ $trans_stat }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label>{{ $language->content }} saved content</label>

                                        <div class="translate-deepl row mb-4">
                                            <div class="col-6">
                                                Get content from
                                                <select class="form-control form-control-alt d-inline-block w-auto source-lang">
                                                    <option value="">choose</option>
                                                    @foreach($languages as $language2)
                                                        <option value="{{ $language2->id }}" @if($language2->code == "de")
                                                        selected="selected"@endif
                                                        >{{ $language2->content }}</option>
                                                    @endforeach
                                                </select>
                                                tab and
                                                <button type="button" class="btn btn-sm btn-success mr-1 do-translate-from">
                                                    translate
                                                </button>
                                                it to {{ $language->content }}
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-sm btn-success mr-1 mb-3 do-translate-to-all">
                                                    translate this to all
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Headline:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-alt language-headline"
                                                        name="languageHeadlines[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                        value="{{ old('headline', optional(optional($contentadditional_language)->pivot)->headline) }}" maxlength="1000"
                                                        placeholder="Enter Headline here...">
                                            </div>
                                        </div>
                                        <textarea class="form-control form-control-alt language-content" name="languageContents[{{ $contentadditional->position }}][{{ $language->id }}]" rows="15">{{ old('content', optional(optional($contentadditional_language)->pivot)->content) }}</textarea>

                                        <p>languageables: [{{ optional(optional($contentadditional_language)->pivot)->id }}]</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Additional Content</h2>
</div>

<div id="footer-contentadditionals" class="contentadditionals-container col-sm-10 col-md-12" data-section="fo">
    <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
        add new additional content
    </button>

    @if(isset($footer_contentadditionals))
        @foreach($footer_contentadditionals as $indexKey => $contentadditional)
            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                <div class="block-header block-header-default">
                    <a data-toggle="collapse" data-parent="#footer-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                    </a>
                    <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                </div>
                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#footer-contentadditionals">
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-8 contentgroups-container">
                            @if(count($footer_contentgroups) > 0)
                                <label class="control-label">Content Group</label>
                                <select class="js-select2 form-control contentgroups"
                                        name="contentgroups[{{ $contentadditional->position }}]"
                                        style="width: 100%;">
                                    <option></option>
                                    @foreach($footer_contentgroups as $contentgroup)
                                        <option value="{{ $contentgroup->id }}"
                                            @if (optional($contentadditional->contentgroup)->id == $contentgroup->id)
                                                selected="selected"
                                            @endif
                                        >{{ $contentgroup->content }}</option>
                                    @endforeach
                                </select>
                            @endif
                            </div>
                            <div class="col-4">
                                <label class="control-label reminder-label" for="reminder-{{ $contentadditional->position }}">Remind Date</label>
                                <input class="js-datepicker form-control form-control-alt reminder"
                                    name="reminders[{{ $contentadditional->position }}]" type="text" id="reminder-{{ $contentadditional->position }}" data-week-start="1" data-autoclose="true"
                                    data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                                    value="{{ $contentadditional->reminder }}" maxlength="40"
                                    placeholder="Enter remind date here...">
                            </div>
                        </div>
                        <div class="js-wizard-simple block block-rounded block-bordered dynamic_container">
                            <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="fo">
                            <input type="hidden" class="language-section-id" name="languageSectionIds[{{ $contentadditional->position }}]" value="0">
                            <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                @foreach($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link language-tab-link" href="#language-{{ $contentadditional->position }}-{{ $language->id }}" data-toggle="tab" data-lang-id="{{ $language->id }}">{{ $language->content }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                @foreach($languages as $language)
                                    <div class="tab-pane language-container" id="language-{{ $contentadditional->position }}-{{ $language->id }}" data-lang="{{ $language->code }}" data-lang-id="{{ $language->id }}" role="tabpanel">
                                        @php
                                            $contentadditional_language = $contentadditional->languages->where('code', $language->code)->first()
                                        @endphp

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                                                <input type="checkbox" class="custom-control-input language-main"
                                                    id="language_main-{{ $contentadditional->position }}-{{ $language->id }}]"
                                                    name="languageMains[{{ $contentadditional->position }}][]"
                                                    value="{{ $language->id }}"
                                                    {{ optional(optional($contentadditional_language)->pivot)->main == 1 ? 'checked' : '' }}
                                                >
                                                <label class="custom-control-label" for="language_main-{{ $contentadditional->position }}-{{ $language->id }}]">Main Language</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Translation Status</label>
                                            <select class="translatedfrom js-select2 form-control"
                                                    name="translatedfroms[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                    style="width: 100%;">
                                                <option value=0>choose</option>
                                                @foreach($translation_status as $index => $trans_stat)
                                                    <option value="{{ $index+1 }}"
                                                        @if(optional(optional($contentadditional_language)->pivot)->translatedfrom == $index+1)
                                                            selected="selected"
                                                        @endif
                                                    >{{ $trans_stat }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label>{{ $language->content }} saved content</label>

                                        <div class="translate-deepl row mb-4">
                                            <div class="col-6">
                                                Get content from
                                                <select class="form-control form-control-alt d-inline-block w-auto source-lang">
                                                    <option value="">choose</option>
                                                    @foreach($languages as $language2)
                                                        <option value="{{ $language2->id }}" @if($language2->code == "de")
                                                        selected="selected"@endif
                                                        >{{ $language2->content }}</option>
                                                    @endforeach
                                                </select>
                                                tab and
                                                <button type="button" class="btn btn-sm btn-success mr-1 do-translate-from">
                                                    translate
                                                </button>
                                                it to {{ $language->content }}
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-sm btn-success mr-1 mb-3 do-translate-to-all">
                                                    translate this to all
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Headline:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-alt language-headline"
                                                        name="languageHeadlines[{{ $contentadditional->position }}][{{ $language->id }}]"
                                                        value="{{ old('headline', optional(optional($contentadditional_language)->pivot)->headline) }}" maxlength="1000"
                                                        placeholder="Enter Headline here...">
                                            </div>
                                        </div>
                                        <textarea class="form-control form-control-alt language-content" name="languageContents[{{ $contentadditional->position }}][{{ $language->id }}]" rows="15">{{ old('content', optional(optional($contentadditional_language)->pivot)->content) }}</textarea>

                                        <p>languageables: [{{ optional(optional($contentadditional_language)->pivot)->id }}]</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Where does the infos come from</h2>
    <div class="form-group {{ $errors->has('linkresource') ? 'is-invalid' : '' }}">
        <label for="linkresource">Link to resource</label>
        <input class="form-control form-control-alt {{ $errors->has('linkresource') ? 'is-invalid' : '' }} "
               name="linkresource" type="text" id="linkresource"
               value="{{ old('linkresource', optional($inoculation)->linkresource) }}" minlength="10" maxlength="1000"
               placeholder="Enter link to resource here...">
        {!! $errors->first('linkresource', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="col-sm-10 col-md-12">
    <div class="form-group {{ $errors->has('textresource') ? 'is-invalid' : '' }}">
        <label for="textresource">Text from resource</label>
        <input class="form-control form-control-alt {{ $errors->has('textresource') ? 'is-invalid' : '' }} "
               name="textresource" type="text" id="textresource"
               value="{{ old('textresource', optional($inoculation)->textresource) }}" minlength="10" maxlength="1000"
               placeholder="Enter text from resource here...">
        {!! $errors->first('textresource', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

@section('js_form')
    @include('inoculations.modals.preview')

    <script>
        $(document).ready(function() {
            $('.requirement_immunisation').change(function() {
                var checked = $(this).prop('checked');
                var reqImmunContainer = $(this).closest('.requirement_immunisation-container');
                reqImmunContainer.find('.requirement_longtermstay').prop('disabled', !checked);
                reqImmunContainer.find('.requirement_specialexposure').prop('disabled', !checked);
                if (checked == false) {
                    reqImmunContainer.find('.requirement_longtermstay').prop('checked', false);
                    reqImmunContainer.find('.requirement_specialexposure').prop('checked', false);
                }
            });

            $('.recommendation_immunisation').change(function() {
                var checked = $(this).prop('checked');
                var recImmunContainer = $(this).closest('.recommendation_immunisation-container');
                recImmunContainer.find('.recommendation_longtermstay').prop('disabled', !checked);
                recImmunContainer.find('.recommendation_specialexposure').prop('disabled', !checked);
                if (checked == false) {
                    recImmunContainer.find('.recommendation_longtermstay').prop('checked', false);
                    recImmunContainer.find('.recommendation_specialexposure').prop('checked', false);
                }
            });

            $('.pregnant').change(function () {
                if ($(this).prop('checked') == false) {
                    $('.optionpregnant').prop('checked', false);
                }
            });
            $('.optionpregnant').change(function() {
                $('.pregnant').prop('checked', $('.optionpregnant:checked').length>0);
            });

            $('.child').change(function () {
                if ($(this).prop('checked') == false) {
                    $('.optionchild').prop('checked', false);
                }
            });
            $('.optionchild').change(function() {
                $('.child').prop('checked', $('.optionchild:checked').length>0);
            });

            $('#yf').change(function() {
                if ($(this).prop('checked') == false) {
                    $('.yellowfever').prop('checked', false);
                    $('.yellowfever').trigger('change');
                }
            });
            $('.yellowfever').change(function() {
                var yfID = $(this).val();
                if ($(this).prop('checked') == true) {
                    $('#yf').prop('checked', true);
                }
                $('.yellowfever').each(function() {
                    var checked = ($(this).val() == yfID);
                    var yfContainer = $(this).closest('.yellowfever-container');
                    yfContainer.find('.ggmonth').prop('disabled', !checked).val('');
                    yfContainer.find('.transitingeneral').prop('disabled', !checked).prop('checked', false);
                    yfContainer.find('.transittime12hours').prop('disabled', !checked).prop('checked', false);
                });
            });

            var contentgroups = {
                'op': [],
                'oc': [],
                'yf': [],
                'sp': [],
                'fo': [],
            }
            @foreach($pregnant_contentgroups as $contentgroup)
                contentgroups['op'].push({
                    'id': '{{ $contentgroup->id }}',
                    'content': '{{ $contentgroup->content }}',
                })
            @endforeach
            @foreach($child_contentgroups as $contentgroup)
                contentgroups['oc'].push({
                    'id': '{{ $contentgroup->id }}',
                    'content': '{{ $contentgroup->content }}',
                })
            @endforeach
            @foreach($yellowfever_contentgroups as $contentgroup)
                contentgroups['yf'].push({
                    'id': '{{ $contentgroup->id }}',
                    'content': '{{ $contentgroup->content }}',
                })
            @endforeach
            @foreach($specific_contentgroups as $contentgroup)
                contentgroups['sp'].push({
                    'id': '{{ $contentgroup->id }}',
                    'content': '{{ $contentgroup->content }}',
                })
            @endforeach
            @foreach($footer_contentgroups as $contentgroup)
                contentgroups['fo'].push({
                    'id': '{{ $contentgroup->id }}',
                    'content': '{{ $contentgroup->content }}',
                })
            @endforeach

            // additional contents
            $('.add-new-contentadditional').click(function() {
                var total_conadds_count = $('.contentadditional-container').length + 1;

                var contentadditionalsContainer = $(this).closest('.contentadditionals-container');
                var section_conadds_count = contentadditionalsContainer.find('.contentadditional-container').length + 1;
                var parentId = contentadditionalsContainer.attr('id');
                var section = contentadditionalsContainer.data('section');
                var section_id = contentadditionalsContainer.data('section_id');

                var contentadditionalContainer = `
                    <div class="block block-rounded mb-1 contentadditional-container" data-position="${total_conadds_count}" style="background-color: #efefef">
                        <div class="block-header block-header-default">
                            <a data-toggle="collapse" data-parent="#${parentId}" href="#contentadditional-${total_conadds_count}" class="font-w600 collapsed collapse-header">
                                <span class="headline">Additional Content</span>
                            </a>
                            <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                        </div>
                        <div id="contentadditional-${total_conadds_count}" class="collapse collapse-body" role="tabpanel" data-parent="#${parentId}">
                            <div class="block-content">
                                <div class="row mb-4">
                                    <div class="col-8 contentgroups-container">
                `;
                    if (contentgroups[section].length > 0) {
                        contentadditionalContainer += `
                                        <label class="control-label">Content Group</label>
                                        <select class="js-select2 form-control contentgroups"
                                                name="contentgroups[${total_conadds_count}]"
                                                style="width: 100%;">
                                            <option></option>
                                    `;
                        contentgroups[section].forEach(function (contentgroup, index) {
                            contentadditionalContainer += `<option value="${contentgroup['id']}">${contentgroup['content']}</option>`;
                        });
                        contentadditionalContainer += `</select>`;
                    }
                    contentadditionalContainer += `
                                    </div>
                                    <div class="col-4">
                                        <label class="control-label reminder-label" for="reminder-${total_conadds_count}">Remind Date</label>
                                        <input class="js-datepicker form-control form-control-alt reminder"
                                            name="reminders[${total_conadds_count}]" type="text" id="reminder-${total_conadds_count}" data-week-start="1" data-autoclose="true"
                                            data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" maxlength="40"
                                            placeholder="Enter remind date here...">
                                    </div>
                                </div>
                                <div class="js-wizard-simple block block-rounded block-bordered dynamic_container">
                                    <input type="hidden" class="language-section" name="languageSections[${total_conadds_count}]" value="${section}">
                                    <input type="hidden" class="language-section-id" name="languageSectionIds[${total_conadds_count}]" value="${section_id}">
                                    <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                        @foreach($languages as $language)
                                            <li class="nav-item">
                                                <a class="nav-link language-tab-link" href="#language-${total_conadds_count}-{{ $language->id }}" data-toggle="tab" data-lang-id="{{ $language->id }}">{{ $language->content }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                        @foreach($languages as $language)
                                            <div class="tab-pane language-container" id="language-${total_conadds_count}-{{ $language->id }}" data-lang="{{ $language->code }}" data-lang-id="{{ $language->id }}" role="tabpanel">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input language-main"
                                                            id="language_main-${total_conadds_count}-{{ $language->id }}]"
                                                            name="languageMains[${total_conadds_count}][]"
                                                            value="{{ $language->id }}"
                                                        >
                                                        <label class="custom-control-label" for="language_main-${total_conadds_count}-{{ $language->id }}]">Main Language</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Translation Status</label>
                                                    <select class="translatedfrom js-select2 form-control"
                                                            name="translatedfroms[${total_conadds_count}][{{ $language->id }}]"
                                                            style="width: 100%;">
                                                        <option value=0>choose</option>
                                                        @foreach($translation_status as $index => $trans_stat)
                                                            <option value="{{ $index+1 }}">{{ $trans_stat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <label>{{ $language->content }} saved content</label>

                                                <div class="translate-deepl row mb-4">
                                                    <div class="col-6">
                                                        Get content from
                                                        <select class="form-control form-control-alt d-inline-block w-auto source-lang">
                                                            <option value="">choose</option>
                                                            @foreach($languages as $language2)
                                                                <option value="{{ $language2->id }}"
                                                                @if($language2->code == "de")
                                                                    selected="selected"
                                                                @endif
                                                                >{{ $language2->content }}</option>
                                                            @endforeach
                                                        </select>
                                                         tab and
                                                        <button type="button" class="btn btn-sm btn-success mr-1 do-translate-from">
                                                            translate
                                                        </button>
                                                         it to {{ $language->content }}
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-sm btn-success mr-1 mb-3 do-translate-to-all">
                                                            translate this to all
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Headline:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control form-control-alt language-headline"
                                                            name="languageHeadlines[${total_conadds_count}][{{ $language->id }}]"
                                                            maxlength="1000"
                                                            placeholder="Enter Headline here...">
                                                    </div>
                                                </div>
                                                <textarea class="form-control form-control-alt language-content" name="languageContents[${total_conadds_count}][{{ $language->id }}]" rows="15"></textarea>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                contentadditionalContainer = $(contentadditionalContainer);
                contentadditionalContainer.appendTo(contentadditionalsContainer);
                contentadditionalContainer.find('.js-datepicker').datepicker();
                contentadditionalContainer.find('.nav').find('a:first').tab('show');
                contentadditionalContainer.find('.do-translate-from').click(doTranslateFrom);
                contentadditionalContainer.find('.do-translate-to-all').click(doTranslateToAll);
                contentadditionalContainer.find('.delete-contentadditional').click(doDeleteContentadditional);
                contentadditionalContainer.find('.translatedfrom').change(onChangeTranslateStatus);
                contentadditionalContainer.find('.language-main').click(onChangeLanguageMain);

                contentadditionalContainer.closest('.contentadditionals').trigger('sortupdate');
            })

            function doDeleteContentadditional() {
                var contentadditionalsContainer = $(this).closest('.contentadditionals-container');
                var contentadditionalContainer = $(this).closest('.contentadditional-container');
                contentadditionalContainer.remove();

                contentadditionalsContainer.trigger('sortupdate');
            }
            $('.delete-contentadditional').click(doDeleteContentadditional);

            $('.contentadditionals-container').sortable({
                connectWith: $('.contentadditionals-container')
            });
            $('.contentadditionals-container').disableSelection();
            $('.contentadditionals-container').on( 'sortupdate', function( event, ui ) {
                var conadds_count = 0;
                $('.contentadditionals-container').each(function() {
                    var contentadditionalsContainer = $(this);
                    var parentId = contentadditionalsContainer.attr('id');
                    var section = contentadditionalsContainer.data('section');
                    var section_id = contentadditionalsContainer.data('section_id');

                    contentadditionalsContainer.find('.contentadditional-container').each(function(position) {
                        conadds_count ++;
                        position ++;
                        var contentadditionalContainer = $(this);
                        contentadditionalContainer.attr('data-position', conadds_count);

                        contentadditionalContainer.find('.collapse-header')
                            .attr('href', `#contentadditional-${conadds_count}`)
                            .attr('data-parent', `#${parentId}`);
                        contentadditionalContainer.find('.collapse-body')
                            .attr('id', `contentadditional-${conadds_count}`)
                            .attr('data-parent', `#${parentId}`);

                        const oldSection = contentadditionalContainer.find('.language-section').val();
                        if (section != oldSection) {
                            var contentgroupsContainer = contentadditionalContainer.find('.contentgroups-container');
                            newContentgroupsContainer = `<div class="col-8 contentgroups-container">`;
                            if (contentgroups[section].length > 0) {
                                newContentgroupsContainer += `
                                        <label class="control-label">Content Group</label>
                                        <select class="js-select2 form-control contentgroups"
                                                name="contentgroups[${conadds_count}]"
                                                style="width: 100%;">
                                            <option></option>
                                `;
                                contentgroups[section].forEach(function (contentgroup, index) {
                                    newContentgroupsContainer += `<option value="${contentgroup['id']}">${contentgroup['content']}</option>`;
                                });
                                newContentgroupsContainer += `</select>`;
                            }
                            newContentgroupsContainer += `</div>`;
                            contentgroupsContainer.replaceWith($(newContentgroupsContainer));
                        }

                        contentadditionalContainer.find('.contentgroups').attr('name', `contentgroups[${conadds_count}]`);
                        contentadditionalContainer.find('.reminder-label').attr('for', `reminder-[${conadds_count}]`);
                        contentadditionalContainer.find('.reminder')
                            .attr('name', `reminders[${conadds_count}]`)
                            .attr('id', `reminder-${conadds_count}`);

                        contentadditionalContainer.find('.language-section')
                            .attr('name', `languageSections[${conadds_count}]`)
                            .val(section);

                        contentadditionalContainer.find('.language-section-id')
                            .attr('name', `languageSectionIds[${conadds_count}]`)
                            .val(section_id);

                        contentadditionalContainer.find('.language-container').each(function() {
                            var languageContainer = $(this);
                            var langId = languageContainer.data('lang-id');

                            contentadditionalContainer.find(`.language-tab-link[data-lang-id=${langId}]`).attr('href', `#language-${conadds_count}-${langId}`);
                            languageContainer.attr('id', `language-${conadds_count}-${langId}`);

                            languageContainer.find('.language-main')
                                .attr('name', `languageMains[${conadds_count}][]`)
                                .attr('id', `language_main-${conadds_count}-${langId}`)
                                .parent().find('label')
                                .attr('for', `language_main-${conadds_count}-${langId}`);

                            languageContainer.find('.translatedfrom').attr('name', `translatedfroms[${conadds_count}][${langId}]`);
                            languageContainer.find('.language-headline').attr('name', `languageHeadlines[${conadds_count}][${langId}]`);
                            languageContainer.find('.language-content').attr('name',`languageContents[${conadds_count}][${langId}]`);
                        })
                    })
                })
            } );
            $('.contentadditionals-container:first').trigger('sortupdate');

            function onChangeTranslateStatus() {
                var languageContainer = $(this).closest('.language-container');
                let status = $(this).val();
                if (status == 4) {
                    languageContainer.find('.translate-deepl').show();
                } else {
                    languageContainer.find('.translate-deepl').hide();
                }
            }
            $('.translatedfrom').change(onChangeTranslateStatus).trigger('change');

            function onChangeLanguageMain() {
                if ($(this).prop('checked')) {
                    var contentadditionalContainer = $(this).closest('.contentadditional-container');
                    contentadditionalContainer.find('.language-main').prop('checked', false);
                    $(this).prop('checked', true);
                }
            }
            $('.language-main').change(onChangeLanguageMain).trigger('change');

        // multi-language translation
            function translate(position, langSrc, langDst) {
                if (langSrc == langDst) {
                    return;
                }
                var contentadditionalContainer = $(`.contentadditional-container[data-position=${position}]`);
                contentadditionalContainer.find('.dynamic_container').addClass('block-mode-loading');
                var sourceContainer = contentadditionalContainer.find(`.language-container[data-lang=${langSrc}]`);
                var targetContainer = contentadditionalContainer.find(`.language-container[data-lang=${langDst}]`);

                var headline = sourceContainer.find('.language-headline').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.languages.translate") }}',
                    data: {
                        langSrc,
                        langDst,
                        text: headline,
                    },
                    success: function (res){
                        targetContainer.find('.language-headline').val(res.text);
                        $.notify({
                            title: 'Headline',
                            message: `"${headline.substr(0, 9)}..." translate success from ${langSrc} to ${langDst}`
                        },{
                            type: 'success'
                        });
                    },
                    error: function (err) {
                        $.notify({
                            title: 'Headline',
                            message: `"${headline.substr(0, 9)}..." translate error from ${langSrc} to ${langDst} --- ${err.responseJSON.message}`,
                        },{
                            type: 'danger'
                        });
                    },
                });
                var content = sourceContainer.find('.language-content').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.languages.translate") }}',
                    data: {
                        langSrc,
                        langDst,
                        text: content,
                    },
                    success: function (res){
                        targetContainer.find('.language-content').val(res.text);
                        $.notify({
                            title: 'Content',
                            message: `"${content.substr(0, 9)}..." translate success from ${langSrc} to ${langDst}`
                        },{
                            type: 'success'
                        });
                    },
                    error: function (err) {
                        $.notify({
                            title: 'Content',
                            message: `"${content.substr(0, 9)}..." translate error from ${langSrc} to ${langDst} --- ${err.responseJSON.message}`,
                        },{
                            type: 'danger'
                        });
                    },
                    complete: function () {
                        contentadditionalContainer.find('.dynamic_container').removeClass('block-mode-loading');
                    }
                });
            }

            function doTranslateFrom() {
                var contentadditionalContainer = $(this).closest('.contentadditional-container');
                var position = contentadditionalContainer.data('position');
                var targetContainer = $(this).closest('.language-container');
                var sourceLangID = targetContainer.find('.source-lang').val();
                if (sourceLangID.length == 0) {
                    alert('Choose language tab to translate from');
                    return;
                }
                var sourceContainer = $(`#language-${position}-${sourceLangID}`);
                translate(position, sourceContainer.data('lang'), targetContainer.data('lang'));
            }
            $('.do-translate-from').click(doTranslateFrom);

            function doTranslateToAll() {
                var contentadditionalContainer = $(this).closest('.contentadditional-container');
                var position = contentadditionalContainer.data('position');
                var langSrc = $(this).closest('.language-container').data('lang');
                @foreach($languages as $language)
                    translate(position, langSrc, "{{ $language->code }}");
                @endforeach
            }
            $('.do-translate-to-all').click(doTranslateToAll);

        // inoculation preview
            $('.btn-preview').click(function(event) {
                event.preventDefault();
                $('#modalInoculationPreview').modal('show');
            } );

        // country name update
            @if(isset($inoculation))
                $('#countrytocode').change(function() {
                    var countrytocode = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("api.countries.search_by_code") }}',
                        data: {
                            code: countrytocode
                        },
                        success: function(res){
                            $('.country-name').html(' - ' + res.name);
                        },
                        error: function() {
                            $('.country-name').html('');
                        }
                    });
                }).trigger('change');
            @endif
        });
    </script>
@endsection
