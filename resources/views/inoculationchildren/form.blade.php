
<div class="form-group {{ $errors->has('assignto') ? 'is-invalid' : '' }}">
    <label for="assignto">Assignto</label>
        <input class="form-control form-control-alt {{ $errors->has('assignto') ? 'is-invalid' : '' }} " name="assignto" type="number" id="assignto" value="{{ old('assignto', optional($inoculationchild)->assignto) }}" min="0" max="4294967295" placeholder="Enter assignto here...">
        {!! $errors->first('assignto', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('lang') ? 'is-invalid' : '' }}">
    <label for="lang">Lang</label>
        <input class="form-control form-control-alt {{ $errors->has('lang') ? 'is-invalid' : '' }} " name="lang" type="number" id="lang" value="{{ old('lang', optional($inoculationchild)->lang) }}" min="0" max="4294967295" placeholder="Enter lang here...">
        {!! $errors->first('lang', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('position') ? 'is-invalid' : '' }}">
    <label for="position">Position</label>
        <input class="form-control form-control-alt {{ $errors->has('position') ? 'is-invalid' : '' }} " name="position" type="number" id="position" value="{{ old('position', optional($inoculationchild)->position) }}" min="0" max="4294967295" placeholder="Enter position here...">
        {!! $errors->first('position', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('content') ? 'is-invalid' : '' }}">
    <label for="content">Content</label>
        <input class="form-control form-control-alt {{ $errors->has('content') ? 'is-invalid' : '' }} " name="content" type="text" id="content" value="{{ old('content', optional($inoculationchild)->content) }}" maxlength="150" placeholder="Enter content here...">
        {!! $errors->first('content', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('controlled_at') ? 'is-invalid' : '' }}">
    <label for="controlled_at">Controlled At</label>
        <input class="form-control form-control-alt {{ $errors->has('controlled_at') ? 'is-invalid' : '' }} " name="controlled_at" type="text" id="controlled_at" value="{{ old('controlled_at', optional($inoculationchild)->controlled_at) }}" placeholder="Enter controlled at here...">
        {!! $errors->first('controlled_at', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('controlled_user') ? 'is-invalid' : '' }}">
    <label for="controlled_user">Controlled User</label>
        <input class="form-control form-control-alt {{ $errors->has('controlled_user') ? 'is-invalid' : '' }} " name="controlled_user" type="number" id="controlled_user" value="{{ old('controlled_user', optional($inoculationchild)->controlled_user) }}" min="0" max="4294967295" placeholder="Enter controlled user here...">
        {!! $errors->first('controlled_user', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('controlled_ip') ? 'is-invalid' : '' }}">
    <label for="controlled_ip">Controlled Ip</label>
        <input class="form-control form-control-alt {{ $errors->has('controlled_ip') ? 'is-invalid' : '' }} " name="controlled_ip" type="text" id="controlled_ip" value="{{ old('controlled_ip', optional($inoculationchild)->controlled_ip) }}" maxlength="45" placeholder="Enter controlled ip here...">
        {!! $errors->first('controlled_ip', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('created_user') ? 'is-invalid' : '' }}">
    <label for="created_user">Created User</label>
        <input class="form-control form-control-alt {{ $errors->has('created_user') ? 'is-invalid' : '' }} " name="created_user" type="number" id="created_user" value="{{ old('created_user', optional($inoculationchild)->created_user) }}" min="0" max="4294967295" placeholder="Enter created user here...">
        {!! $errors->first('created_user', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('created_ip') ? 'is-invalid' : '' }}">
    <label for="created_ip">Created Ip</label>
        <input class="form-control form-control-alt {{ $errors->has('created_ip') ? 'is-invalid' : '' }} " name="created_ip" type="text" id="created_ip" value="{{ old('created_ip', optional($inoculationchild)->created_ip) }}" maxlength="45" placeholder="Enter created ip here...">
        {!! $errors->first('created_ip', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('updated_user') ? 'is-invalid' : '' }}">
    <label for="updated_user">Updated User</label>
        <input class="form-control form-control-alt {{ $errors->has('updated_user') ? 'is-invalid' : '' }} " name="updated_user" type="number" id="updated_user" value="{{ old('updated_user', optional($inoculationchild)->updated_user) }}" min="0" max="4294967295" placeholder="Enter updated user here...">
        {!! $errors->first('updated_user', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('updated_ip') ? 'is-invalid' : '' }}">
    <label for="updated_ip">Updated Ip</label>
        <input class="form-control form-control-alt {{ $errors->has('updated_ip') ? 'is-invalid' : '' }} " name="updated_ip" type="text" id="updated_ip" value="{{ old('updated_ip', optional($inoculationchild)->updated_ip) }}" maxlength="45" placeholder="Enter updated ip here...">
        {!! $errors->first('updated_ip', '<p class="invalid-feedback">:message</p>') !!}
</div>

