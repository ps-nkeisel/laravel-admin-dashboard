<div class="col-sm-10 col-md-3 mb-5">
    <div class="custom-control custom-block custom-control-success">
        <input type="checkbox" class="custom-control-input" id="active"
            name="active" {{ $errors->has('active') ? 'is-invalid' : '' }}
            value="{{ old('active', optional($corona)->active) }}" {{ old('active', optional($corona)->active == '1' ? 'checked' : '' ) }}>
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
            <div class="form-group {{ $errors->has('countrycode') ? 'is-invalid' : '' }}">
                <label for="countrycode">Country Code</label>
                <input class="form-control form-control-alt {{ $errors->has('countrycode') ? 'is-invalid' : '' }} " name="countrycode"
                       type="text" id="countrycode" value="{{ old('countrycode', optional($corona)->countrycode) }}" maxlength="2"
                       placeholder="Enter country code here...">
                {!! $errors->first('countrycode', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
        <div class="col-sm-6"></div>
    </div>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('kbr_de') ? 'is-invalid' : '' }}">
            <label for="kbr_de">Quarantänemaßnahmen für bestimmte Reisende - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('kbr_de') ? 'is-invalid' : '' }} " name="kbr_de"
                   type="text" id="kbr_de" value="{{ old('kbr_de', optional($corona)->kbr_de) }}" maxlength="150"
                   placeholder="Enter german content here...">
            {!! $errors->first('kbr_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('kar_de') ? 'is-invalid' : '' }}">
            <label for="kar_de">Quarantänemaßnahmen für alle Reisende - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('kar_de') ? 'is-invalid' : '' }} " name="kar_de"
                   type="text" id="kar_de" value="{{ old('kar_de', optional($corona)->kar_de) }}" maxlength="150"
                   placeholder="Enter german content here...">
            {!! $errors->first('kar_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('ever_de') ? 'is-invalid' : '' }}">
            <label for="ever_de">Einreisebeschränkung bei Voraufenthalten in bzw. Einreisen aus Risikogebieten - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('ever_de') ? 'is-invalid' : '' }} " name="ever_de"
                   type="text" id="ever_de" value="{{ old('ever_de', optional($corona)->ever_de) }}" maxlength="150"
                   placeholder="Enter german content here...">
            {!! $errors->first('ever_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('ebn_de') ? 'is-invalid' : '' }}">
            <label for="ebn_de">Einreisebeschränkung für bestimmte Nationalitäten - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('ebn_de') ? 'is-invalid' : '' }} " name="ebn_de"
                   type="text" id="ebn_de" value="{{ old('ebn_de', optional($corona)->ebn_de) }}" maxlength="150"
                   placeholder="Enter german content here...">
            {!! $errors->first('ebn_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('ge_de') ? 'is-invalid' : '' }}">
            <label for="ge_de">Gesundheitsnachweis/Untersuchung erforderlich - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('ge_de') ? 'is-invalid' : '' }} " name="ge_de"
                   type="text" id="ge_de" value="{{ old('ge_de', optional($corona)->ge_de) }}" maxlength="150"
                   placeholder="Enter german content here...">
            {!! $errors->first('ge_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('kes_de') ? 'is-invalid' : '' }}">
            <label for="kes_de">Komplette Einreisesperre - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('kes_de') ? 'is-invalid' : '' }} " name="kes_de"
                   type="text" id="kes_de" value="{{ old('kes_de', optional($corona)->kes_de) }}" maxlength="150"
                   placeholder="Enter german content here...">
            {!! $errors->first('kes_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('slu_de') ? 'is-invalid' : '' }}">
            <label for="slu_de">Sperre Luftweg - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('slu_de') ? 'is-invalid' : '' }} " name="slu_de"
                   type="text" id="slu_de" value="{{ old('slu_de', optional($corona)->slu_de) }}" maxlength="150"
                   placeholder="Enter german content here...">
            {!! $errors->first('slu_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('sla_de') ? 'is-invalid' : '' }}">
            <label for="sla_de">Sperre Landweg - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('sla_de') ? 'is-invalid' : '' }} " name="sla_de"
                   type="text" id="sla_de" value="{{ old('sla_de', optional($corona)->sla_de) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('sla_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('sse_de') ? 'is-invalid' : '' }}">
            <label for="sse_de">Sperre Seeweg/Kreuzfahrt - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('sse_de') ? 'is-invalid' : '' }} " name="sse_de"
                   type="text" id="sse_de" value="{{ old('sse_de', optional($corona)->sse_de) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('sse_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('gla_de') ? 'is-invalid' : '' }}">
            <label for="gla_de">Grenzübergänge auf dem Landweg geschlossen - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('gla_de') ? 'is-invalid' : '' }} " name="gla_de"
                   type="text" id="gla_de" value="{{ old('gla_de', optional($corona)->gla_de) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('gla_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('fla_de') ? 'is-invalid' : '' }}">
            <label for="fla_de">Flugausfälle - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('fla_de') ? 'is-invalid' : '' }} " name="fla_de"
                   type="text" id="fla_de" value="{{ old('fla_de', optional($corona)->fla_de) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('fla_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('not_de') ? 'is-invalid' : '' }}">
            <label for="not_de">Notstand ausgerufen - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('not_de') ? 'is-invalid' : '' }} " name="not_de"
                   type="text" id="not_de" value="{{ old('not_de', optional($corona)->not_de) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('not_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('eol_de') ? 'is-invalid' : '' }}">
            <label for="eol_de">Einschränkungen des öffentlichen Lebens/Inlandsverkehrs; Ausgangssperre - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('eol_de') ? 'is-invalid' : '' }} " name="eol_de"
                   type="text" id="eol_de" value="{{ old('eol_de', optional($corona)->eol_de) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('eol_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('vre_de') ? 'is-invalid' : '' }}">
            <label for="vre_de">Visaregime verändert - DE</label>
            <input class="form-control form-control-alt {{ $errors->has('vre_de') ? 'is-invalid' : '' }} " name="vre_de"
                   type="text" id="vre_de" value="{{ old('vre_de', optional($corona)->vre_de) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('vre_de', '<p class="invalid-feedback">:message</p>') !!}
        </div>



    </div>

    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('kbr_en') ? 'is-invalid' : '' }}">
            <label for="kbr_en">Quarantänemaßnahmen für bestimmte Reisende - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('kbr_en') ? 'is-invalid' : '' }} " name="kbr_en"
                   type="text" id="kbr_en" value="{{ old('kbr_en', optional($corona)->kbr_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('kbr_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('kar_en') ? 'is-invalid' : '' }}">
            <label for="kar_en">Quarantänemaßnahmen für alle Reisende - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('kar_en') ? 'is-invalid' : '' }} " name="kar_en"
                   type="text" id="kar_en" value="{{ old('kar_en', optional($corona)->kar_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('kar_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('ever_en') ? 'is-invalid' : '' }}">
            <label for="ever_en">Einreisebeschränkung bei Voraufenthalten in bzw. Einreisen aus Risikogebieten - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('ever_en') ? 'is-invalid' : '' }} " name="ever_en"
                   type="text" id="ever_en" value="{{ old('ever_en', optional($corona)->ever_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('ever_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('ebn_en') ? 'is-invalid' : '' }}">
            <label for="ebn_en">Einreisebeschränkung für bestimmte Nationalitäten - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('ebn_en') ? 'is-invalid' : '' }} " name="ebn_en"
                   type="text" id="ebn_en" value="{{ old('ebn_en', optional($corona)->ebn_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('ebn_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('ge_en') ? 'is-invalid' : '' }}">
            <label for="ge_en">Gesundheitsnachweis/Untersuchung erforderlich - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('ge_en') ? 'is-invalid' : '' }} " name="ge_en"
                   type="text" id="ge_en" value="{{ old('ge_en', optional($corona)->ge_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('ge_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('kes_en') ? 'is-invalid' : '' }}">
            <label for="kes_en">Komplette Einreisesperre - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('kes_en') ? 'is-invalid' : '' }} " name="kes_en"
                   type="text" id="kes_en" value="{{ old('kes_en', optional($corona)->kes_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('kes_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('slu_en') ? 'is-invalid' : '' }}">
            <label for="slu_en">Sperre Luftweg - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('slu_en') ? 'is-invalid' : '' }} " name="slu_en"
                   type="text" id="slu_en" value="{{ old('slu_en', optional($corona)->slu_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('slu_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('sla_en') ? 'is-invalid' : '' }}">
            <label for="sla_en">Sperre Landweg - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('sla_en') ? 'is-invalid' : '' }} " name="sla_en"
                   type="text" id="sla_en" value="{{ old('sla_en', optional($corona)->sla_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('sla_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('sse_en') ? 'is-invalid' : '' }}">
            <label for="sse_en">Sperre Seeweg/Kreuzfahrt - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('sse_en') ? 'is-invalid' : '' }} " name="sse_en"
                   type="text" id="sse_en" value="{{ old('sse_en', optional($corona)->sse_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('sse_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('gla_en') ? 'is-invalid' : '' }}">
            <label for="gla_en">Grenzübergänge auf dem Landweg geschlossen - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('gla_en') ? 'is-invalid' : '' }} " name="gla_en"
                   type="text" id="gla_en" value="{{ old('gla_en', optional($corona)->gla_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('gla_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('fla_en') ? 'is-invalid' : '' }}">
            <label for="fla_en">Flugausfälle - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('fla_en') ? 'is-invalid' : '' }} " name="fla_en"
                   type="text" id="fla_en" value="{{ old('fla_en', optional($corona)->fla_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('fla_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('not_en') ? 'is-invalid' : '' }}">
            <label for="not_en">Notstand ausgerufen - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('not_en') ? 'is-invalid' : '' }} " name="not_en"
                   type="text" id="not_en" value="{{ old('not_en', optional($corona)->not_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('not_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('eol_en') ? 'is-invalid' : '' }}">
            <label for="eol_en">Einschränkungen des öffentlichen Lebens/Inlandsverkehrs; Ausgangssperre - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('eol_en') ? 'is-invalid' : '' }} " name="eol_en"
                   type="text" id="eol_en" value="{{ old('eol_en', optional($corona)->eol_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('eol_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('vre_en') ? 'is-invalid' : '' }}">
            <label for="vre_en">Visaregime verändert - EN</label>
            <input class="form-control form-control-alt {{ $errors->has('vre_en') ? 'is-invalid' : '' }} " name="vre_en"
                   type="text" id="vre_en" value="{{ old('vre_en', optional($corona)->vre_en) }}" maxlength="150"
                   placeholder="Enter english content here...">
            {!! $errors->first('vre_en', '<p class="invalid-feedback">:message</p>') !!}
        </div>



    </div>

</div>
</div>
