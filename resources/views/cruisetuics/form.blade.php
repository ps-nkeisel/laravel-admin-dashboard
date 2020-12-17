<div class="col-sm-10 col-md-3">
    <div class="custom-control custom-block custom-control-success">
        <input type="checkbox" class="custom-control-input" id="active"
               name="active" {{ $errors->has('active') ? 'is-invalid' : '' }}
               value="{{ old('active', optional($cruisetuic)->active) }}" {{ old('active', optional($cruisetuic)->active == '1' ? 'checked' : '' ) }}>
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
               value="{{ old('importantchange', optional($cruisetuic)->importantchange) }}" {{ old('importantchange', optional($cruisetuic)->importantchange == '1' ? 'checked' : '' ) }}>
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

@if(isset($cruisetuic))
    <div class="col-sm-10 col-md-3">
        <div class="custom-control custom-block custom-control-info">
            <input type="checkbox" class="custom-control-input" id="checkedandok"
                name="checkedandok" {{ $errors->has('checkedandok') ? 'is-invalid' : '' }}
                value="{{ old('checkedandok', optional($cruisetuic)->checkedandok) }}" {{ old('checkedandok', optional($cruisetuic)->checkedandok == '1' ? 'checked' : '' ) }}>
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
                value="{{ old('checkedandnotok', optional($cruisetuic)->checkedandnotok) }}" {{ old('checkedandnotok', optional($cruisetuic)->checkedandnotok == '1' ? 'checked' : '' ) }}>
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

<div class="col-sm-10 col-md-12">

<div class="row">

    <div class="col-sm-12">
        <input class="form-control" name="sccode" type="hidden" id="sccode" value="TUIC">
        <input class="form-control" name="scname" type="hidden" id="scname" value="TUI Cruises">

        <div class="col-sm-10 col-md-12" style="margin-top:20px;">
            <h2 class="content-heading">Destination</h2>
        </div>

        <div class="col-sm-10 col-md-12">
            <div class="form-group {{ $errors->has('countrytocode') ? 'is-invalid' : '' }}">
                <input class="form-control form-control-alt {{ $errors->has('countrytocode') ? 'is-invalid' : '' }} "
                    name="countrytocode" type="text" id="countrytocode"
                    value="{{ old('countrytocode', optional($cruisetuic)->countrytocode) }}" min="0" max="2"
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
                    placeholder="add comma separated nationalities without spaces...">
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

    </div>

</div>

@if(isset($contentgroups))
    @foreach($contentgroups as $contentgroup)
        <div class="col-sm-10 col-md-12 mt-4">
            <h2 class="content-heading">{{ $contentgroup->content }}</h2>
        </div>

        <div id="contentgroup-{{ $contentgroup->id }}" class="contentadditionals-container col-sm-10 col-md-12" data-section="" data-contentgroup="{{ $contentgroup->id }}" style="margin-top:20px;">
            <button type="button" class="btn btn-sm btn-success ml-0 mb-3 add-new-contentadditional">
                add new additional content
            </button>

            @if(isset($contentgroup->contentadditionals))
                @foreach($contentgroup->contentadditionals as $indexKey => $contentadditional)
                    <div class="block block-rounded mb-1 contentadditional-container" data-position="{{ $contentadditional->position }}" style="background-color: #efefef">
                        <div class="block-header block-header-default">
                            <a data-toggle="collapse" data-parent="#contentgroup-{{ $contentgroup->id }}" href="#contentadditional-{{ $contentadditional->position }}" class="font-w600 collapsed collapse-header">
                                <span class="headline">{{ $contentadditional->headline ? $contentadditional->headline : 'Additional Content' }}</span>
                            </a>
                            <span class="float-right delete-contentadditional"><i class="fa fa-times"></i></span>
                        </div>
                        <div id="contentadditional-{{ $contentadditional->position }}" class="collapse collapse-body" role="tabpanel" data-parent="#contentgroup-{{ $contentgroup->id }}">
                            <div class="block-content">
                                <input type="hidden" class="contentgroup-id" name="contentgroups[{{ $contentadditional->position }}]" value="{{ $contentgroup->id }}">
                                <div class="row mb-4">
                                    <div class="col-8 contentgroups-container">
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
@endif

</div>

@section('js_form')
    @include('cruisetuics.modals.preview')

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

        // additional contents
            $('.add-new-contentadditional').click(function() {
                var total_conadds_count = $('.contentadditional-container').length + 1;

                var contentadditionalsContainer = $(this).closest('.contentadditionals-container');
                var contentgroup_conadds_count = contentadditionalsContainer.find('.contentadditional-container').length + 1;
                var parentId = contentadditionalsContainer.attr('id');
                var contentgroup_id = contentadditionalsContainer.data('contentgroup');

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
                                <input type="hidden" class="contentgroup-id" name="contentgroups[${total_conadds_count}]" value="${contentgroup_id}">
                                <div class="row mb-4">
                                    <div class="col-8 contentgroups-container">
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

        // cruisetuic preview
            $('.btn-preview').click(function(event) {
                event.preventDefault();
                $('#modalCruisetuicPreview').modal('show');
            } );
        });
    </script>
@endsection
