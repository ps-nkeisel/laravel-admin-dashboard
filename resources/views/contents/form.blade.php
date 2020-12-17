<!--
<div class="form-group {{ $errors->has('category') ? 'is-invalid' : '' }}">
    <label for="category">Category</label>
    <input class="form-control form-control-alt {{ $errors->has('category') ? 'is-invalid' : '' }} " name="category" type="number" id="category" value="{{ old('category', optional($content)->category) }}" min="-2147483648" max="2147483647" required="true" placeholder="Enter category here...">
    {!! $errors->first('category', '<p class="invalid-feedback">:message</p>') !!}
    </div>
-->
<div class="col-sm-10 col-md-12">
    <div class="form-group {{ $errors->has('code1') ? 'is-invalid' : '' }} row">
        <div class="col-4">
            <label for="code1">Code 1</label>
            <input class="form-control form-control-alt {{ $errors->has('code1') ? 'is-invalid' : '' }} " name="code1" type="text" id="code1" value="{{ old('code1', optional($content)->code1) }}" maxlength="40" placeholder="Enter code 1 here...">
            {!! $errors->first('code1', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('code2') ? 'is-invalid' : '' }}">
        <label for="code2">Code 2</label>
        <input class="form-control form-control-alt {{ $errors->has('code2') ? 'is-invalid' : '' }} " name="code2" type="text" id="code2" value="{{ old('code2', optional($content)->code2) }}" maxlength="40" placeholder="Enter code 2 here...">
        {!! $errors->first('code2', '<p class="invalid-feedback">:message</p>') !!}
    </div>
    <!--
    <div class="form-group {{ $errors->has('code3') ? 'is-invalid' : '' }}">
        <label for="code3">Code 3</label>
        <input class="form-control form-control-alt {{ $errors->has('code3') ? 'is-invalid' : '' }} " name="code3" type="text" id="code3" value="{{ old('code3', optional($content)->code3) }}" maxlength="40" placeholder="Enter code3 here...">
        {!! $errors->first('code3', '<p class="invalid-feedback">:message</p>') !!}
    </div>
    -->

    <div class="form-group {{ $errors->has('category') ? 'is-invalid' : '' }}">
        <label for="category">Category</label>
        <select class="form-control form-control-alt {{ $errors->has('category') ? 'is-invalid' : '' }}" id="category"
                name="category">
            <option value="">choose</option>
            @foreach($contentcategories as $category)
                <option value="{{ $category->id }}" @if(isset($content->contentcategory))
                        @if ($category->id == old('category', $content->contentcategory->id))
                        selected="selected"
                    @endif
                    @endif
                >{{ $category->content }}</option>
            @endforeach
        </select>
        {!! $errors->first('category', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('text1') ? 'is-invalid' : '' }}">
        <label for="text1">Headline</label>
        <input class="form-control form-control-alt {{ $errors->has('text1') ? 'is-invalid' : '' }} " name="text1" type="text" id="text1" value="{{ old('text1', optional($content)->text1) }}" maxlength="100" placeholder="Enter headline here...">
        {!! $errors->first('text1', '<p class="invalid-feedback">:message</p>') !!}
    </div>
<!--
    <div class="form-group {{ $errors->has('text2') ? 'is-invalid' : '' }}">
        <label for="text2">Text 2</label>
        <input class="form-control form-control-alt {{ $errors->has('text2') ? 'is-invalid' : '' }} " name="text2" type="text" id="text2" value="{{ old('text2', optional($content)->text2) }}" maxlength="100" placeholder="Enter text2 here...">
        {!! $errors->first('text2', '<p class="invalid-feedback">:message</p>') !!}
    </div>
-->

    <div class="form-group {{ $errors->has('content1') ? 'is-invalid' : '' }}">
        <label for="content1">Content</label>
        <textarea id="js-ckeditor" name="content1">{{ old('content1', optional($content)->content1) }}</textarea>
        {!! $errors->first('content1', '<p class="invalid-feedback">:message</p>') !!}
    </div>

<!--
    <div class="form-group {{ $errors->has('content2') ? 'is-invalid' : '' }}">
        <label for="content2">Beschreibung 2</label>
        <input class="form-control form-control-alt {{ $errors->has('content2') ? 'is-invalid' : '' }} " name="content2" type="text" id="content2" value="{{ old('content2', optional($content)->content2) }}" maxlength="4294967295" required="true" placeholder="Enter content2 here...">
        {!! $errors->first('content2', '<p class="invalid-feedback">:message</p>') !!}
    </div>
