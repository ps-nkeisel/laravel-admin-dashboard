
<div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" maxlength="255" placeholder="Enter name here..." required>
        {!! $errors->first('name', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('username') ? 'is-invalid' : '' }}">
    <label for="username" class="col-md-2 control-label">Username</label>
    <div class="col-md-10">
        <input class="form-control" name="username" type="text" id="username" value="{{ old('username', optional($user)->username) }}" maxlength="255" placeholder="Enter username here..." required>
        {!! $errors->first('username', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('email') ? 'is-invalid' : '' }}">
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($user)->email) }}" maxlength="255" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('password') ? 'is-invalid' : '' }}">
    <label for="password" class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
        <input type="password" class="form-control form-control-alt{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Password"
            @if(!isset($user))
                required
                minlength="8"
            @endif
        >
        {!! $errors->first('password', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    <label for="password_confirmation" class="col-md-2 control-label">Confirm Password</label>
    <div class="col-md-10">
        <input type="password" class="form-control form-control-alt" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm"
            @if(!isset($user))
                required
                minlength="8"
            @endif
        >
    </div>
</div>

<div class="form-group {{ $errors->has('active') ? 'is-invalid' : '' }}">
    <div class="custom-control custom-checkbox custom-control-lg custom-control-primary">
        <input id="active" class="custom-control-input {{ $errors->has('active') ? 'is-invalid' : '' }}"
                name="active" type="checkbox"
                value="1" {{ old('active', optional($user)->active) == '1' ? 'checked' : '' }}>
        <label class="custom-control-label" for="active">Active</label>
        {!! $errors->first('active', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>
