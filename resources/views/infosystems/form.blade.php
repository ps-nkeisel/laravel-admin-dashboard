<div class="col-sm-10 col-md-12">
    <div class="form-group {{ $errors->has('header') ? 'is-invalid' : '' }}">
        <label for="example-textarea-input">Headline</label>
        <textarea class="form-control form-control-alt {{ $errors->has('header') ? 'is-invalid' : '' }}" id="header"
                  name="header" rows="2"
                  placeholder="enter headline here... ">{{ old('header', optional($infosystem)->header) }}</textarea>
        {!! $errors->first('header', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('content') ? 'is-invalid' : '' }}">
        <label for="content">Content</label>
        <textarea id="js-ckeditor" name="content">{{ old('content', optional($infosystem)->content) }}</textarea>
        {!! $errors->first('content', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="col-sm-10 col-md-6">

    <div class="form-group {{ $errors->has('appearance') ? 'is-invalid' : '' }}">
        <label for="appearance">Display color</label>
        <select class="form-control form-control-alt {{ $errors->has('appearance') ? 'is-invalid' : '' }}"
                id="appearance" name="appearance">
            <option value="">choose</option>
            @foreach($appearance as $key => $value)
                <option value="{{ $key }}" @if(isset($infosystem->appearance))
                        @if ($key == old('appearance', $infosystem->appearance))
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
                <option value="{{ $key }}" @if(isset($infosystem->tagtype))
                        @if ($key == old('tagtype', $infosystem->tagtype))
                        selected="selected"
                        @endif
                    @endif
                >{{ $value }}</option>
            @endforeach
        </select>
        {!! $errors->first('tagtype', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('tagtext') ? 'is-invalid' : '' }}">
        <label for="tagtext">Display content</label>
        <input class="form-control form-control-alt {{ $errors->has('tagtext') ? 'is-invalid' : '' }}" name="tagtext"
               type="text" id="tagtext" value="{{ old('tagtext', optional($infosystem)->tagtext) }}" maxlength="40"
               placeholder="Enter display content here...">
        {!! $errors->first('tagtext', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('tagdate') ? 'is-invalid' : '' }}">
        <label for="tagdate">Date</label>
        <input class="js-datepicker form-control form-control-alt {{ $errors->has('tagdate') ? 'is-invalid' : '' }}"
               name="tagdate" type="text" id="tagdate" data-week-start="1" data-autoclose="true"
               data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
               value="{{ old('tagdate', optional($infosystem)->tagdate) }}" maxlength="40"
               placeholder="Enter tagdate here...">
        {!! $errors->first('tagdate', '<p class="invalid-feedback">:message</p>') !!}
    </div>

</div>

<div class="col-sm-10 col-md-6">
    <div class="form-group {{ $errors->has('lang') ? 'is-invalid' : '' }}">
        <label for="lang">Language</label>
        <select class="form-control form-control-alt {{ $errors->has('lang') ? 'is-invalid' : '' }}" id="lang"
                name="lang">
            <option value="">choose</option>
            @foreach($languages as $language)
                <option value="{{ $language->code }}" @if(isset($infosystem->lang))
                        @if ($language->code == old('lang', $infosystem->lang))
                        selected="selected"
                        @endif
                    @endif
                >{{ $language->content }}</option>
            @endforeach
        </select>
        {!! $errors->first('lang', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('position') ? 'is-invalid' : '' }}">
        <label for="position">Position</label>
        <input class="form-control form-control-alt {{ $errors->has('position') ? 'is-invalid' : '' }}" name="position"
               type="number" id="position" value="{{ old('position', optional($infosystem)->position) }}" min="1"
               max="2147483647" placeholder="Enter position here...">
        {!! $errors->first('position', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <br>
    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="archive" class="custom-control-input {{ $errors->has('archive') ? 'is-invalid' : '' }}"
                   name="archive" type="checkbox"
                   value="1" {{ old('archive', optional($infosystem)->archive) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="archive">Archive</label>
            {!! $errors->first('archive', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="active" class="custom-control-input {{ $errors->has('active') ? 'is-invalid' : '' }}"
                   name="active" type="checkbox"
                   value="1" {{ old('archive', optional($infosystem)->active) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="active">Activate</label>
            {!! $errors->first('active', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>
