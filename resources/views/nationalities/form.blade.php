<div class="col-sm-10 col-md-3 mb-5">
    <div class="custom-control custom-block custom-control-success">
        <input type="checkbox" class="custom-control-input" id="active"
            name="active" {{ $errors->has('active') ? 'is-invalid' : '' }}
            value="{{ old('active', optional($nationality)->active) }}" {{ old('active', optional($nationality)->active == '1' ? 'checked' : '' ) }}>
        <label class="custom-control-label" for="active">
            <span class="d-block text-center">
                <i class="fa fa-check fa-2x mb-2 text-black-50"></i><br>
                Record is active
            </span>
        </label>
        <span class="custom-block-indicator">
            <i class="fa fa-check"></i>
        </span>
    </div>
</div>

<div class="col-sm-10 col-md-12">
<div class="row">

    <div class="col-sm-6">

        <div class="form-group {{ $errors->has('code') ? 'is-invalid' : '' }}">
            <label for="code">Code</label>
            <input class="form-control form-control-alt {{ $errors->has('code') ? 'is-invalid' : '' }} " name="code"
                type="text" id="code" value="{{ old('code', optional($nationality)->code) }}" maxlength="2"
                placeholder="Enter code here...">
            {!! $errors->first('code', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_de') ? 'is-invalid' : '' }}">
            <label for="name_de">Name De</label>
            <input class="form-control form-control-alt {{ $errors->has('name_de') ? 'is-invalid' : '' }} " name="name_de"
                type="text" id="name_de" value="{{ old('name_de', optional($nationality)->name_de) }}" maxlength="150"
                placeholder="Enter name de here...">
            {!! $errors->first('name_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_en') ? 'is-invalid' : '' }}">
            <label for="name_en">Name En</label>
            <input class="form-control form-control-alt {{ $errors->has('name_en') ? 'is-invalid' : '' }} " name="name_en"
                type="text" id="name_en" value="{{ old('name_en', optional($nationality)->name_en) }}" maxlength="150"
                placeholder="Enter name en here...">
            {!! $errors->first('name_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_fr') ? 'is-invalid' : '' }}">
            <label for="name_fr">Name Fr</label>
            <input class="form-control form-control-alt {{ $errors->has('name_fr') ? 'is-invalid' : '' }} " name="name_fr"
                type="text" id="name_fr" value="{{ old('name_fr', optional($nationality)->name_fr) }}" maxlength="150"
                placeholder="Enter name fr here...">
            {!! $errors->first('name_fr', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_it') ? 'is-invalid' : '' }}">
            <label for="name_it">Name It</label>
            <input class="form-control form-control-alt {{ $errors->has('name_it') ? 'is-invalid' : '' }} " name="name_it"
                type="text" id="name_it" value="{{ old('name_it', optional($nationality)->name_it) }}" maxlength="150"
                placeholder="Enter name it here...">
            {!! $errors->first('name_it', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_nl') ? 'is-invalid' : '' }}">
            <label for="name_nl">Name Nl</label>
            <input class="form-control form-control-alt {{ $errors->has('name_nl') ? 'is-invalid' : '' }} " name="name_nl"
                type="text" id="name_nl" value="{{ old('name_nl', optional($nationality)->name_nl) }}" maxlength="150"
                placeholder="Enter name nl here...">
            {!! $errors->first('name_nl', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_pl') ? 'is-invalid' : '' }}">
            <label for="name_pl">Name Pl</label>
            <input class="form-control form-control-alt {{ $errors->has('name_pl') ? 'is-invalid' : '' }} " name="name_pl"
                type="text" id="name_pl" value="{{ old('name_pl', optional($nationality)->name_pl) }}" maxlength="150"
                placeholder="Enter name pl here...">
            {!! $errors->first('name_pl', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_es') ? 'is-invalid' : '' }}">
            <label for="name_es">Name Es</label>
            <input class="form-control form-control-alt {{ $errors->has('name_es') ? 'is-invalid' : '' }} " name="name_es"
                type="text" id="name_es" value="{{ old('name_es', optional($nationality)->name_es) }}" maxlength="150"
                placeholder="Enter name es here...">
            {!! $errors->first('name_es', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_pt') ? 'is-invalid' : '' }}">
            <label for="name_pt">Name Pt</label>
            <input class="form-control form-control-alt {{ $errors->has('name_pt') ? 'is-invalid' : '' }} " name="name_pt"
                type="text" id="name_pt" value="{{ old('name_pt', optional($nationality)->name_pt) }}" maxlength="150"
                placeholder="Enter name pt here...">
            {!! $errors->first('name_pt', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('name_ru') ? 'is-invalid' : '' }}">
            <label for="name_ru">Name Ru</label>
            <input class="form-control form-control-alt {{ $errors->has('name_ru') ? 'is-invalid' : '' }} " name="name_ru"
                type="text" id="name_ru" value="{{ old('name_ru', optional($nationality)->name_ru) }}" maxlength="150"
                placeholder="Enter name ru here...">
            {!! $errors->first('name_ru', '<p class="invalid-feedback">:message</p>') !!}
        </div>

    </div>

    <div class="col-sm-5">

        <div class="form-group {{ $errors->has('prio') ? 'is-invalid' : '' }}">
            <label for="prio">Prio</label>
            <input class="form-control form-control-alt {{ $errors->has('prio') ? 'is-invalid' : '' }} " name="prio"
                type="number" id="prio" value="{{ old('prio', optional($nationality)->prio) }}" min="-2147483648"
                max="2147483647" placeholder="Enter prio here...">
            {!! $errors->first('prio', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('created_user') ? 'is-invalid' : '' }}">
            <label for="created_user">Created User</label>
            <input class="form-control form-control-alt {{ $errors->has('created_user') ? 'is-invalid' : '' }} "
                name="created_user" type="number" id="created_user"
                value="{{ old('created_user', optional($nationality)->created_user) }}" min="-2147483648"
                max="2147483647" placeholder="Enter created user here...">
            {!! $errors->first('created_user', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('created_ip') ? 'is-invalid' : '' }}">
            <label for="created_ip">Created Ip</label>
            <input class="form-control form-control-alt {{ $errors->has('created_ip') ? 'is-invalid' : '' }} "
                name="created_ip" type="text" id="created_ip"
                value="{{ old('created_ip', optional($nationality)->created_ip) }}" maxlength="20"
                placeholder="Enter created ip here...">
            {!! $errors->first('created_ip', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('updated_user') ? 'is-invalid' : '' }}">
            <label for="updated_user">Updated User</label>
            <input class="form-control form-control-alt {{ $errors->has('updated_user') ? 'is-invalid' : '' }} "
                name="updated_user" type="number" id="updated_user"
                value="{{ old('updated_user', optional($nationality)->updated_user) }}" min="-2147483648"
                max="2147483647" placeholder="Enter updated user here...">
            {!! $errors->first('updated_user', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('updated_ip') ? 'is-invalid' : '' }}">
            <label for="updated_ip">Updated Ip</label>
            <input class="form-control form-control-alt {{ $errors->has('updated_ip') ? 'is-invalid' : '' }} "
                name="updated_ip" type="text" id="updated_ip"
                value="{{ old('updated_ip', optional($nationality)->updated_ip) }}" maxlength="20"
                placeholder="Enter updated ip here...">
            {!! $errors->first('updated_ip', '<p class="invalid-feedback">:message</p>') !!}
        </div>

    </div>

</div>
</div>
