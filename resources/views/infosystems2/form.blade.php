<div class="col-sm-10 col-md-12">
    <div class="form-group {{ $errors->has('country') ? 'is-invalid' : '' }}">
        <label for="content">Country</label>
        <input class="form-control form-control-alt {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country"
               type="text" id="country" value="{{ old('country', optional($infosystem2)->country) }}" maxlength="40"
               placeholder="Enter country code here...">
        {!! $errors->first('country', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('nat') ? 'is-invalid' : '' }}">
        <label for="content">Nationality</label>
        <input class="form-control form-control-alt {{ $errors->has('nat') ? 'is-invalid' : '' }}" name="nat"
               type="text" id="nat" value="{{ old('nat', optional($infosystem2)->nat) }}" maxlength="40"
               placeholder="Enter nationality here...">
        {!! $errors->first('nat', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="col-sm-12 col-md-4" style="margin-top:20px;">
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="info1" class="custom-control-input {{ $errors->has('info1') ? 'is-invalid' : '' }}"
                   name="info1" type="checkbox"
                   value="1" {{ old('info1', optional($infosystem2)->info1) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="info1">show into Infosystem</label>
            {!! $errors->first('info1', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="info2" class="custom-control-input {{ $errors->has('info2') ? 'is-invalid' : '' }}"
                   name="info2" type="checkbox"
                   value="1" {{ old('info2', optional($infosystem2)->info2) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="info2">show into Corona Info</label>
            {!! $errors->first('info2', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="info3" class="custom-control-input {{ $errors->has('info3') ? 'is-invalid' : '' }}"
                   name="info3" type="checkbox"
                   value="1" {{ old('info3', optional($infosystem2)->info3) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="info3">show into Infosystem 3</label>
            {!! $errors->first('info3', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="info4" class="custom-control-input {{ $errors->has('info4') ? 'is-invalid' : '' }}"
                   name="info4" type="checkbox"
                   value="1" {{ old('info4', optional($infosystem2)->info4) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="info4">show into Infosystem 4</label>
            {!! $errors->first('info4', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-4" style="margin-top:20px;">
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="entry" class="custom-control-input {{ $errors->has('entry') ? 'is-invalid' : '' }}"
                   name="entry" type="checkbox"
                   value="1" {{ old('entry', optional($infosystem2)->entry) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="entry">show behind Entry</label>
            {!! $errors->first('entry', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="visa" class="custom-control-input {{ $errors->has('visa') ? 'is-invalid' : '' }}"
                   name="visa" type="checkbox"
                   value="1" {{ old('visa', optional($infosystem2)->visa) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="visa">show behind Visa</label>
            {!! $errors->first('visa', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="transitvisa" class="custom-control-input {{ $errors->has('transitvisa') ? 'is-invalid' : '' }}"
                   name="transitvisa" type="checkbox"
                   value="1" {{ old('transitvisa', optional($infosystem2)->transitvisa) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="transitvisa">show behind Transitvisa</label>
            {!! $errors->first('transitvisa', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="health" class="custom-control-input {{ $errors->has('health') ? 'is-invalid' : '' }}"
                   name="health" type="checkbox"
                   value="1" {{ old('health', optional($infosystem2)->health) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="health">show behind Health</label>
            {!! $errors->first('health', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="cruise" class="custom-control-input {{ $errors->has('cruise') ? 'is-invalid' : '' }}"
                   name="cruise" type="checkbox"
                   value="1" {{ old('cruise', optional($infosystem2)->cruise) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="cruise">show behind Cruise</label>
            {!! $errors->first('cruise', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-4" style="margin-top:20px;">
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="corona" class="custom-control-input {{ $errors->has('corona') ? 'is-invalid' : '' }}"
                   name="corona" type="checkbox"
                   value="1" {{ old('corona', optional($infosystem2)->corona) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="corona">is Corona info</label>
            {!! $errors->first('corona', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12">
    <h2 class="content-heading">Translation</h2>
    <div class="block-content">
        <div class="js-wizard-simple block block-rounded block-bordered dynamic_container">
            <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                @foreach($languages as $language)
                    <li class="nav-item">
                        <a class="nav-link language-tab-link" href="#language-{{ $language->id }}" data-toggle="tab" data-lang-id="{{ $language->id }}">{{ $language->content }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                @foreach($languages as $language)
                    <div class="tab-pane language-container" id="language-{{ $language->id }}" data-lang="{{ $language->code }}" data-lang-id="{{ $language->id }}" role="tabpanel">
                        @php
                            $languageContent = $infosystem2 ? $infosystem2->languages->where('code', $language->code)->first() : null;
                        @endphp

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
                                        name="languageHeadlines[{{ $language->id }}]"
                                        value="{{ old('headline', optional(optional($languageContent)->pivot)->headline) }}" maxlength="1000"
                                        placeholder="Enter Headline here...">
                            </div>
                        </div>
                        <textarea class="form-control form-control-alt language-content" name="languageContents[{{ $language->id }}]" rows="15">{{ old('content', optional(optional($languageContent)->pivot)->content) }}</textarea>

                        <p>languageables: [{{ optional(optional($languageContent)->pivot)->id }}]</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-6">

    <div class="form-group {{ $errors->has('appearance') ? 'is-invalid' : '' }}">
        <label for="appearance">Display color</label>
        <select class="form-control form-control-alt {{ $errors->has('appearance') ? 'is-invalid' : '' }}"
                id="appearance" name="appearance">
            <option value="">choose</option>
            @foreach($appearance as $key => $value)
                <option value="{{ $key }}" @if(isset($infosystem2->appearance))
                        @if ($key == old('appearance', $infosystem2->appearance))
                        selected="selected"
                        @endif
                        @endif
                >{{ $value }}</option>
            @endforeach
        </select>
        {!! $errors->first('appearance', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('tagtype') ? 'is-invalid' : '' }}">
        <label for="tagtype">Display type</label>
        <select class="form-control form-control-alt {{ $errors->has('tagtype') ? 'is-invalid' : '' }}" id="tagtype"
                name="tagtype">
            <option value="">choose</option>
            @foreach($color as $key => $value)
                <option value="{{ $key }}" @if(isset($infosystem2->tagtype))
                        @if ($key == old('tagtype', $infosystem2->tagtype))
                        selected="selected"
                        @endif
                    @endif
                >{{ $value }}</option>
            @endforeach
        </select>
        {!! $errors->first('tagtype', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('tagdate') ? 'is-invalid' : '' }}">
        <label for="tagdate">Date</label>
        <input class="js-datepicker form-control form-control-alt {{ $errors->has('tagdate') ? 'is-invalid' : '' }}"
               name="tagdate" type="text" id="tagdate" data-week-start="1" data-autoclose="true"
               data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
               value="{{ old('tagdate', optional($infosystem2)->tagdate) }}" maxlength="40"
               placeholder="Enter tagdate here...">
        {!! $errors->first('tagdate', '<p class="invalid-feedback">:message</p>') !!}
    </div>

</div>

<div class="col-sm-10 col-md-6">
    <div class="form-group {{ $errors->has('position') ? 'is-invalid' : '' }}">
        <label for="position">Position</label>
        <input class="form-control form-control-alt {{ $errors->has('position') ? 'is-invalid' : '' }}" name="position"
               type="number" id="position" value="{{ old('position', optional($infosystem2)->position) }}" min="1"
               max="2147483647" placeholder="Enter position here...">
        {!! $errors->first('position', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <br>

    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="archive" class="custom-control-input {{ $errors->has('archive') ? 'is-invalid' : '' }}"
                   name="archive" type="checkbox"
                   value="1" {{ old('archive', optional($infosystem2)->archive) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="archive">Archive</label>
            {!! $errors->first('archive', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="active" class="custom-control-input {{ $errors->has('active') ? 'is-invalid' : '' }}"
                   name="active" type="checkbox"
                   value="1" {{ old('archive', optional($infosystem2)->active) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="active">Activate</label>
            {!! $errors->first('active', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

@section('js_form')
    <script>
        $(document).ready(function() {
        // multi-language translation
            function translate(langSrc, langDst) {
                if (langSrc == langDst) {
                    return;
                }
                $('.dynamic_container').addClass('block-mode-loading');
                var sourceContainer = $(`.language-container[data-lang=${langSrc}]`);
                var targetContainer = $(`.language-container[data-lang=${langDst}]`);

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
                        $('.dynamic_container').removeClass('block-mode-loading');
                    }
                });
            }

            function doTranslateFrom() {
                var targetContainer = $(this).closest('.language-container');
                var sourceLangID = targetContainer.find('.source-lang').val();
                if (sourceLangID.length == 0) {
                    alert('Choose language tab to translate from');
                    return;
                }
                var sourceContainer = $(`#language-${sourceLangID}`);
                translate(sourceContainer.data('lang'), targetContainer.data('lang'));
            }
            $('.do-translate-from').click(doTranslateFrom);

            function doTranslateToAll() {
                var langSrc = $(this).closest('.language-container').data('lang');
                @foreach($languages as $language)
                    translate(langSrc, "{{ $language->code }}");
                @endforeach
            }
            $('.do-translate-to-all').click(doTranslateToAll);
        });
    </script>
@endsection