-->
</div>

<div class="col-sm-10 col-md-6">
    <!--
    <div class="form-group {{ $errors->has('nat') ? 'is-invalid' : '' }}">
        <label for="nat">Nationalität</label>
        <input class="form-control form-control-alt {{ $errors->has('nat') ? 'is-invalid' : '' }} " name="nat" type="text" id="nat" value="{{ old('nat', optional($content)->nat) }}" maxlength="2" placeholder="Enter nat here...">
        {!! $errors->first('nat', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('destco') ? 'is-invalid' : '' }}">
        <label for="destco">Zielland</label>
        <input class="form-control form-control-alt {{ $errors->has('destco') ? 'is-invalid' : '' }} " name="destco" type="text" id="destco" value="{{ old('destco', optional($content)->destco) }}" maxlength="2" placeholder="Enter destco here...">
        {!! $errors->first('destco', '<p class="invalid-feedback">:message</p>') !!}
    </div>
    -->
        <div class="form-group {{ $errors->has('position') ? 'is-invalid' : '' }}">
            <label for="position">Position</label>
            <input class="form-control form-control-alt {{ $errors->has('position') ? 'is-invalid' : '' }} " name="position" type="number" id="position" value="{{ old('position', optional($content)->position) }}" min="0" max="2147483647" placeholder="Enter position here...">
            {!! $errors->first('position', '<p class="invalid-feedback">:message</p>') !!}
        </div>

    <div class="form-group {{ $errors->has('lang') ? 'is-invalid' : '' }}">
        <label for="lang">Language</label>
        <select class="form-control form-control-alt {{ $errors->has('lang') ? 'is-invalid' : '' }}" id="lang" name="lang">
            <option value="">choose</option>
            @foreach($languages as $language)
                <option value="{{ $language->id }}" @if(isset($content->lang))
                        @if ($language->id == old('lang', $content->lang))
                        selected="selected"
                    @endif
                    @endif
                >{{ $language->content }}</option>
            @endforeach
        </select>
        {!! $errors->first('lang', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('archive') ? 'is-invalid' : '' }}">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="archive" class="custom-control-input {{ $errors->has('archive') ? 'is-invalid' : '' }}"
                   name="archive" type="checkbox"
                   value="1" {{ old('archive', optional($content)->archive) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="archive">Archive</label>
            {!! $errors->first('archive', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('active') ? 'is-invalid' : '' }}">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="active" class="custom-control-input {{ $errors->has('active') ? 'is-invalid' : '' }}"
                   name="active" type="checkbox"
                   value="1" {{ old('active', optional($content)->active) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="active">Activate</label>
            {!! $errors->first('active', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-6">

<!--
<div class="form-group {{ $errors->has('type') ? 'is-invalid' : '' }}">
    <label for="type">Type</label>
    <input class="form-control form-control-alt {{ $errors->has('type') ? 'is-invalid' : '' }} " name="type" type="number" id="type" value="{{ old('type', optional($content)->type) }}" min="-2147483648" max="2147483647" required="true" placeholder="Enter type here...">
    {!! $errors->first('type', '<p class="invalid-feedback">:message</p>') !!}
    </div>
-->

    <div class="form-group {{ $errors->has('validityfrom') ? 'is-invalid' : '' }}">
        <label for="validityfrom">Active from</label>
        <input class="js-datepicker form-control form-control-alt {{ $errors->has('validityfrom') ? 'is-invalid' : '' }} " name="validityfrom" type="text" id="validityfrom" value="{{ old('validityfrom', optional($content)->validityfrom) }}" placeholder="Enter date for active from here..." data-week-start="1" data-autoclose="true"
               data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
        {!! $errors->first('validityfrom', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('validityto') ? 'is-invalid' : '' }}">
        <label for="validityto">Active to</label>
        <input class="js-datepicker form-control form-control-alt {{ $errors->has('validityto') ? 'is-invalid' : '' }} " name="validityto" type="text" id="validityto" value="{{ old('validityto', optional($content)->validityto) }}" placeholder="Enter date for active to here..." data-week-start="1" data-autoclose="true"
               data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
        {!! $errors->first('validityto', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>









