<div class="row">
    <div class="col-sm-10 col-md-4">
        <div class="form-group row {{ $errors->has('revised') ? 'is-invalid' : '' }}">
            <div class="col-md-10">
                <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
                    <input type="checkbox" class="custom-control-input"
                           id="revised" name="revised" {{ old('revised', optional($usersweb)->revised) == 1 ? 'checked' : '' }}/>
                    <label class="custom-control-label" for="revised">not revised / revised</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-4">
        <div class="form-group row {{ $errors->has('active') ? 'is-invalid' : '' }}">
            <div class="col-md-10">
                <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
                    <input type="checkbox" class="custom-control-input"
                           id="active" name="active" {{ old('active', optional($usersweb)->active) == 1 ? 'checked' : '' }}/>
                    <label class="custom-control-label" for="active">inactive / active</label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Zoho<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-12">
        <div class="form-group {{ $errors->has('zohoAccountID') ? 'is-invalid' : '' }}">
            <label for="zohoAccountID" class="col-md-12 control-label">CRM ID</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="zohoAccountID" type="text" id="zohoAccountID" value="{{ old('zohoAccountID', optional($usersweb)->zohoAccountID) }}" min="0" max="100" placeholder="Enter zoho account id here...">
                {!! $errors->first('zohoAccountID', '<p class="invalid-feedback">:message</p>') !!}
                <a href="{!! env('ZOHO_CRM_USER_URL') !!}/{{ optional($usersweb)->zohoAccountID }}" target="_blank" type="button" class="btn btn-sm btn-info" style="margin-top:15px;">open into CRM</a>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:0px;">
    <h2 class="content-heading">Address<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('realname') ? 'is-invalid' : '' }}">
            <label for="realname" class="col-md-12 control-label">Company / Longname</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="realname" type="text" id="realname" value="{{ old('realname', optional($usersweb)->realname) }}" maxlength="100" placeholder="Enter realname here...">
                {!! $errors->first('realname', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('assignto') ? 'is-invalid' : '' }}">
            <label for="assignto" class="col-md-12 control-label">Assign to Client</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="assignto" type="number" id="assignto" value="{{ old('assignto', optional($usersweb)->assignto) }}" placeholder="Enter ID of parent here...">
                {!! $errors->first('assignto', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('forename') ? 'is-invalid' : '' }}">
            <label for="forename" class="col-md-12 control-label">Forename</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="forename" type="text" id="forename" value="{{ old('forename', optional($usersweb)->forename) }}" maxlength="50" placeholder="Enter forename here...">
                {!! $errors->first('forename', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('idpaymentuser') ? 'is-invalid' : '' }}">
            <label for="idpaymentuser" class="col-md-12 control-label">Payment Client</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="idpaymentuser" type="number" id="idpaymentuser" value="{{ old('idpaymentuser', optional($usersweb)->idpaymentuser) }}" placeholder="Enter idpaymentuser here...">
                {!! $errors->first('idpaymentuser', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('surname') ? 'is-invalid' : '' }}">
            <label for="surname" class="col-md-12 control-label">Surname</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="surname" type="text" id="surname" value="{{ old('surname', optional($usersweb)->surname) }}" maxlength="50" placeholder="Enter surname here...">
                {!! $errors->first('surname', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('accounttype') ? 'is-invalid' : '' }}">
            <label for="accounttype" class="col-md-12 control-label">Account type</label>
            <div class="col-md-12">
            <select class="form-control form-control-alt {{ $errors->has('accounttype') ? 'is-invalid' : '' }}" id="accounttype"
                    name="accounttype">
                <option value="">choose</option>
                    <option value="1" @if(isset($usersweb->accounttype))
                    @if ($usersweb->accounttype == old('accounttype', 1))
                    selected="selected"
                        @endif
                        @endif
                    >Testaccount Tour Operator</option>

                <option value="2" @if(isset($usersweb->accounttype))
                @if ($usersweb->accounttype == old('accounttype', 2))
                selected="selected"
                    @endif
                    @endif
                >Testaccount Travel Agency</option>

                <option value="3" @if(isset($usersweb->accounttype))
                @if ($usersweb->accounttype == old('accounttype', 3))
                selected="selected"
                    @endif
                    @endif
                >Tour Operator</option>

                <option value="4" @if(isset($usersweb->accounttype))
                @if ($usersweb->accounttype == old('accounttype', 4))
                selected="selected"
                    @endif
                    @endif
                >Travel Agency</option>

                <option value="5" @if(isset($usersweb->accounttype))
                @if ($usersweb->accounttype == old('accounttype', 5))
                selected="selected"
                    @endif
                    @endif
                >Travel Consultant</option>
            </select>
            {!! $errors->first('accounttype', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('address1') ? 'is-invalid' : '' }}">
            <label for="address1" class="col-md-12 control-label">Address</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="address1" type="text" id="address1" value="{{ old('address1', optional($usersweb)->address1) }}" maxlength="150" placeholder="Enter address1 here...">
                {!! $errors->first('address1', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('clienttype') ? 'is-invalid' : '' }}">
            <label for="clienttype" class="col-md-12 control-label">Client type</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="clienttype" type="number" id="clienttype" value="{{ old('clienttype', optional($usersweb)->clienttype) }}" placeholder="Enter clienttype here...">
                {!! $errors->first('clienttype', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('zip') ? 'is-invalid' : '' }}">
            <label for="zip" class="col-md-12 control-label">Zip</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="zip" type="text" id="zip" value="{{ old('zip', optional($usersweb)->zip) }}" maxlength="10" placeholder="Enter zip here...">
                {!! $errors->first('zip', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('officeNum') ? 'is-invalid' : '' }}">
            <label for="officeNum" class="col-md-12 control-label">Number of Offices</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="officeNum" type="number" id="officeNum" value="{{ old('officeNum', optional($usersweb)->officeNum) }}" placeholder="Enter office num here...">
                {!! $errors->first('officeNum', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('city') ? 'is-invalid' : '' }}">
            <label for="city" class="col-md-12 control-label">City</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="city" type="text" id="city" value="{{ old('city', optional($usersweb)->city) }}" maxlength="50" placeholder="Enter city here...">
                {!! $errors->first('city', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('techaccess') ? 'is-invalid' : '' }}">
            <label for="techaccess" class="col-md-12 control-label">Technical access</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="techaccess" type="number" id="techaccess" value="{{ old('techaccess', optional($usersweb)->techaccess) }}" placeholder="Enter techaccess here...">
                {!! $errors->first('techaccess', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('phone') ? 'is-invalid' : '' }}">
            <label for="phone" class="col-md-12 control-label">Phone</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="phone" type="text" id="phone" value="{{ old('phone', optional($usersweb)->phone) }}" maxlength="50" placeholder="Enter phone here...">
                {!! $errors->first('phone', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('cooperation') ? 'is-invalid' : '' }}">
            <label for="cooperation" class="col-md-12 control-label">Cooperation / Chain</label>
            <div class="col-md-12">
                <select class="js-select2 form-control" id="cooperation"
                        name="cooperation[]"
                        data-placeholder="Choose many.." multiple>
                    <option></option>
                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    @foreach($adrheadcooperations as $adrheadcooperation)
                        <option value="{{ $adrheadcooperation->code }}"
                            @if (in_array($adrheadcooperation->code, $usersweb->cooperation ?? []))
                                selected="selected"
                            @endif
                        >{{ $adrheadcooperation->content_en }}({{ $adrheadcooperation->code }})</option>
                    @endforeach
                </select>
                {!! $errors->first('cooperation', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
            <label for="email" class="col-md-12 control-label">Email</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="email" type="text" id="email" value="{{ old('email', optional($usersweb)->email) }}" maxlength="50" placeholder="Enter email here...">
                {!! $errors->first('email', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('tags') ? 'is-invalid' : '' }}">
            <label for="tags" class="col-md-12 control-label">Tags</label>
            <div class="col-md-12">
                <select class="js-select2 form-control" id="tags"
                        name="tags[]"
                        data-placeholder="Choose many.." multiple>
                    <option></option>
                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    @foreach($adrheadtags as $adrheadtag)
                        <option value="{{ $adrheadtag->code }}"
                            @if (in_array($adrheadtag->code, $usersweb->tags ?? []))
                                selected="selected"
                            @endif
                        >{{ $adrheadtag->content_en }}({{ $adrheadtag->code }})</option>
                    @endforeach
                </select>
                {!! $errors->first('tags', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Additional Infos<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('info1') ? 'is-invalid' : '' }}">
            <label for="info1" class="col-md-12 control-label">Info 1</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="info1" type="text" id="info1" value="{{ old('info1', optional($usersweb)->info1) }}" maxlength="30" placeholder="Enter info 1 here...">
                {!! $errors->first('info1', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('info4') ? 'is-invalid' : '' }}">
            <label for="info4" class="col-md-12 control-label">Info 4</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="info4" type="text" id="info4" value="{{ old('info4', optional($usersweb)->info4) }}" maxlength="30" placeholder="Enter info 4 here...">
                {!! $errors->first('info4', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('info2') ? 'is-invalid' : '' }}">
            <label for="info2" class="col-md-12 control-label">Info 2</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="info2" type="text" id="info2" value="{{ old('info2', optional($usersweb)->info2) }}" maxlength="30" placeholder="Enter info 2 here...">
                {!! $errors->first('info2', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('info5') ? 'is-invalid' : '' }}">
            <label for="info5" class="col-md-12 control-label">Info 5</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="info5" type="text" id="info5" value="{{ old('info5', optional($usersweb)->info5) }}" maxlength="30" placeholder="Enter info 5 here...">
                {!! $errors->first('info5', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('info3') ? 'is-invalid' : '' }}">
            <label for="info3" class="col-md-12 control-label">Info 3</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="info3" type="text" id="info3" value="{{ old('info3', optional($usersweb)->info3) }}" maxlength="30" placeholder="Enter info 3 here...">
                {!! $errors->first('info3', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('info6') ? 'is-invalid' : '' }}">
            <label for="info6" class="col-md-12 control-label">Info 6</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="info6" type="text" id="info6" value="{{ old('info6', optional($usersweb)->info6) }}" maxlength="30" placeholder="Enter info 6 here...">
                {!! $errors->first('info6', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-12">
        <div class="form-group {{ $errors->has('note') ? 'is-invalid' : '' }}">
            <label for="note" class="col-md-12 control-label">Note</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="note" type="text" id="note" value="{{ old('note', optional($usersweb)->note) }}" maxlength="255">
                {!! $errors->first('note', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Access Infos<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('username') ? 'is-invalid' : '' }}">
            <label for="username" class="col-md-12 control-label">Username</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="username" type="text" id="username" value="{{ old('username', optional($usersweb)->username) }}" maxlength="50" placeholder="Enter username here...">
                {!! $errors->first('username', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('testvalidity') ? 'is-invalid' : '' }}">
            <label for="testvalidity" class="col-md-12 control-label">Test validity</label>
            <div class="col-md-12">
                <input class="js-datepicker form-control form-control-alt {{ $errors->has('testvalidity') ? 'is-invalid' : '' }}"
                       name="testvalidity" type="text" id="testvalidity" data-week-start="1" data-autoclose="true"
                       data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                       value="{{ old('testvalidity', optional($usersweb)->testvalidity) }}"
                       placeholder="Enter testvalidity here...">
                {!! $errors->first('testvalidity', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
            <label for="password" class="col-md-12 control-label">Password</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="password" type="text" id="password" maxlength="50" placeholder="Enter password here...">
                {!! $errors->first('password', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('testrenewals') ? 'is-invalid' : '' }}">
            <label for="testrenewals" class="col-md-12 control-label">Test renewals</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="testrenewals" type="number" id="testrenewals" value="{{ old('testrenewals', optional($usersweb)->testrenewals) }}" placeholder="Enter testrenewals here...">
                {!! $errors->first('testrenewals', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('secureanswer') ? 'is-invalid' : '' }}">
            <label for="secureanswer" class="col-md-12 control-label">Password Text</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="secureanswer" type="text" id="secureanswer" value="{{ old('secureanswer', optional($usersweb)->secureanswer) }}" maxlength="255" placeholder="Enter password text here...">
                {!! $errors->first('secureanswer', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('canceltype') ? 'is-invalid' : '' }}">
            <label for="canceltype" class="col-md-12 control-label">Cancel type</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="canceltype" type="number" id="canceltype" value="{{ old('canceltype', optional($usersweb)->canceltype) }}" placeholder="Enter canceltype here...">
                {!! $errors->first('canceltype', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('livefrom') ? 'is-invalid' : '' }}">
            <label for="livefrom" class="col-md-12 control-label">Live from</label>
            <div class="col-md-12">
                <input class="js-datepicker form-control form-control-alt {{ $errors->has('livefrom') ? 'is-invalid' : '' }}"
                       name="livefrom" type="text" id="livefrom" data-week-start="1" data-autoclose="true"
                       data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                       value="{{ old('livefrom', optional($usersweb)->livefrom) }}"
                       placeholder="Enter livefrom here...">
                {!! $errors->first('livefrom', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('canceldate') ? 'is-invalid' : '' }}">
            <label for="canceldate" class="col-md-12 control-label">Cancel date</label>
            <div class="col-md-12">
                <input class="js-datepicker form-control form-control-alt {{ $errors->has('canceldate') ? 'is-invalid' : '' }}"
                       name="canceldate" type="text" id="canceldate" data-week-start="1" data-autoclose="true"
                       data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                       value="{{ old('canceldate', optional($usersweb)->canceldate) }}"
                       placeholder="Enter canceldate here...">
                {!! $errors->first('canceldate', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('endofuse') ? 'is-invalid' : '' }}">
            <label for="endofuse" class="col-md-12 control-label">End of use</label>
            <div class="col-md-12">
                <input class="js-datepicker form-control form-control-alt {{ $errors->has('endofuse') ? 'is-invalid' : '' }}"
                       name="endofuse" type="text" id="endofuse" data-week-start="1" data-autoclose="true"
                       data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
                       value="{{ old('endofuse', optional($usersweb)->endofuse) }}"
                       placeholder="Enter endofuse here...">
                {!! $errors->first('endofuse', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('level') ? 'is-invalid' : '' }}">
            <label for="level" class="col-md-12 control-label">Level</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="level" type="number" id="level" value="{{ old('level', optional($usersweb)->level) }}" min="0" max="999" required="true" placeholder="Enter level here...">
                {!! $errors->first('level', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">

    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('role') ? 'is-invalid' : '' }}">
            <label for="role" class="col-md-12 control-label">Role</label>
            <div class="col-md-12">
                <select class="form-control form-control-alt {{ $errors->has('role') ? 'is-invalid' : '' }}" id="role"
                        name="role">
                    <option value="">choose</option>
                    <option value="Webuser" @if(isset($usersweb->role))
                    @if ($usersweb->role == old('role', 'Webuser'))
                    selected="selected"
                        @endif
                        @endif
                    >Passolution Client</option>

                    <option value="Member" @if(isset($usersweb->role))
                    @if ($usersweb->role == old('role', 'Member'))
                    selected="selected"
                        @endif
                        @endif
                    >Passolution Employee</option>

                    <option value="Admin" @if(isset($usersweb->role))
                    @if ($usersweb->role == old('role', 'Admin'))
                    selected="selected"
                        @endif
                        @endif
                    >Passolution Admin</option>
                </select>
                {!! $errors->first('role', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Access to Providers<span class="client-details"></span></h2>
</div>

<div class="form-group {{ $errors->has('providers') ? 'is-invalid' : '' }}">
    <div class="row">
    @foreach ($adrheadsoftwareproviders as $adrheadsoftwareprovider)
        <div class="col-sm-10 col-md-4" style="padding-left: 30px;">
            <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
                <input type="checkbox" class="custom-control-input"
                        id="provider-{{ $adrheadsoftwareprovider->code }}" name="providers[]" value="{{ $adrheadsoftwareprovider->code }}" {{ in_array($adrheadsoftwareprovider->code, $usersweb->providers ?? []) ? 'checked' : '' }}/>
                <label class="custom-control-label" for="provider-{{ $adrheadsoftwareprovider->code }}">{{ $adrheadsoftwareprovider->content_en }}</label>
            </div>
        </div>
    @endforeach
    </div>
</div>

<div class="row" style="margin-top:30px;">
    <div class="col-sm-10 col-md-12">
        <div class="form-group {{ $errors->has('agency') ? 'is-invalid' : '' }}">
            <label for="agency" class="col-md-12 control-label">myJACK Unit ID</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="agency" type="text" id="agency" value="{{ old('agency', optional($usersweb)->agency) }}" min="0" max="20" placeholder="Enter agency here...">
                {!! $errors->first('agency', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Visa settings<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('showvisaservice') ? 'is-invalid' : '' }}">
            <label for="showvisaservice" class="col-md-12 control-label">Show visa service</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="showvisaservice" type="number" id="showvisaservice" value="{{ old('showvisaservice', optional($usersweb)->showvisaservice) }}" placeholder="Enter showvisaservice here...">
                {!! $errors->first('showvisaservice', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('visaplaces') ? 'is-invalid' : '' }}">
            <label for="visaplaces" class="col-md-12 control-label">Visa places</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="visaplaces" type="text" id="visaplaces" value="{{ old('visaplaces', optional($usersweb)->visaplaces) }}" minlength="1" maxlength="20" required="true" placeholder="Enter visaplaces here...">
                {!! $errors->first('visaplaces', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('showvisaservicelink') ? 'is-invalid' : '' }}">
            <label for="showvisaservicelink" class="col-md-12 control-label">Show visa service link</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="showvisaservicelink" type="text" id="showvisaservicelink" value="{{ old('showvisaservicelink', optional($usersweb)->showvisaservicelink) }}" maxlength="250" placeholder="Enter showvisaservicelink here...">
                {!! $errors->first('showvisaservicelink', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('showvisaservicetext') ? 'is-invalid' : '' }}">
            <label for="showvisaservicetext" class="col-md-12 control-label">Show visa service text</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="showvisaservicetext" type="text" id="showvisaservicetext" value="{{ old('showvisaservicetext', optional($usersweb)->showvisaservicetext) }}" maxlength="1000" placeholder="Enter showvisaservicetext here...">
                {!! $errors->first('showvisaservicetext', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Direct Link Settings<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('linkmaxopen') ? 'is-invalid' : '' }}">
            <label for="linkmaxopen" class="col-md-12 control-label">Link max open</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="linkmaxopen" type="number" id="linkmaxopen" value="{{ old('linkmaxopen', optional($usersweb)->linkmaxopen) }}" placeholder="Enter link max open here...">
                {!! $errors->first('linkmaxopen', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('linkmaxtodeparture') ? 'is-invalid' : '' }}">
            <label for="linkmaxtodeparture" class="col-md-12 control-label">Link max to departure</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="linkmaxtodeparture" type="number" id="linkmaxtodeparture" value="{{ old('linkmaxtodeparture', optional($usersweb)->linkmaxtodeparture) }}" placeholder="Enter link max to departure here...">
                {!! $errors->first('linkmaxtodeparture', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('linkmaxfromcreate') ? 'is-invalid' : '' }}">
            <label for="linkmaxfromcreate" class="col-md-12 control-label">Link max from create</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="linkmaxfromcreate" type="number" id="linkmaxfromcreate" value="{{ old('linkmaxfromcreate', optional($usersweb)->linkmaxfromcreate) }}" placeholder="Enter link max from create here...">
                {!! $errors->first('linkmaxfromcreate', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Settings web.passolution.eu<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('favdestination') ? 'is-invalid' : '' }}">
            <label for="favdestination" class="col-md-12 control-label">Favorites destination</label>
            <div class="col-md-12">
                <select class="js-select2 form-control" id="favdestination"
                        name="favdestination[]"
                        data-placeholder="Choose many.." multiple>
                    <option></option>
                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    @foreach($countries as $country)
                        <option value="{{ $country->code }}"
                            @if (in_array($country->code, $usersweb->favdestination ?? []))
                                selected="selected"
                            @endif
                        >{{ $country->name_en }}({{ $country->code }})</option>
                    @endforeach
                </select>
                {!! $errors->first('favdestination', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('favlanguage') ? 'is-invalid' : '' }}">
            <label for="favlanguage" class="col-md-12 control-label">Favorite language</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="favlanguage" type="text" id="favlanguage" value="{{ old('favlanguage', optional($usersweb)->favlanguage) }}" min="0" max="2" placeholder="Enter favorite language here...">
                {!! $errors->first('favlanguage', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('favnationality') ? 'is-invalid' : '' }}">
            <label for="favnationality" class="col-md-12 control-label">Favorites nationality</label>
            <div class="col-md-12">
                <select class="js-select2 form-control" id="favnationality"
                        name="favnationality[]"
                        data-placeholder="Choose many.." multiple>
                    <option></option>
                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    @foreach($nationalities as $nationality)
                        <option value="{{ $nationality->code }}"
                            @if (in_array($nationality->code, $usersweb->favnationality ?? []))
                                selected="selected"
                            @endif
                        >{{ $nationality->name_en }}({{ $nationality->code }})</option>
                    @endforeach
                </select>
                {!! $errors->first('favnationality', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('sitelanguage') ? 'is-invalid' : '' }}">
            <label for="sitelanguage" class="col-md-12 control-label">Site language</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="sitelanguage" type="text" id="sitelanguage" value="{{ old('sitelanguage', optional($usersweb)->sitelanguage) }}" min="0" max="2" placeholder="Enter site language here...">
                {!! $errors->first('sitelanguage', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('logo') ? 'is-invalid' : '' }}">
            <label for="logo" class="col-md-12 control-label">Logo</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="logo" type="text" id="logo" value="{{ old('logo', optional($usersweb)->logo) }}" maxlength="255" placeholder="Enter logo here...">
                {!! $errors->first('logo', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">

    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">

    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">

    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Fees<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('feeinstall') ? 'is-invalid' : '' }}">
            <label for="feeinstall" class="col-md-12 control-label">Fee install</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="feeinstall" type="number" id="feeinstall" value="{{ old('feeinstall', optional($usersweb)->feeinstall) }}" placeholder="Enter feeinstall here..." step="any">
                {!! $errors->first('feeinstall', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('feeinterval') ? 'is-invalid' : '' }}">
            <label for="feeinterval" class="col-md-12 control-label">Fee interval</label>
            <div class="col-md-12">
                <select class="form-control form-control-alt {{ $errors->has('feeinterval') ? 'is-invalid' : '' }}" id="feeinterval"
                        name="feeinterval">
                    <option value="">choose</option>
                    <option value="1" @if(isset($usersweb->feeinterval))
                    @if ($usersweb->feeinterval == old('feeinterval', 1))
                    selected="selected"
                        @endif
                        @endif
                    >monthly</option>

                    <option value="2" @if(isset($usersweb->feeinterval))
                    @if ($usersweb->feeinterval == old('feeinterval', 2))
                    selected="selected"
                        @endif
                        @endif
                    >annually</option>
                </select>
                {!! $errors->first('feeinterval', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('feemonth') ? 'is-invalid' : '' }}">
            <label for="feemonth" class="col-md-12 control-label">Fee month</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="feemonth" type="number" id="feemonth" value="{{ old('feemonth', optional($usersweb)->feemonth) }}" placeholder="Enter feemonth here..." step="any">
                {!! $errors->first('feemonth', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>

<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Requests<span class="client-details"></span></h2>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('access2018') ? 'is-invalid' : '' }}">
            <label for="access2018" class="col-md-12 control-label">2018</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="access2018" type="number" id="access2018" value="{{ old('access2018', optional($usersweb)->access2018) }}" placeholder="Enter 2018 here...">
                {!! $errors->first('access2018', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('access2019') ? 'is-invalid' : '' }}">
            <label for="access2019" class="col-md-12 control-label">2019</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="access2019" type="number" id="access2019" value="{{ old('access2019', optional($usersweb)->access2019) }}" placeholder="Enter 2019 here...">
                {!! $errors->first('access2019', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('access2020') ? 'is-invalid' : '' }}">
            <label for="access2020" class="col-md-12 control-label">2020</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="access2020" type="number" id="access2020" value="{{ old('access2020', optional($usersweb)->access2020) }}" placeholder="Enter 2020 here...">
                {!! $errors->first('access2020', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('access2021') ? 'is-invalid' : '' }}">
            <label for="access2021" class="col-md-12 control-label">2021</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="access2021" type="number" id="access2021" value="{{ old('access2021', optional($usersweb)->access2021) }}" placeholder="Enter 2021 here...">
                {!! $errors->first('access2021', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-md-6">
        <div class="form-group {{ $errors->has('access2022') ? 'is-invalid' : '' }}">
            <label for="access2022" class="col-md-12 control-label">2022</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="access2022" type="number" id="access2022" value="{{ old('access2022', optional($usersweb)->access2022) }}" placeholder="Enter 2022 here...">
                {!! $errors->first('access2022', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>

<br><br><br><br><br>
<div class="row">
    <div class="col-sm-10 col-md-6">

    </div>
    <div class="col-sm-10 col-md-6">

    </div>
</div>


<div class="col-sm-10 col-md-12" style="margin-top:20px;">
    <h2 class="content-heading">Other settings<span class="client-details"></span></h2>
</div>


<div class="form-group {{ $errors->has('poa') ? 'is-invalid' : '' }}">
    <label for="poa" class="col-md-12 control-label">Agency Address Position</label>
    <div class="col-md-12">
        <select class="form-control form-control-alt {{ $errors->has('poa') ? 'is-invalid' : '' }}" id="poa"
                name="poa">
            <option value="">choose</option>
            <option value="1" @if(isset($usersweb->poa))
            @if ($usersweb->poa == old('poa', 1))
            selected="selected"
                @endif
                @endif
            >After Health Information</option>

            <option value="2" @if(isset($usersweb->poa))
            @if ($usersweb->poa == old('poa', 2))
            selected="selected"
                @endif
                @endif
            >After Entry</option>

            <option value="3" @if(isset($usersweb->poa))
            @if ($usersweb->poa == old('poa', 3))
            selected="selected"
                @endif
                @endif
            >After Visa</option>

            <option value="4" @if(isset($usersweb->poa))
            @if ($usersweb->poa == old('poa', 4))
            selected="selected"
                @endif
                @endif
            >After Transitvisa</option>
        </select>
        {!! $errors->first('accounttype', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('mailable') ? 'is-invalid' : '' }}">
            <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
                <input type="checkbox" class="custom-control-input"
                        id="mailable" name="mailable" {{ old('mailable', optional($usersweb)->mailable) == 1 ? 'checked' : '' }}/>
                <label class="custom-control-label" for="mailable">not mailable / mailable</label>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('usereport') ? 'is-invalid' : '' }}">
            <label for="usereport" class="col-md-12 control-label">Use report</label>
            <div class="col-md-12">
                <input class="form-control form-control-alt" name="usereport" type="number" id="usereport" value="{{ old('usereport', optional($usersweb)->usereport) }}" placeholder="Enter link max from create here...">
                {!! $errors->first('usereport', '<p class="invalid-feedback">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group row {{ $errors->has('birthday') ? 'is-invalid' : '' }}">
    <label for="birthday" class="col-md-2 control-label">Birthday</label>
    <div class="col-md-10">
        <input class="js-datepicker form-control form-control-alt {{ $errors->has('birthday') ? 'is-invalid' : '' }}"
               name="birthday" type="text" id="birthday" data-week-start="1" data-autoclose="true"
               data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
               value="{{ old('birthday', optional($usersweb)->birthday) }}"
               placeholder="Enter birthday here...">
        {!! $errors->first('birthday', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>






<div class="form-group row {{ $errors->has('idcontact') ? 'is-invalid' : '' }}">
    <label for="idcontact" class="col-md-2 control-label">Idcontact</label>
    <div class="col-md-10">
        <input class="form-control" name="idcontact" type="number" id="idcontact" value="{{ old('idcontact', optional($usersweb)->idcontact) }}" placeholder="Enter idcontact here...">
        {!! $errors->first('idcontact', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('idsec') ? 'is-invalid' : '' }}">
    <label for="idsec" class="col-md-2 control-label">Idsec</label>
    <div class="col-md-10">
        <input class="form-control" name="idsec" type="text" id="idsec" value="{{ old('idsec', optional($usersweb)->idsec) }}" maxlength="50" placeholder="Enter idsec here...">
        {!! $errors->first('idsec', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>









<div class="form-group row {{ $errors->has('activationpassword') ? 'is-invalid' : '' }}">
    <label for="activationpassword" class="col-md-2 control-label">Activationpassword</label>
    <div class="col-md-10">
        <input class="form-control" name="activationpassword" type="text" id="activationpassword" value="{{ old('activationpassword', optional($usersweb)->activationpassword) }}" maxlength="50" placeholder="Enter activationpassword here...">
        {!! $errors->first('activationpassword', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('securequestion') ? 'is-invalid' : '' }}">
    <label for="securequestion" class="col-md-2 control-label">Securequestion</label>
    <div class="col-md-10">
        <input class="form-control" name="securequestion" type="text" id="securequestion" value="{{ old('securequestion', optional($usersweb)->securequestion) }}" maxlength="255" placeholder="Enter securequestion here...">
        {!! $errors->first('securequestion', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>





















<div class="form-group row {{ $errors->has('accessmaxyear') ? 'is-invalid' : '' }}">
    <label for="accessmaxyear" class="col-md-2 control-label">Accessmaxyear</label>
    <div class="col-md-10">
        <input class="form-control" name="accessmaxyear" type="number" id="accessmaxyear" value="{{ old('accessmaxyear', optional($usersweb)->accessmaxyear) }}" placeholder="Enter accessmaxyear here...">
        {!! $errors->first('accessmaxyear', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>






















































<div class="form-group row {{ $errors->has('remember_token') ? 'is-invalid' : '' }}">
    <label for="remember_token" class="col-md-2 control-label">Remember Token</label>
    <div class="col-md-10">
        <input class="form-control" name="remember_token" type="text" id="remember_token" value="{{ old('remember_token', optional($usersweb)->remember_token) }}" maxlength="255" placeholder="Enter remember token here...">
        {!! $errors->first('remember_token', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>













<div class="form-group row {{ $errors->has('street') ? 'is-invalid' : '' }}">
    <label for="street" class="col-md-2 control-label">Street</label>
    <div class="col-md-10">
        <input class="form-control" name="street" type="text" id="street" value="{{ old('street', optional($usersweb)->street) }}" maxlength="255" placeholder="Enter street here...">
        {!! $errors->first('street', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('land') ? 'is-invalid' : '' }}">
    <label for="land" class="col-md-2 control-label">Land</label>
    <div class="col-md-10">
        <input class="form-control" name="land" type="text" id="land" value="{{ old('land', optional($usersweb)->land) }}" maxlength="10" placeholder="Enter land here...">
        {!! $errors->first('land', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('handy') ? 'is-invalid' : '' }}">
    <label for="handy" class="col-md-2 control-label">Handy</label>
    <div class="col-md-10">
        <input class="form-control" name="handy" type="text" id="handy" value="{{ old('handy', optional($usersweb)->handy) }}" maxlength="30" placeholder="Enter handy here...">
        {!! $errors->first('handy', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('fax') ? 'is-invalid' : '' }}">
    <label for="fax" class="col-md-2 control-label">Fax</label>
    <div class="col-md-10">
        <input class="form-control" name="fax" type="text" id="fax" value="{{ old('fax', optional($usersweb)->fax) }}" maxlength="30" placeholder="Enter fax here...">
        {!! $errors->first('fax', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('website') ? 'is-invalid' : '' }}">
    <label for="website" class="col-md-2 control-label">Website</label>
    <div class="col-md-10">
        <input class="form-control" name="website" type="text" id="website" value="{{ old('website', optional($usersweb)->website) }}" maxlength="100" placeholder="Enter website here...">
        {!! $errors->first('website', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('nameAccount') ? 'is-invalid' : '' }}">
    <label for="nameAccount" class="col-md-2 control-label">Name Account</label>
    <div class="col-md-10">
        <input class="form-control" name="nameAccount" type="text" id="nameAccount" value="{{ old('nameAccount', optional($usersweb)->nameAccount) }}" min="0" max="100" placeholder="Enter name account here...">
        {!! $errors->first('nameAccount', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('bank') ? 'is-invalid' : '' }}">
    <label for="bank" class="col-md-2 control-label">Bank</label>
    <div class="col-md-10">
        <input class="form-control" name="bank" type="text" id="bank" value="{{ old('bank', optional($usersweb)->bank) }}" maxlength="100" placeholder="Enter bank here...">
        {!! $errors->first('bank', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('theywere') ? 'is-invalid' : '' }}">
    <label for="theywere" class="col-md-2 control-label">Theywere</label>
    <div class="col-md-10">
        <input class="form-control" name="theywere" type="text" id="theywere" value="{{ old('theywere', optional($usersweb)->theywere) }}" maxlength="50" placeholder="Enter theywere here...">
        {!! $errors->first('theywere', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('bic') ? 'is-invalid' : '' }}">
    <label for="bic" class="col-md-2 control-label">Bic</label>
    <div class="col-md-10">
        <input class="form-control" name="bic" type="text" id="bic" value="{{ old('bic', optional($usersweb)->bic) }}" maxlength="50" placeholder="Enter bic here...">
        {!! $errors->first('bic', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('ust') ? 'is-invalid' : '' }}">
    <label for="ust" class="col-md-2 control-label">Ust</label>
    <div class="col-md-10">
        <input class="form-control" name="ust" type="text" id="ust" value="{{ old('ust', optional($usersweb)->ust) }}" maxlength="50" placeholder="Enter ust here...">
        {!! $errors->first('ust', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('comment') ? 'is-invalid' : '' }}">
    <label for="comment" class="col-md-2 control-label">Comment</label>
    <div class="col-md-10">
        <input class="form-control" name="comment" type="text" id="comment" value="{{ old('comment', optional($usersweb)->comment) }}" maxlength="255" placeholder="Enter comment here...">
        {!! $errors->first('comment', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('providers1') ? 'is-invalid' : '' }}">
    <label>Providers1</label>
    <div class="row">
    @foreach ($adrheadsoftwareproviders as $adrheadsoftwareprovider)
        <div class="col-sm-10 col-md-4" style="padding-left: 30px;">
            <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
                <input type="checkbox" class="custom-control-input"
                        id="provider1-{{ $adrheadsoftwareprovider->code }}" name="providers1[]" value="{{ $adrheadsoftwareprovider->code }}" {{ in_array($adrheadsoftwareprovider->code, $usersweb->providers1 ?? []) ? 'checked' : '' }}/>
                <label class="custom-control-label" for="provider1-{{ $adrheadsoftwareprovider->code }}">{{ $adrheadsoftwareprovider->content_en }}</label>
            </div>
        </div>
    @endforeach
    </div>
</div>


