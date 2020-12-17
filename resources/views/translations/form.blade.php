<div class="col-sm-10 col-md-6">
    <div class="form-group {{ $errors->has('code') ? 'is-invalid' : '' }}">
        <label for="code">Language Code</label>
        <select class="form-control form-control-alt {{ $errors->has('code') ? 'is-invalid' : '' }}"
                id="code" name="code">
            <option value="">choose</option>
            @foreach($languages as $language)
                <option value="{{ $language->code }}" @if(isset($translation->code))
                    @if ($language->code == old('language', $translation->code))
                    selected="selected"
                    @endif
                    @endif
                >{{ $language->content }} ({{$language->code}})</option>
            @endforeach
        </select>
        {!! $errors->first('code', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('namespace') ? 'is-invalid' : '' }}">
        <label for="namespace">Namespace</label>
        <input class="form-control form-control-alt {{ $errors->has('namespace') ? 'is-invalid' : '' }}" name="namespace"
               type="text" id="namespace" value="{{ old('namespace', optional($translation)->namespace) }}"
               placeholder="Enter namespace here...">
        {!! $errors->first('namespace', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('group') ? 'is-invalid' : '' }}">
        <label for="group">Group</label>
        <input class="form-control form-control-alt {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group"
               type="text" id="group" value="{{ old('group', optional($translation)->group) }}"
               placeholder="Enter group here...">
        {!! $errors->first('group', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('item') ? 'is-invalid' : '' }}">
        <label for="item">Item</label>
        <input class="form-control form-control-alt {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item"
               type="text" id="item" value="{{ old('item', optional($translation)->item) }}"
               placeholder="Enter item here...">
        {!! $errors->first('item', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <div class="form-group {{ $errors->has('text') ? 'is-invalid' : '' }}">
        <label for="text">Text</label>
        <input class="form-control form-control-alt {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text"
               type="text" id="text" value="{{ old('text', optional($translation)->text) }}"
               placeholder="Enter text here...">
        {!! $errors->first('text', '<p class="invalid-feedback">:message</p>') !!}
    </div>

    <br>

    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="unstable" class="custom-control-input {{ $errors->has('unstable') ? 'is-invalid' : '' }}"
                   name="unstable" type="checkbox"
                   value="1" {{ old('unstable', optional($translation)->unstable) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="unstable">unstable</label>
            {!! $errors->first('unstable', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
            <input id="locked" class="custom-control-input {{ $errors->has('locked') ? 'is-invalid' : '' }}"
                   name="locked" type="checkbox"
                   value="1" {{ old('locked', optional($translation)->locked) == '1' ? 'checked' : '' }}>
            <label class="custom-control-label" for="locked">locked</label>
            {!! $errors->first('locked', '<p class="invalid-feedback">:message</p>') !!}
        </div>
    </div>
</div>
