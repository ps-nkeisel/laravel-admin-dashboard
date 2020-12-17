<div class="col-sm-10 col-md-12">

    <div class="form-group {{ $errors->has('position') ? 'is-invalid' : '' }}">
        <label for="position">Position</label>
        <input class="form-control form-control-alt col-4 {{ $errors->has('position') ? 'is-invalid' : '' }} "
               name="position"
               type="number" id="position" value="{{ old('position', optional($visadocument)->position) }}" min="0"
               max="4294967295" placeholder="Enter position here...">
        {!! $errors->first('position', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('content') ? 'is-invalid' : '' }}">
        <label for="tagtext">Content</label>
        <input class="form-control form-control-alt {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"
               type="text" id="content" value="{{ old('content', optional($visadocument)->content) }}" maxlength="40"
               placeholder="Enter content here...">
        {!! $errors->first('content', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('contentcode') ? 'is-invalid' : '' }}">
        <label for="tagtext">Content Code</label>
        <input class="form-control form-control-alt {{ $errors->has('contentcode') ? 'is-invalid' : '' }}" name="contentcode"
               type="text" id="contentcode" value="{{ old('contentcode', optional($visadocument)->contentcode) }}" maxlength="5"
               placeholder="Enter contentcode here...">
        {!! $errors->first('contentcode', '<p class="invalid-feedback">:message</p>') !!}
    </div>

</div>

<div class="col-sm-10 col-md-12">
    <h2 class="content-heading">Translation</h2>
    <div class="js-wizard-simple block block block-rounded block-bordered dynamic_container">
        <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
            @foreach($languages as $language)
                <li class="nav-item">
                    <a class="nav-link language-tab-link" href="#language-{{ $language->id }}" data-toggle="tab">{{ $language->content }}</a>
                </li>
            @endforeach
        </ul>
        <div class="block-content block-content-full tab-content" style="min-height: 290px;">
            @foreach($languages as $language)
                <div class="tab-pane language-container" id="language-{{ $language->id }}" data-lang="{{ $language->code }}" role="tabpanel">
                    <label for="language-{{ $language->id }}">{{ $language->content }} saved content</label>
                    <p>{{ $language->languageContent }}</p>

                    <div class="row" style="margin-bottom:30px;">
                        <div class="col-6">
                            Get content from
                            <select class="form-control form-control-alt source-lang" style="display:inline-block; width:auto;">
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

                    <div class="form-group">
                        <textarea class="form-control form-control-alt language-text" name="languageContents[{{ $language->id }}]" rows="15">{{ $language->languageContent }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@section('js_form')
    <script>
        $(document).ready(function() {
            function translate(langSrc, langDst) {
                if (langSrc == langDst) {
                    return;
                }
                $('.dynamic_container').addClass('block-mode-loading');
                var sourceContainer = $('.language-container[data-lang=' + langSrc + ']');
                var targetContainer = $('.language-container[data-lang=' + langDst + ']');
                var text = sourceContainer.find('.language-text').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("api.languages.translate") }}',
                    data: {
                        langSrc,
                        langDst,
                        text,
                    },
                    success: function (res){
                        targetContainer.find('.language-text').val(res.text);
                    },
                    complete: function () {
                        $('.dynamic_container').removeClass('block-mode-loading');
                    }
                });
            }

            $('.do-translate-from').click(function () {
                var targetContainer = $(this).closest('.language-container');
                var sourceLangID = targetContainer.find('.source-lang').val();
                if (sourceLangID.length == 0) {
                    alert('Choose language tab to translate from');
                    return;
                }
                var sourceContainer = $('#language-' + sourceLangID);
                translate(sourceContainer.data('lang'), targetContainer.data('lang'));
            });

            $('.do-translate-to-all').click(function () {
                var langSrc = $(this).closest('.language-container').data('lang');
                @foreach($languages as $language)
                    translate(langSrc, "{{ $language->code }}");
                @endforeach
            });

            @php
                $languageContent = $languages->where('code', 'en')->first();
            @endphp
            @if($languageContent)
                $('textarea[name="languageContents[{{ $languageContent->id }}]"]').change(function() {
                    $('#content').val($(this).val());
                })
            @endif
        });
    </script>
@endsection
