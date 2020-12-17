
<div class="form-group row {{ $errors->has('contentadditionalable_type') ? 'is-invalid' : '' }}">
    <label for="contentadditionalable_type" class="col-md-2 control-label">Contentadditionalable Type</label>
    <div class="col-md-10">
        <input class="form-control" name="contentadditionalable_type" type="text" id="contentadditionalable_type" value="{{ old('contentadditionalable_type', optional($contentgroup)->contentadditionalable_type) }}" maxlength="255" required="true" placeholder="Enter contentadditionalable type here...">
        {!! $errors->first('contentadditionalable_type', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('section') ? 'is-invalid' : '' }}">
    <label for="section" class="col-md-2 control-label">Section</label>
    <div class="col-md-10">
        <input class="form-control" name="section" type="text" id="section" value="{{ old('section', optional($contentgroup)->section) }}" maxlength="255" placeholder="Enter section here...">
        {!! $errors->first('section', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('content') ? 'is-invalid' : '' }}">
    <label for="content" class="col-md-2 control-label">Content</label>
    <div class="col-md-10">
        <input class="form-control" name="content" type="text" id="content" value="{{ old('content', optional($contentgroup)->content) }}" maxlength="255" placeholder="Enter content here...">
        {!! $errors->first('content', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('code') ? 'is-invalid' : '' }}">
    <label for="code" class="col-md-2 control-label">Code Standard Content</label>
    <div class="col-md-10">
        <input class="form-control" name="code" type="text" id="code" value="{{ old('code', optional($contentgroup)->code) }}" maxlength="40" placeholder="Enter code here...">
        {!! $errors->first('code', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>


@section('js_form')

    <script>
        $(document).ready(function() {
            $('#contentadditionalable_type').change(function() {
                console.log($(this).val());
            }).trigger('change');
        });
    </script>

@endsection
