
<div class="form-group {{ $errors->has('active') ? 'is-invalid' : '' }}">
    <label for="active">Active</label>
        <div class="checkbox">
            <label for="active_1">
            	<input id="active_1" class="" name="active" type="checkbox" value="1" {{ old('active', optional($useraction)->active) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('active', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('assigntonew') ? 'is-invalid' : '' }}">
    <label for="assigntonew">Assigntonew</label>
        <input class="form-control form-control-alt {{ $errors->has('assigntonew') ? 'is-invalid' : '' }} " name="assigntonew" type="number" id="assigntonew" value="{{ old('assigntonew', optional($useraction)->assigntonew) }}" min="0" max="2147483647" placeholder="Enter assigntonew here...">
        {!! $errors->first('assigntonew', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('assigntoold') ? 'is-invalid' : '' }}">
    <label for="assigntonew">Assigntoold</label>
    <input class="form-control form-control-alt {{ $errors->has('assigntoold') ? 'is-invalid' : '' }} " name="assigntoold" type="number" id="assigntoold" value="{{ old('assigntoold', optional($useraction)->assigntoold) }}" min="0" max="2147483647" placeholder="Enter assigntoold here...">
    {!! $errors->first('assigntoold', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('assigntype') ? 'is-invalid' : '' }}">
    <label for="assigntype">Assigntype</label>
        <input class="form-control form-control-alt {{ $errors->has('assigntype') ? 'is-invalid' : '' }} " name="assigntype" type="number" id="assigntype" value="{{ old('assigntype', optional($useraction)->assigntype) }}" min="0" max="2147483647" placeholder="Enter assigntype here...">
        {!! $errors->first('assigntype', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('comment') ? 'is-invalid' : '' }}">
    <label for="comment">Comment</label>
        <input class="form-control form-control-alt {{ $errors->has('comment') ? 'is-invalid' : '' }} " name="comment" type="text" id="comment" value="{{ old('comment', optional($useraction)->comment) }}" maxlength="192" placeholder="Enter comment here...">
        {!! $errors->first('comment', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('created_ip') ? 'is-invalid' : '' }}">
    <label for="created_ip">Created Ip</label>
        <input class="form-control form-control-alt {{ $errors->has('created_ip') ? 'is-invalid' : '' }} " name="created_ip" type="text" id="created_ip" value="{{ old('created_ip', optional($useraction)->created_ip) }}" maxlength="45" placeholder="Enter created ip here...">
        {!! $errors->first('created_ip', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('created_user') ? 'is-invalid' : '' }}">
    <label for="created_user">Created User</label>
        <input class="form-control form-control-alt {{ $errors->has('created_user') ? 'is-invalid' : '' }} " name="created_user" type="number" id="created_user" value="{{ old('created_user', optional($useraction)->created_user) }}" min="0" max="2147483647" placeholder="Enter created user here...">
        {!! $errors->first('created_user', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('type') ? 'is-invalid' : '' }}">
    <label for="type">Type</label>
        <input class="form-control form-control-alt {{ $errors->has('type') ? 'is-invalid' : '' }} " name="type" type="number" id="type" value="{{ old('type', optional($useraction)->type) }}" min="0" max="2147483647" placeholder="Enter type here...">
        {!! $errors->first('type', '<p class="invalid-feedback">:message</p>') !!}
</div>

