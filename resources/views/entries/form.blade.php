<div class="col-sm-10 col-md-3">
    <div class="custom-control custom-block custom-control-success">
        <input type="checkbox" class="custom-control-input" id="active"
               name="active" {{ $errors->has('active') ? 'is-invalid' : '' }}
               value="{{ old('active', optional($entry)->active) }}" {{ old('active', optional($entry)->active == '1' ? 'checked' : '' ) }}>
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
               value="{{ old('importantchange', optional($entry)->importantchange) }}">
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

@if(isset($entry))
    <div class="col-sm-10 col-md-3">
        <div class="custom-control custom-block custom-control-info">
            <input type="checkbox" class="custom-control-input" id="checkedandok"
                name="checkedandok" {{ $errors->has('checkedandok') ? 'is-invalid' : '' }}
                value="{{ old('checkedandok', optional($entry)->checkedandok) }}">
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
                value="{{ old('checkedandnotok', optional($entry)->checkedandnotok) }}">
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
               value="{{ old('countrytocode', optional($entry)->countrytocode) }}" min="0" max="2"
               placeholder="Enter countrytocode here...">
        {!! $errors->first('countrytocode', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Nationalities</h2>
</div>

<div class="col-sm-10 col-md-12">
    <div class="form-group">
        <input class="form-control form-control-alt "
               name="countrytocodelist" type="text" id="countrytocodelist"
               placeholder="Enter list of country codes separated by comma here, if available">
    </div>
</div>

<div class="col-sm-10 col-md-12">
    <div class="form-group">
        <select class="js-select2 form-control" id="nationality_ids"
                name="nationality_ids[]"
                data-placeholder="Choose many.." multiple>
            <option></option>
            <!-- Required for data-placeholder attribute to work with Select2 plugin -->
            @foreach($nationalities as $nationality)
                <option value="{{ $nationality->id }}" data-code="{{ $nationality->code }}"
                    @if ($nationality->selected)
                        selected="selected"
                    @endif
                >{{ $nationality->name_en.($nationality->code?' ('.$nationality->code.')':'') }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-sm-10 col-md-12 mt-4">
    <h2 class="content-heading">Availability</h2>

    <div class="row">
        <div class="col-sm-10 col-md-12">
            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="temp_entry_stop"
                    name="temp_entry_stop"
                    value="{{ old('temp_entry_stop', optional($entry)->temp_entry_stop) }}" {{ optional($entry)->temp_entry_stop ? 'checked' : '' }}>
                <label class="custom-control-label" for="temp_entry_stop">Temporary entry stop</label>
            </div>
        </div>
        <div class="col-sm-10 col-md-12">
            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="no_info_available"
                    name="no_info_available"
                    value="{{ old('no_info_available', optional($entry)->no_info_available) }}" {{ optional($entry)->no_info_available ? 'checked' : '' }}>
                <label class="custom-control-label" for="no_info_available">No Infos available (deactivated)</label>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12">
    <div class="form-group">
        @foreach($entryidentitydocuments as $entryidentitydocument)
            <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="entryidentitydocument-{{ $entryidentitydocument->id }}"
                       name="entryidentitydocuments[]"
                       value="{{ $entryidentitydocument->id }}" {{ $entryidentitydocument->active == '1' ? 'checked' : '' }}>
                <label class="custom-control-label" for="entryidentitydocument-{{ $entryidentitydocument->id }}">{!! $entryidentitydocument->content !!}</label>
            </div>
            <br>
        @endforeach
    </div>
</div>

<div id="entrypassports" class="col-sm-10 col-md-12">
    <h2 class="content-heading">Entry is possible with the following passports</h2>

    @foreach($entrypassports as $entrypassport)
        <div class="form-group entrypassport-container">
            <div class="mb-2" style="margin-top:25px"><h5>{!! $entrypassport->content_en !!}</h5></div>
            <div class="d-flex align-items-center mb-3">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="entrypassport-allow custom-control-input" id="entrypassport-{{ $entrypassport->id }}"
                        name="entrypassports[]"
                        value="{{ $entrypassport->id }}" {{ $entrypassport->active == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="entrypassport-{{ $entrypassport->id }}">allowed</label>
                </div>
                <input class="entrypassport_monthsvalidity form-control form-control-alt d-inline-block"
                    name="entrypassport_monthsvaliditys[{{ $entrypassport->id }}]" type="number" id="entrypassport_monthsvalidity-{{ $entrypassport->id }}"
                    value="{{ $entrypassport->months_validity }}" maxlength="10" min="0"
                    {{ $entrypassport->active == '1' ? '' : 'disabled' }}
                    style="width: 60px;">
                    <span class="ml-1 mr-3">months validity</span>
                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                    <input type="radio" class="passport_period custom-control-input" id="passport_period-{{ $entrypassport->id }}-1"
                            name="passport_periods[{{ $entrypassport->id }}]" value="1"
                            {{ $entrypassport->period == '1' ? 'checked' : '' }}
                            {{ $entrypassport->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="passport_period-{{ $entrypassport->id }}-1">beyond the period of stay</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                    <input type="radio" class="passport_period custom-control-input" id="passport_period-{{ $entrypassport->id }}-2"
                            name="passport_periods[{{ $entrypassport->id }}]" value="2"
                            {{ $entrypassport->period == '2' ? 'checked' : '' }}
                            {{ $entrypassport->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="passport_period-{{ $entrypassport->id }}-2">on arrival</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                    <input type="radio" class="passport_period custom-control-input" id="passport_period-{{ $entrypassport->id }}-3"
                            name="passport_periods[{{ $entrypassport->id }}]" value="3"
                            {{ $entrypassport->period == '3' ? 'checked' : '' }}
                            {{ $entrypassport->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="passport_period-{{ $entrypassport->id }}-3">during the stay</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                    <input type="radio" class="passport_period custom-control-input" id="passport_period-{{ $entrypassport->id }}-4"
                            name="passport_periods[{{ $entrypassport->id }}]" value="4"
                            {{ $entrypassport->period == '4' ? 'checked' : '' }}
                            {{ $entrypassport->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="passport_period-{{ $entrypassport->id }}-4">elapsed</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                    <input type="radio" class="passport_period custom-control-input" id="passport_period-{{ $entrypassport->id }}-5"
                            name="passport_periods[{{ $entrypassport->id }}]" value="5"
                            {{ $entrypassport->period == '5' ? 'checked' : '' }}
                            {{ $entrypassport->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="passport_period-{{ $entrypassport->id }}-5">beyond the period of visa application</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                    <input type="radio" class="passport_period custom-control-input" id="passport_period-{{ $entrypassport->id }}-6"
                            name="passport_periods[{{ $entrypassport->id }}]" value="6"
                            {{ $entrypassport->period == '6' ? 'checked' : '' }}
                            {{ $entrypassport->active == '1' ? '' : 'disabled' }}>
                    <label class="custom-control-label" for="passport_period-{{ $entrypassport->id }}-6">after expiry of the visa</label>
                </div>
            </div>

            <div id="passport{{ $entrypassport->id }}-contentadditionals" class="contentadditionals-container" data-section="pp" data-section_id="{{ $entrypassport->id }}"
                @if($entrypassport->active != '1')
                    style="display: none"
                @endif
            >
                <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
                    add new additional content
                </button>

                @if(isset($entrypassport->contentadditionals))
                    @foreach($entrypassport->contentadditionals as $indexKey => $contentadditional)
                        <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                            <div class="block-header block-header-default">
                                <a data-toggle="collapse" data-parent="#passport{{ $entrypassport->id }}-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                                    <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                </a>
                                <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                            </div>
                            <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#passport{{ $entrypassport->id }}-contentadditionals">
                                <div class="block-content">
                                    <div class="row mb-4">
                                        <div class="col-8 contentgroups-container">
                                        @if(count($passport_contentgroups) > 0)
                                            <label class="control-label">Content Group</label>
                                            <select class="js-select2 form-control contentgroups"
                                                    name="contentgroups[{{ $contentadditional->position }}]"
                                                    style="width: 100%;">
                                                <option></option>
                                                @foreach($passport_contentgroups as $contentgroup)
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
                                        <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="pp">
                                        <input type="hidden" class="language-section-id" name="languageSectionIds[{{ $contentadditional->position }}]" value="{{ $entrypassport->id }}">
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
    @endforeach
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Additional Content between travel documents and Additional informations</h2>
</div>

<div id="afterpassport-contentadditionals" class="contentadditionals-container col-sm-10 col-md-12" data-section="ap">
    <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
        add new additional content
    </button>

    @if(isset($afterpassport_contentadditionals))
        @foreach($afterpassport_contentadditionals as $indexKey => $contentadditional)
            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                <div class="block-header block-header-default">
                    <a data-toggle="collapse" data-parent="#afterpassport-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                    </a>
                    <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                </div>
                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#afterpassport-contentadditionals">
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-8 contentgroups-container">
                            @if(count($afterpassport_contentgroups) > 0)
                                <label class="control-label">Content Group</label>
                                <select class="js-select2 form-control contentgroups"
                                        name="contentgroups[{{ $contentadditional->position }}]"
                                        style="width: 100%;">
                                    <option></option>
                                    @foreach($afterpassport_contentgroups as $contentgroup)
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
                            <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="ap">
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

<div id="entryaddinfos" class="col-sm-10 col-md-12">
    <h2 class="content-heading">Additional information and settings</h2>

    @foreach($entryaddinfos as $entryaddinfo)
        <div class="form-group entryaddinfo-container">
            <div class="d-flex align-items-center mb-2">
                <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                    <input type="checkbox" class="entryaddinfo-allow custom-control-input" id="entryaddinfo-{{ $entryaddinfo->id }}"
                        name="entryaddinfos[]"
                        value="{{ $entryaddinfo->id }}" {{ $entryaddinfo->active == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="entryaddinfo-{{ $entryaddinfo->id }}">{!! $entryaddinfo->content !!}</label>
                </div>
            </div>

            <div id="addinfo{{ $entryaddinfo->id }}-contentadditionals" class="contentadditionals-container" data-section="addin" data-section_id="{{ $entryaddinfo->id }}"
                @if($entryaddinfo->active != '1')
                    style="display: none"
                @endif
            >
                <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
                    add new additional content
                </button>

                @if(isset($entryaddinfo->contentadditionals))
                    @foreach($entryaddinfo->contentadditionals as $indexKey => $contentadditional)
                        <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                            <div class="block-header block-header-default">
                                <a data-toggle="collapse" data-parent="#addinfo{{ $entryaddinfo->id }}-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                                    <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                                </a>
                                <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                            </div>
                            <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#addinfo{{ $entryaddinfo->id }}-contentadditionals">
                                <div class="block-content">
                                    <div class="row mb-4">
                                        <div class="col-8 contentgroups-container">
                                        @if(count($addinfo_contentgroups) > 0)
                                            <label class="control-label">Content Group</label>
                                            <select class="js-select2 form-control contentgroups"
                                                    name="contentgroups[{{ $contentadditional->position }}]"
                                                    style="width: 100%;">
                                                <option></option>
                                                @foreach($addinfo_contentgroups as $contentgroup)
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
                                        <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="addin">
                                        <input type="hidden" class="language-section-id" name="languageSectionIds[{{ $contentadditional->position }}]" value="{{ $entryaddinfo->id }}">
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
    @endforeach
</div>

<div id="afteraddinfo-contentadditionals" class="contentadditionals-container col-sm-10 col-md-12" data-section="aa">
    <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
        add new additional content
    </button>

    @if(isset($afteraddinfo_contentadditionals))
        @foreach($afteraddinfo_contentadditionals as $indexKey => $contentadditional)
            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                <div class="block-header block-header-default">
                    <a data-toggle="collapse" data-parent="#afteraddinfo-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                    </a>
                    <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                </div>
                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#afteraddinfo-contentadditionals">
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-8 contentgroups-container">
                            @if(count($afteraddinfo_contentgroups) > 0)
                                <label class="control-label">Content Group</label>
                                <select class="js-select2 form-control contentgroups"
                                        name="contentgroups[{{ $contentadditional->position }}]"
                                        style="width: 100%;">
                                    <option></option>
                                    @foreach($afteraddinfo_contentgroups as $contentgroup)
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
                            <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="aa">
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

<div id="minor-container" class="col-sm-10 col-md-12">
    <h2 class="content-heading">Minors</h2>

    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
            <input type="checkbox" class="custom-control-input" id="minor" name="minor"
                value="{{ old('minor', optional($entry)->minor) }}" {{ optional($entry)->minor ? 'checked' : '' }}>
            <label class="custom-control-label" for="minor">Special instructions for minors available</label>
        </div>
    </div>

    <div id="entryminors" class="col-sm-10 col-md-12">
        @foreach($entryminors as $entryminor)
            <div class="form-group entryminor-container">
                <div class="d-flex align-items-center mb-2">
                    <div class="custom-control custom-checkbox custom-control-lg custom-control-inline">
                        <input type="checkbox" class="entryminor-allow custom-control-input" id="entryminor-{{ $entryminor->id }}"
                            name="entryminors[]"
                            value="{{ $entryminor->id }}" {{ $entryminor->active == '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="entryminor-{{ $entryminor->id }}">{!! $entryminor->content !!}</label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div id="minor-contentadditionals" class="contentadditionals-container col-sm-10 col-md-12 mt-3" data-section="minor"
     @if(optional($entry)->minor != '1')
     style="display: none"
    @endif
>
    <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
        add new additional content
    </button>

    @if(isset($minor_contentadditionals))
        @foreach($minor_contentadditionals as $indexKey => $contentadditional)
            <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                <div class="block-header block-header-default">
                    <a data-toggle="collapse" data-parent="#minor-contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                        <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                    </a>
                    <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                </div>
                <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#minor-contentadditionals">
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-8 contentgroups-container">
                            @if(count($minor_contentgroups) > 0)
                                <label class="control-label">Content Group</label>
                                <select class="js-select2 form-control contentgroups"
                                        name="contentgroups[{{ $contentadditional->position }}]"
                                        style="width: 100%;">
                                    <option></option>
                                    @foreach($minor_contentgroups as $contentgroup)
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
                            <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="minor">
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

<div class="col-sm-10 col-md-12 mt-4">
    <h2 class="content-heading">Additional Content for footer</h2>
</div>

<div id="footer-contentadditionals" class="contentadditionals-container col-sm-10 col-md-12" data-section="fo" style="margin-top:20px;">
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
               value="{{ old('linkresource', optional($entry)->linkresource) }}" minlength="10" maxlength="1000"
               placeholder="Enter link to resource here...">
        {!! $errors->first('linkresource', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="col-sm-10 col-md-12">
    <div class="form-group {{ $errors->has('textresource') ? 'is-invalid' : '' }}">
        <label for="textresource">Text from resource</label>
        <input class="form-control form-control-alt {{ $errors->has('textresource') ? 'is-invalid' : '' }} "
               name="textresource" type="text" id="textresource"
               value="{{ old('textresource', optional($entry)->textresource) }}" minlength="10" maxlength="1000"
               placeholder="Enter text from resource here...">
        {!! $errors->first('textresource', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

@section('js_form')
    @include('entries.modals.preview')

    <script>
        $(document).ready(function() {
        // Textarea enter key event
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    if (event.target.tagName == 'TEXTAREA') {
                        return;
                    }
                    event.preventDefault();
                    return false;
                }
            });

        // Nationalities multi select
            var arrNats_IdCode = [], arrNats_CodeId = [];
            $('#nationality_ids > option').each((index, nat) => {
                var id = $(nat).val();
                var code = $(nat).data('code');
                arrNats_IdCode[id] = code;
                arrNats_CodeId[code] = id;
            })
            $('#countrytocodelist').change(function() {
                var codestr = $(this).val();
                codestr = codestr.toUpperCase().replace(/\s/g, '');
                $(this).val(codestr);
                var arrCodes = codestr.split(',');
                var arrIds = [];
                arrCodes.forEach(function(code) {
                    var id = arrNats_CodeId[code];
                    if (id != undefined) {
                        arrIds.push(id);
                    }
                });
                $('#nationality_ids').val(arrIds);
                $('#nationality_ids').trigger('change');
            });
            $('#nationality_ids').change(function() {
                var arrIds = $(this).val();
                var arrCodes = [];
                arrIds.forEach(function(id) {
                    var code = arrNats_IdCode[id];
                    arrCodes.push(code);
                });
                var codestr = arrCodes.join(',');
                $('#countrytocodelist').val(codestr);
            }).trigger('change');

        // entry passport, addinfo adsettings
            $('.entrypassport-allow').change(function() {
                var entrypassportContainer = $(this).closest('.entrypassport-container');
                if ($(this).prop('checked')) {
                    entrypassportContainer.find('.entrypassport_monthsvalidity').prop('disabled', false);
                    entrypassportContainer.find('.passport_period').prop('disabled', false);
                    entrypassportContainer.find('.contentadditionals-container').show();
                } else {
                    entrypassportContainer.find('.entrypassport_monthsvalidity').val(0)
                    entrypassportContainer.find('.entrypassport_monthsvalidity').prop('disabled', true);
                    entrypassportContainer.find('.passport_period').prop('disabled', true);
                    entrypassportContainer.find('.contentadditionals-container').hide();
                }
            })

            $('.entryaddinfo-allow').change(function() {
                var entryaddinfoContainer = $(this).closest('.entryaddinfo-container');
                if ($(this).prop('checked')) {
                    entryaddinfoContainer.find('.contentadditionals-container').show();
                } else {
                    entryaddinfoContainer.find('.contentadditionals-container').hide();
                }
            })

            $('#minor').change(function() {
                if ($(this).prop('checked')) {
                    $('#minor-contentadditionals').show();
                } else {
                    $('#minor-contentadditionals').hide();
                }
            })

        var contentgroups = {
            'pp': [],
            'ap': [],
            'addin': [],
            'aa': [],
            'minor': [],
            'fo': [],
        }
        @foreach($passport_contentgroups as $contentgroup)
            contentgroups['pp'].push({
                'id': '{{ $contentgroup->id }}',
                'content': '{{ $contentgroup->content }}',
            })
        @endforeach
        @foreach($afterpassport_contentgroups as $contentgroup)
            contentgroups['ap'].push({
                'id': '{{ $contentgroup->id }}',
                'content': '{{ $contentgroup->content }}',
            })
        @endforeach
        @foreach($addinfo_contentgroups as $contentgroup)
            contentgroups['addin'].push({
                'id': '{{ $contentgroup->id }}',
                'content': '{{ $contentgroup->content }}',
            })
        @endforeach
        @foreach($afteraddinfo_contentgroups as $contentgroup)
            contentgroups['aa'].push({
                'id': '{{ $contentgroup->id }}',
                'content': '{{ $contentgroup->content }}',
            })
        @endforeach
        @foreach($minor_contentgroups as $contentgroup)
            contentgroups['minor'].push({
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

        // entry preview
            $('.btn-preview').click(function(event) {
                event.preventDefault();
                $('#modalEntryPreview').modal('show');
            } );

        // country name update
            @if(isset($entry))
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
