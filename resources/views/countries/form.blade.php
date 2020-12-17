<div class="col-sm-10 col-md-3 mb-5">
    <div class="custom-control custom-block custom-control-success">
        <input type="checkbox" class="custom-control-input" id="active"
            name="active" {{ $errors->has('active') ? 'is-invalid' : '' }}
            value="{{ old('active', optional($country)->active) }}" {{ old('active', optional($country)->active == '1' ? 'checked' : '' ) }}>
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

<div class="col-sm-10 col-md-12">
<div class="row">

    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('code') ? 'is-invalid' : '' }}">
            <label for="code">Code</label>
            <input class="form-control form-control-alt {{ $errors->has('code') ? 'is-invalid' : '' }} " name="code"
                type="text" id="code" value="{{ old('code', optional($country)->code) }}" maxlength="2"
                placeholder="Enter code here...">
            {!! $errors->first('code', '<p class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('name') ? 'is-invalid' : '' }}">
            <label for="name">Name</label>
            <input class="form-control form-control-alt {{ $errors->has('name') ? 'is-invalid' : '' }} " name="name"
                type="text" id="name" value="{{ old('name', optional($country)->name) }}" maxlength="150"
                placeholder="Enter name here...">
            {!! $errors->first('name', '<p class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('name_local') ? 'is-invalid' : '' }}">
            <label for="name_local">Name Local</label>
            <input class="form-control form-control-alt {{ $errors->has('name_local') ? 'is-invalid' : '' }} "
                name="name_local" type="text" id="name_local"
                value="{{ old('name_local', optional($country)->name_local) }}" maxlength="150"
                placeholder="Enter name local here...">
            {!! $errors->first('name_local', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_en') ? 'is-invalid' : '' }}">
            <label for="name_en">Name En</label>
            <input class="form-control form-control-alt {{ $errors->has('name_en') ? 'is-invalid' : '' }} " name="name_en"
                type="text" id="name_en" value="{{ old('name_en', optional($country)->name_en) }}" maxlength="150"
                placeholder="Enter name en here...">
            {!! $errors->first('name_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_fr') ? 'is-invalid' : '' }}">
            <label for="name_fr">Name Fr</label>
            <input class="form-control form-control-alt {{ $errors->has('name_fr') ? 'is-invalid' : '' }} " name="name_fr"
                type="text" id="name_fr" value="{{ old('name_fr', optional($country)->name_fr) }}" maxlength="150"
                placeholder="Enter name fr here...">
            {!! $errors->first('name_fr', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_it') ? 'is-invalid' : '' }}">
            <label for="name_it">Name It</label>
            <input class="form-control form-control-alt {{ $errors->has('name_it') ? 'is-invalid' : '' }} " name="name_it"
                type="text" id="name_it" value="{{ old('name_it', optional($country)->name_it) }}" maxlength="150"
                placeholder="Enter name it here...">
            {!! $errors->first('name_it', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_nl') ? 'is-invalid' : '' }}">
            <label for="name_nl">Name Nl</label>
            <input class="form-control form-control-alt {{ $errors->has('name_nl') ? 'is-invalid' : '' }} " name="name_nl"
                type="text" id="name_nl" value="{{ old('name_nl', optional($country)->name_nl) }}" maxlength="150"
                placeholder="Enter name nl here...">
            {!! $errors->first('name_nl', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_pl') ? 'is-invalid' : '' }}">
            <label for="name_pl">Name Pl</label>
            <input class="form-control form-control-alt {{ $errors->has('name_pl') ? 'is-invalid' : '' }} " name="name_pl"
                type="text" id="name_pl" value="{{ old('name_pl', optional($country)->name_pl) }}" maxlength="150"
                placeholder="Enter name pl here...">
            {!! $errors->first('name_pl', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_es') ? 'is-invalid' : '' }}">
            <label for="name_es">Name Es</label>
            <input class="form-control form-control-alt {{ $errors->has('name_es') ? 'is-invalid' : '' }} " name="name_es"
                type="text" id="name_es" value="{{ old('name_es', optional($country)->name_es) }}" maxlength="150"
                placeholder="Enter name es here...">
            {!! $errors->first('name_es', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_pt') ? 'is-invalid' : '' }}">
            <label for="name_pt">Name Pt</label>
            <input class="form-control form-control-alt {{ $errors->has('name_pt') ? 'is-invalid' : '' }} " name="name_pt"
                type="text" id="name_pt" value="{{ old('name_pt', optional($country)->name_pt) }}" maxlength="150"
                placeholder="Enter name pt here...">
            {!! $errors->first('name_pt', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_ru') ? 'is-invalid' : '' }}">
            <label for="name_ru">Name Ru</label>
            <input class="form-control form-control-alt {{ $errors->has('name_ru') ? 'is-invalid' : '' }} " name="name_ru"
                type="text" id="name_ru" value="{{ old('name_ru', optional($country)->name_ru) }}" maxlength="150"
                placeholder="Enter name ru here...">
            {!! $errors->first('name_ru', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('url1') ? 'is-invalid' : '' }}">
            <label for="url1">Url1</label>
            <input class="form-control form-control-alt {{ $errors->has('url1') ? 'is-invalid' : '' }} " name="url1"
                type="text" id="url1" value="{{ old('url1', optional($country)->url1) }}" maxlength="255"
                placeholder="Enter url1 here...">
            {!! $errors->first('url1', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('prio') ? 'is-invalid' : '' }}">
            <label for="prio">Prio</label>
            <input class="form-control form-control-alt {{ $errors->has('prio') ? 'is-invalid' : '' }} " name="prio"
                type="number" id="prio" value="{{ old('prio', optional($country)->prio) }}"
                placeholder="Enter prio here...">
            {!! $errors->first('prio', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('google_static_map_code') ? 'is-invalid' : '' }}">
            <label for="google_static_map_code">Google Static Map Code</label>
            <textarea id="google_static_map_code" class="form-control form-control-alt {{ $errors->has('google_static_map_code') ? 'is-invalid' : '' }}" name="google_static_map_code" rows="6" placeholder="Enter map code here...">{{ old('google_static_map_code', optional($country)->google_static_map_code) }}</textarea>
            {!! $errors->first('google_static_map_code', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>

    <div class="col-sm-6">

        <div class="form-group {{ $errors->has('continent') ? 'is-invalid' : '' }}">
            <label for="continent">Continent</label>
            <input class="form-control form-control-alt {{ $errors->has('continent') ? 'is-invalid' : '' }} "
                name="continent" type="text" id="continent" value="{{ old('continent', optional($country)->continent) }}"
                maxlength="50" placeholder="Enter continent here...">
            {!! $errors->first('continent', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('capital') ? 'is-invalid' : '' }}">
            <label for="capital">Capital</label>
            <input class="form-control form-control-alt {{ $errors->has('capital') ? 'is-invalid' : '' }} " name="capital"
                type="text" id="capital" value="{{ old('capital', optional($country)->capital) }}" maxlength="50"
                placeholder="Enter capital here...">
            {!! $errors->first('capital', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('population') ? 'is-invalid' : '' }}">
            <label for="population">Population</label>
            <input class="form-control form-control-alt {{ $errors->has('population') ? 'is-invalid' : '' }} "
                name="population" type="text" id="population"
                value="{{ old('population', optional($country)->population) }}" maxlength="20"
                placeholder="Enter population here...">
            {!! $errors->first('population', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('area') ? 'is-invalid' : '' }}">
            <label for="area">Area</label>
            <input class="form-control form-control-alt {{ $errors->has('area') ? 'is-invalid' : '' }} " name="area"
                type="text" id="area" value="{{ old('area', optional($country)->area) }}" maxlength="20"
                placeholder="Enter area here...">
            {!! $errors->first('area', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('coastline') ? 'is-invalid' : '' }}">
            <label for="coastline">Coastline</label>
            <input class="form-control form-control-alt {{ $errors->has('coastline') ? 'is-invalid' : '' }} "
                name="coastline" type="text" id="coastline" value="{{ old('coastline', optional($country)->coastline) }}"
                maxlength="10" placeholder="Enter coastline here...">
            {!! $errors->first('coastline', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('governmentform') ? 'is-invalid' : '' }}">
            <label for="governmentform">Governmentform</label>
            <input class="form-control form-control-alt {{ $errors->has('governmentform') ? 'is-invalid' : '' }} "
                name="governmentform" type="text" id="governmentform"
                value="{{ old('governmentform', optional($country)->governmentform) }}" maxlength="200"
                placeholder="Enter governmentform here...">
            {!! $errors->first('governmentform', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('currency') ? 'is-invalid' : '' }}">
            <label for="currency">Currency</label>
            <input class="form-control form-control-alt {{ $errors->has('currency') ? 'is-invalid' : '' }} " name="currency"
                type="text" id="currency" value="{{ old('currency', optional($country)->currency) }}" maxlength="10"
                placeholder="Enter currency here...">
            {!! $errors->first('currency', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('currencycode') ? 'is-invalid' : '' }}">
            <label for="currencycode">Currencycode</label>
            <input class="form-control form-control-alt {{ $errors->has('currencycode') ? 'is-invalid' : '' }} "
                name="currencycode" type="text" id="currencycode"
                value="{{ old('currencycode', optional($country)->currencycode) }}" maxlength="10"
                placeholder="Enter currencycode here...">
            {!! $errors->first('currencycode', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('dialingprefix') ? 'is-invalid' : '' }}">
            <label for="dialingprefix">Dialingprefix</label>
            <input class="form-control form-control-alt {{ $errors->has('dialingprefix') ? 'is-invalid' : '' }} "
                name="dialingprefix" type="text" id="dialingprefix"
                value="{{ old('dialingprefix', optional($country)->dialingprefix) }}" maxlength="10"
                placeholder="Enter dialingprefix here...">
            {!! $errors->first('dialingprefix', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('birthrate') ? 'is-invalid' : '' }}">
            <label for="birthrate">Birthrate</label>
            <input class="form-control form-control-alt {{ $errors->has('birthrate') ? 'is-invalid' : '' }} "
                name="birthrate" type="text" id="birthrate" value="{{ old('birthrate', optional($country)->birthrate) }}"
                maxlength="10" placeholder="Enter birthrate here...">
            {!! $errors->first('birthrate', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('deathrate') ? 'is-invalid' : '' }}">
            <label for="deathrate">Deathrate</label>
            <input class="form-control form-control-alt {{ $errors->has('deathrate') ? 'is-invalid' : '' }} "
                name="deathrate" type="text" id="deathrate" value="{{ old('deathrate', optional($country)->deathrate) }}"
                maxlength="10" placeholder="Enter deathrate here...">
            {!! $errors->first('deathrate', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('lifeexpectancy') ? 'is-invalid' : '' }}">
            <label for="lifeexpectancy">Lifeexpectancy</label>
            <input class="form-control form-control-alt {{ $errors->has('lifeexpectancy') ? 'is-invalid' : '' }} "
                name="lifeexpectancy" type="text" id="lifeexpectancy"
                value="{{ old('lifeexpectancy', optional($country)->lifeexpectancy) }}" maxlength="10"
                placeholder="Enter lifeexpectancy here...">
            {!! $errors->first('lifeexpectancy', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('transitvisatext') ? 'is-invalid' : '' }}">
            <label for="transitvisatext">Transitvisatext</label>
            <input class="form-control form-control-alt {{ $errors->has('transitvisatext') ? 'is-invalid' : '' }} "
                name="transitvisatext" type="text" id="transitvisatext"
                value="{{ old('transitvisatext', optional($country)->transitvisatext) }}" maxlength="4294967295"
                placeholder="Enter transitvisatext here...">
            {!! $errors->first('transitvisatext', '<p class="invalid-feedback">:message</p>') !!}
        </div>


        <div class="form-group {{ $errors->has('transitvisa') ? 'is-invalid' : '' }}">
            <label for="transitvisa">Transitvisa</label>
            <input class="form-control form-control-alt {{ $errors->has('transitvisa') ? 'is-invalid' : '' }} "
                name="transitvisa" type="text" id="transitvisa"
                value="{{ old('transitvisa', optional($country)->transitvisa) }}" maxlength="4294967295"
                placeholder="Enter transitvisa here...">
            {!! $errors->first('transitvisa', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>

</div>
</div>

@foreach($contentadditionalSections as $key => $contentadditionalSection)
    <div class="col-sm-10 col-md-12" style="margin-top:20px;">
        <h2 class="content-heading">{{ $contentadditionalSection['label'] }}</h2>
    </div>
    <div id="{{ $key }}_contentadditionals" class="contentadditionals-container col-sm-10 col-md-12 p-3" data-section="{{ $contentadditionalSection['section'] }}" data-section_id="0" style="min-height:20px;">
        <button type="button" class="btn btn-sm btn-success ml-3 mb-3 add-new-contentadditional">
            add new additional content
        </button>

        @if(isset($contentadditionalSection['contentadditionals']))
            @foreach($contentadditionalSection['contentadditionals'] as $indexKey => $contentadditional)
                <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                    <div class="block-header block-header-default">
                        <a data-toggle="collapse" data-parent="#powerconnector_contentadditionals" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                            <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                        </a>
                        <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                    </div>
                    <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#powerconnector_contentadditionals">
                        <div class="block-content">
                            <div class="row mb-4">
                                <div class="col-8 contentgroups-container">
                                    @if(count($contentadditionalSection['contentgroups']) > 0)
                                        <label class="control-label">Content Group</label>
                                        <select class="js-select2 form-control contentgroups"
                                                name="contentgroups[{{ $contentadditionalSection['contentgroups'] }}]"
                                                style="width: 100%;">
                                            <option></option>
                                            @foreach($contentadditionalSection['contentgroups'] as $contentgroup)
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
                                <input type="hidden" class="language-section" name="languageSections[{{ $contentadditional->position }}]" value="{{ $contentadditionalSection['section'] }}">
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
@endforeach



@section('js_form')
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

        // additional contents
        @foreach($contentadditionalSections as $key => $contentadditionalSection)
            @php
                $section = $contentadditionalSection['section'];
                $coarr[$section] = array();
            @endphp
        @endforeach

        var contentgroups = @json($coarr)

        @foreach($contentadditionalSections as $key => $contentadditionalSection)
            @foreach($contentadditionalSection['contentgroups'] as $contentgroup)
                contentgroups[$contentadditionalSection['section']].push({
                    'id': '{{ $contentgroup->id }}',
                    'content': '{{ $contentgroup->content }}'
                })
            @endforeach
        @endforeach

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
        });
    </script>
@endsection
