<div class="col-sm-10 col-md-12">

    <div class="form-group {{ $errors->has('position') ? 'is-invalid' : '' }}">
        <label for="position">Position</label>
        <input class="form-control form-control-alt col-4 {{ $errors->has('position') ? 'is-invalid' : '' }} " name="position"
               type="number" id="position" value="{{ old('position', optional($inooptionchild)->position) }}" min="0"
               max="4294967295" placeholder="Enter position here...">
        {!! $errors->first('position', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('content') ? 'is-invalid' : '' }}">
        <label for="content">Content</label>
        <input class="form-control form-control-alt {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"
               type="text" id="content" value="{{ old('content', optional($inooptionchild)->content) }}" maxlength="40"
               placeholder="Enter content here...">
        {!! $errors->first('content', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('contentcode') ? 'is-invalid' : '' }}">
        <label for="tagtext">Content Code</label>
        <input class="form-control form-control-alt {{ $errors->has('contentcode') ? 'is-invalid' : '' }}" name="contentcode"
               type="text" id="contentcode" value="{{ old('contentcode', optional($inooptionchild)->contentcode) }}" maxlength="5"
               placeholder="Enter contentcode here...">
        {!! $errors->first('contentcode', '<p class="invalid-feedback">:message</p>') !!}
    </div>

</div>

<div class="col-sm-10 col-md-12">
    <h2 class="content-heading">Translation</h2>
    <div class="js-wizard-simple block block block-rounded block-bordered">
        <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
            @foreach($languages as $language)
                <li class="nav-item">
                    <a class="nav-link language-tab-link" href="#language-{{ $language->id }}" data-toggle="tab">{{ $language->content }}</a>
                </li>
            @endforeach
        </ul>
        <div class="block-content block-content-full tab-content" style="min-height: 290px;">
            @foreach($languages as $language)
                <div class="tab-pane" id="language-{{ $language->id }}" role="tabpanel">
                    <div class="form-group">
                        <label for="language-{{ $language->id }}">{{ $language->content }} content</label>
                        <textarea class="form-control form-control-alt" name="languageContents[{{ $language->id }}]" rows="15">{{ $language->languageContent }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
