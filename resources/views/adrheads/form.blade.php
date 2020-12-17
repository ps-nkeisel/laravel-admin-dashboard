
<div class="form-group row {{ $errors->has('idcrm') ? 'is-invalid' : '' }}">
    <label for="idcrm" class="col-md-2 control-label">Idcrm</label>
    <div class="col-md-10">
        <input class="form-control" name="idcrm" type="number" id="idcrm" value="{{ old('idcrm', optional($adrhead)->idcrm) }}" min="-2147483648" max="2147483647" placeholder="Enter idcrm here...">
        {!! $errors->first('idcrm', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('idsubscription') ? 'is-invalid' : '' }}">
    <label for="idsubscription" class="col-md-2 control-label">Idsubscription</label>
    <div class="col-md-10">
        <input class="form-control" name="idsubscription" type="number" id="idsubscription" value="{{ old('idsubscription', optional($adrhead)->idsubscription) }}" min="-2147483648" max="2147483647" placeholder="Enter idsubscription here...">
        {!! $errors->first('idsubscription', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('idsupport') ? 'is-invalid' : '' }}">
    <label for="idsupport" class="col-md-2 control-label">Idsupport</label>
    <div class="col-md-10">
        <input class="form-control" name="idsupport" type="number" id="idsupport" value="{{ old('idsupport', optional($adrhead)->idsupport) }}" min="-2147483648" max="2147483647" placeholder="Enter idsupport here...">
        {!! $errors->first('idsupport', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('idparrent') ? 'is-invalid' : '' }}">
    <label for="idparrent" class="col-md-2 control-label">Idparrent</label>
    <div class="col-md-10">
        <input class="form-control" name="idparrent" type="number" id="idparrent" value="{{ old('idparrent', optional($adrhead)->idparrent) }}" min="-2147483648" max="2147483647" placeholder="Enter idparrent here...">
        {!! $errors->first('idparrent', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('idchild') ? 'is-invalid' : '' }}">
    <label for="idchild" class="col-md-2 control-label">Idchild</label>
    <div class="col-md-10">
        <input class="form-control" name="idchild" type="number" id="idchild" value="{{ old('idchild', optional($adrhead)->idchild) }}" min="-2147483648" max="2147483647" placeholder="Enter idchild here...">
        {!! $errors->first('idchild', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('matchcode') ? 'is-invalid' : '' }}">
    <label for="matchcode" class="col-md-2 control-label">Matchcode</label>
    <div class="col-md-10">
        <input class="form-control" name="matchcode" type="text" id="matchcode" value="{{ old('matchcode', optional($adrhead)->matchcode) }}" maxlength="100" placeholder="Enter matchcode here...">
        {!! $errors->first('matchcode', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('assign_to') ? 'is-invalid' : '' }}">
    <label for="assign_to" class="col-md-2 control-label">Assign To</label>
    <div class="col-md-10">
        <input class="form-control" name="assign_to" type="number" id="assign_to" value="{{ old('assign_to', optional($adrhead)->assign_to) }}" min="-2147483648" max="2147483647" placeholder="Enter assign to here...">
        {!! $errors->first('assign_to', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('adr_head_kind_id') ? 'is-invalid' : '' }}">
    <label for="adr_head_kind_id" class="col-md-2 control-label">Adr Head kind</label>
    <div class="col-md-10">
        <select class="form-control js-select2" id="adr_head_kind_id" name="adr_head_kind_id">
            <option></option>
        	@foreach ($adrheadkinds as $adrheadkind)
			    <option value="{{ $adrheadkind->id }}" {{ old('adr_head_kind_id', optional($adrhead)->adr_head_kind_id) == $adrheadkind->id ? 'selected' : '' }}>
			    	{{ $adrheadkind->content_en }}
			    </option>
			@endforeach
        </select>
        {!! $errors->first('adr_head_kind_id', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('adr_head_branch_id') ? 'is-invalid' : '' }}">
    <label for="adr_head_branch_id" class="col-md-2 control-label">Adr Head branch</label>
    <div class="col-md-10">
        <select class="form-control js-select2" id="adr_head_branch_id" name="adr_head_branch_id">
            <option></option>
        	@foreach ($adrheadbranches as $adrheadbranch)
			    <option value="{{ $adrheadbranch->id }}" {{ old('adr_head_branch_id', optional($adrhead)->adr_head_branch_id) == $adrheadbranch->id ? 'selected' : '' }}>
			    	{{ $adrheadbranch->content_en }}
			    </option>
			@endforeach
        </select>
        {!! $errors->first('adr_head_branch_id', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('adr_head_role_id') ? 'is-invalid' : '' }}">
    <label for="adr_head_role_id" class="col-md-2 control-label">Adr Head role</label>
    <div class="col-md-10">
        <select class="form-control js-select2" id="adr_head_role_id" name="adr_head_role_id">
            <option></option>
        	@foreach ($adrheadroles as $adrheadrole)
			    <option value="{{ $adrheadrole->id }}" {{ old('adr_head_role_id', optional($adrhead)->adr_head_role_id) == $adrheadrole->id ? 'selected' : '' }}>
			    	{{ $adrheadrole->content_en }}
			    </option>
			@endforeach
        </select>
        {!! $errors->first('adr_head_role_id', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('accountnr') ? 'is-invalid' : '' }}">
    <label for="accountnr" class="col-md-2 control-label">Accountnr</label>
    <div class="col-md-10">
        <input class="form-control" name="accountnr" type="text" id="accountnr" value="{{ old('accountnr', optional($adrhead)->accountnr) }}" min="0" max="10" placeholder="Enter accountnr here...">
        {!! $errors->first('accountnr', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('birthday') ? 'is-invalid' : '' }}">
    <label for="birthday" class="col-md-2 control-label">Birthday</label>
    <div class="col-md-10">
        <input class="js-datepicker form-control form-control-alt {{ $errors->has('birthday') ? 'is-invalid' : '' }}"
            name="birthday" type="text" id="birthday" data-week-start="1" data-autoclose="true"
            data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"
            value="{{ old('birthday', optional($adrhead)->birthday) }}" maxlength="40"
            placeholder="Enter birthday here...">
        {!! $errors->first('birthday', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('comment') ? 'is-invalid' : '' }}">
    <label for="comment" class="col-md-2 control-label">Comment</label>
    <div class="col-md-10">
        <input class="form-control" name="comment" type="text" id="comment" value="{{ old('comment', optional($adrhead)->comment) }}" maxlength="4294967295" placeholder="Enter comment here...">
        {!! $errors->first('comment', '<p class="invalid-feedback">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('active') ? 'is-invalid' : '' }}">
    <div class="col-md-2">
        <label for="active">Active :</label>
    </div>
    <div class="col-md-10">
        <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
            <input type="checkbox" class="custom-control-input"
                id="active" name="active" {{ old('active', optional($adrhead)->active) == 1 ? 'checked' : '' }}/>
            <label class="custom-control-label" for="active">No / Yes</label>
        </div>
    </div>
</div>

<div class="form-group row {{ $errors->has('active') ? 'is-invalid' : '' }}">
    <div class="col-md-2">
        <label for="deleted">Deleted :</label>
    </div>
    <div class="col-md-10">
        <div class="custom-control custom-switch custom-control-primary custom-control-lg mb-2">
            <input type="checkbox" class="custom-control-input"
                id="deleted" name="deleted" {{ old('deleted', optional($adrhead)->deleted) == 1 ? 'checked' : '' }}/>
            <label class="custom-control-label" for="deleted">No / Yes</label>
        </div>
    </div>
</div>
