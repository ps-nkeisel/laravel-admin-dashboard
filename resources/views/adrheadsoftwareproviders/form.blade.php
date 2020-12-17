<div class="form-group row {{ $errors->has('code') ? 'is-invalid' : '' }}">
    <label for="code" class="col-md-2 control-label">Code</label>
    <div class="col-md-10">
        <input class="form-control" name="code" type="text" id="code" value="{{ old('code', optional($adrheadsoftwareprovider)->code) }}" maxlength="30" placeholder="Enter code here...">
        {!! $errors->first('code', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('content_en') ? 'is-invalid' : '' }}">
    <label for="content_en" class="col-md-2 control-label">Content En</label>
    <div class="col-md-10">
        <input class="form-control" name="content_en" type="text" id="content_en" value="{{ old('content_en', optional($adrheadsoftwareprovider)->content_en) }}" maxlength="45" placeholder="Enter content here...">
        {!! $errors->first('content_en', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('content_de') ? 'is-invalid' : '' }}">
    <label for="content_de" class="col-md-2 control-label">Content De</label>
    <div class="col-md-10">
        <input class="form-control" name="content_de" type="text" id="content_de" value="{{ old('content_de', optional($adrheadsoftwareprovider)->content_de) }}" maxlength="45" placeholder="Enter content here...">
        {!! $errors->first('content_de', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('active') ? 'is-invalid' : '' }}">
    <div class="col-md-2">
        <label for="active">Active :</label>
    </div>
    <div class="col-md-10">
        <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
            <input type="checkbox" class="custom-control-input"
                id="active" name="active" {{ old('active', optional($adrheadsoftwareprovider)->active) == 1 ? 'checked' : '' }}/>
            <label class="custom-control-label" for="active">No / Yes</label>
        </div>
    </div>
</div>
