
<div class="form-group {{ $errors->has('assignto') ? 'has-error' : '' }}">
    <label for="assignto" class="col-md-2 control-label">Assignto</label>
    <div class="col-md-10">
        <input class="form-control" name="assignto" type="number" id="assignto" value="{{ old('assignto', optional($passCondition)->assignto) }}" min="-2147483648" max="2147483647" required="true" placeholder="Enter assignto here...">
        {!! $errors->first('assignto', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('idversionbefore') ? 'has-error' : '' }}">
    <label for="idversionbefore" class="col-md-2 control-label">Idversionbefore</label>
    <div class="col-md-10">
        <input class="form-control" name="idversionbefore" type="number" id="idversionbefore" value="{{ old('idversionbefore', optional($passCondition)->idversionbefore) }}" min="-2147483648" max="2147483647" placeholder="Enter idversionbefore here...">
        {!! $errors->first('idversionbefore', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('idversionnext') ? 'has-error' : '' }}">
    <label for="idversionnext" class="col-md-2 control-label">Idversionnext</label>
    <div class="col-md-10">
        <input class="form-control" name="idversionnext" type="number" id="idversionnext" value="{{ old('idversionnext', optional($passCondition)->idversionnext) }}" min="-2147483648" max="2147483647" placeholder="Enter idversionnext here...">
        {!! $errors->first('idversionnext', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('version') ? 'has-error' : '' }}">
    <label for="version" class="col-md-2 control-label">Version</label>
    <div class="col-md-10">
        <input class="form-control" name="version" type="number" id="version" value="{{ old('version', optional($passCondition)->version) }}" min="-2147483648" max="2147483647" placeholder="Enter version here...">
        {!! $errors->first('version', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('idcountry') ? 'has-error' : '' }}">
    <label for="idcountry" class="col-md-2 control-label">Idcountry</label>
    <div class="col-md-10">
        <input class="form-control" name="idcountry" type="number" id="idcountry" value="{{ old('idcountry', optional($passCondition)->idcountry) }}" min="-2147483648" max="2147483647" placeholder="Enter idcountry here...">
        {!! $errors->first('idcountry', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('countryfromcode') ? 'has-error' : '' }}">
    <label for="countryfromcode" class="col-md-2 control-label">Countryfromcode</label>
    <div class="col-md-10">
        <input class="form-control" name="countryfromcode" type="text" id="countryfromcode" value="{{ old('countryfromcode', optional($passCondition)->countryfromcode) }}" min="0" max="50" placeholder="Enter countryfromcode here...">
        {!! $errors->first('countryfromcode', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('countrytocode') ? 'has-error' : '' }}">
    <label for="countrytocode" class="col-md-2 control-label">Countrytocode</label>
    <div class="col-md-10">
        <input class="form-control" name="countrytocode" type="text" id="countrytocode" value="{{ old('countrytocode', optional($passCondition)->countrytocode) }}" min="0" max="1000" placeholder="Enter countrytocode here...">
        {!! $errors->first('countrytocode', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('countrypassport') ? 'has-error' : '' }}">
    <label for="countrypassport" class="col-md-2 control-label">Countrypassport</label>
    <div class="col-md-10">
        <input class="form-control" name="countrypassport" type="text" id="countrypassport" value="{{ old('countrypassport', optional($passCondition)->countrypassport) }}" min="0" max="1000" placeholder="Enter countrypassport here...">
        {!! $errors->first('countrypassport', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('lettercodefrom') ? 'has-error' : '' }}">
    <label for="lettercodefrom" class="col-md-2 control-label">Lettercodefrom</label>
    <div class="col-md-10">
        <input class="form-control" name="lettercodefrom" type="text" id="lettercodefrom" value="{{ old('lettercodefrom', optional($passCondition)->lettercodefrom) }}" maxlength="150" placeholder="Enter lettercodefrom here...">
        {!! $errors->first('lettercodefrom', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('lettercodeto') ? 'has-error' : '' }}">
    <label for="lettercodeto" class="col-md-2 control-label">Lettercodeto</label>
    <div class="col-md-10">
        <input class="form-control" name="lettercodeto" type="text" id="lettercodeto" value="{{ old('lettercodeto', optional($passCondition)->lettercodeto) }}" maxlength="2000" placeholder="Enter lettercodeto here...">
        {!! $errors->first('lettercodeto', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('conditionft') ? 'has-error' : '' }}">
    <label for="conditionft" class="col-md-2 control-label">Conditionft</label>
    <div class="col-md-10">
        <input class="form-control" name="conditionft" type="text" id="conditionft" value="{{ old('conditionft', optional($passCondition)->conditionft) }}" maxlength="250" placeholder="Enter conditionft here...">
        {!! $errors->first('conditionft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('conditionfts') ? 'has-error' : '' }}">
    <label for="conditionfts" class="col-md-2 control-label">Conditionfts</label>
    <div class="col-md-10">
        <input class="form-control" name="conditionfts" type="number" id="conditionfts" value="{{ old('conditionfts', optional($passCondition)->conditionfts) }}" min="-2147483648" max="2147483647" placeholder="Enter conditionfts here...">
        {!! $errors->first('conditionfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('passport') ? 'has-error' : '' }}">
    <label for="passport" class="col-md-2 control-label">Passport</label>
    <div class="col-md-10">
        <input class="form-control" name="passport" type="number" id="passport" value="{{ old('passport', optional($passCondition)->passport) }}" min="-2147483648" max="2147483647" placeholder="Enter passport here...">
        {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('passportft') ? 'has-error' : '' }}">
    <label for="passportft" class="col-md-2 control-label">Passportft</label>
    <div class="col-md-10">
        <input class="form-control" name="passportft" type="text" id="passportft" value="{{ old('passportft', optional($passCondition)->passportft) }}" maxlength="250" placeholder="Enter passportft here...">
        {!! $errors->first('passportft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('passportfts') ? 'has-error' : '' }}">
    <label for="passportfts" class="col-md-2 control-label">Passportfts</label>
    <div class="col-md-10">
        <input class="form-control" name="passportfts" type="number" id="passportfts" value="{{ old('passportfts', optional($passCondition)->passportfts) }}" min="-2147483648" max="2147483647" placeholder="Enter passportfts here...">
        {!! $errors->first('passportfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('temppassport') ? 'has-error' : '' }}">
    <label for="temppassport" class="col-md-2 control-label">Temppassport</label>
    <div class="col-md-10">
        <input class="form-control" name="temppassport" type="number" id="temppassport" value="{{ old('temppassport', optional($passCondition)->temppassport) }}" min="-2147483648" max="2147483647" placeholder="Enter temppassport here...">
        {!! $errors->first('temppassport', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('temppassportft') ? 'has-error' : '' }}">
    <label for="temppassportft" class="col-md-2 control-label">Temppassportft</label>
    <div class="col-md-10">
        <input class="form-control" name="temppassportft" type="text" id="temppassportft" value="{{ old('temppassportft', optional($passCondition)->temppassportft) }}" maxlength="250" placeholder="Enter temppassportft here...">
        {!! $errors->first('temppassportft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('temppassportfts') ? 'has-error' : '' }}">
    <label for="temppassportfts" class="col-md-2 control-label">Temppassportfts</label>
    <div class="col-md-10">
        <input class="form-control" name="temppassportfts" type="number" id="temppassportfts" value="{{ old('temppassportfts', optional($passCondition)->temppassportfts) }}" min="-2147483648" max="2147483647" placeholder="Enter temppassportfts here...">
        {!! $errors->first('temppassportfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('identitycard') ? 'has-error' : '' }}">
    <label for="identitycard" class="col-md-2 control-label">Identitycard</label>
    <div class="col-md-10">
        <input class="form-control" name="identitycard" type="number" id="identitycard" value="{{ old('identitycard', optional($passCondition)->identitycard) }}" min="-2147483648" max="2147483647" placeholder="Enter identitycard here...">
        {!! $errors->first('identitycard', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('identitycardft') ? 'has-error' : '' }}">
    <label for="identitycardft" class="col-md-2 control-label">Identitycardft</label>
    <div class="col-md-10">
        <input class="form-control" name="identitycardft" type="text" id="identitycardft" value="{{ old('identitycardft', optional($passCondition)->identitycardft) }}" maxlength="250" placeholder="Enter identitycardft here...">
        {!! $errors->first('identitycardft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('identitycardfts') ? 'has-error' : '' }}">
    <label for="identitycardfts" class="col-md-2 control-label">Identitycardfts</label>
    <div class="col-md-10">
        <input class="form-control" name="identitycardfts" type="number" id="identitycardfts" value="{{ old('identitycardfts', optional($passCondition)->identitycardfts) }}" min="-2147483648" max="2147483647" placeholder="Enter identitycardfts here...">
        {!! $errors->first('identitycardfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tempidentitycard') ? 'has-error' : '' }}">
    <label for="tempidentitycard" class="col-md-2 control-label">Tempidentitycard</label>
    <div class="col-md-10">
        <input class="form-control" name="tempidentitycard" type="number" id="tempidentitycard" value="{{ old('tempidentitycard', optional($passCondition)->tempidentitycard) }}" min="-2147483648" max="2147483647" placeholder="Enter tempidentitycard here...">
        {!! $errors->first('tempidentitycard', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tempidentitycardft') ? 'has-error' : '' }}">
    <label for="tempidentitycardft" class="col-md-2 control-label">Tempidentitycardft</label>
    <div class="col-md-10">
        <input class="form-control" name="tempidentitycardft" type="text" id="tempidentitycardft" value="{{ old('tempidentitycardft', optional($passCondition)->tempidentitycardft) }}" maxlength="250" placeholder="Enter tempidentitycardft here...">
        {!! $errors->first('tempidentitycardft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tempidentitycardfts') ? 'has-error' : '' }}">
    <label for="tempidentitycardfts" class="col-md-2 control-label">Tempidentitycardfts</label>
    <div class="col-md-10">
        <input class="form-control" name="tempidentitycardfts" type="number" id="tempidentitycardfts" value="{{ old('tempidentitycardfts', optional($passCondition)->tempidentitycardfts) }}" min="-2147483648" max="2147483647" placeholder="Enter tempidentitycardfts here...">
        {!! $errors->first('tempidentitycardfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('passportchild') ? 'has-error' : '' }}">
    <label for="passportchild" class="col-md-2 control-label">Passportchild</label>
    <div class="col-md-10">
        <input class="form-control" name="passportchild" type="number" id="passportchild" value="{{ old('passportchild', optional($passCondition)->passportchild) }}" min="-2147483648" max="2147483647" placeholder="Enter passportchild here...">
        {!! $errors->first('passportchild', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('passportchildft') ? 'has-error' : '' }}">
    <label for="passportchildft" class="col-md-2 control-label">Passportchildft</label>
    <div class="col-md-10">
        <input class="form-control" name="passportchildft" type="text" id="passportchildft" value="{{ old('passportchildft', optional($passCondition)->passportchildft) }}" maxlength="250" placeholder="Enter passportchildft here...">
        {!! $errors->first('passportchildft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('passportchildfts') ? 'has-error' : '' }}">
    <label for="passportchildfts" class="col-md-2 control-label">Passportchildfts</label>
    <div class="col-md-10">
        <input class="form-control" name="passportchildfts" type="number" id="passportchildfts" value="{{ old('passportchildfts', optional($passCondition)->passportchildfts) }}" min="-2147483648" max="2147483647" placeholder="Enter passportchildfts here...">
        {!! $errors->first('passportchildfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('identitycard2') ? 'has-error' : '' }}">
    <label for="identitycard2" class="col-md-2 control-label">Identitycard2</label>
    <div class="col-md-10">
        <input class="form-control" name="identitycard2" type="number" id="identitycard2" value="{{ old('identitycard2', optional($passCondition)->identitycard2) }}" min="-2147483648" max="2147483647" placeholder="Enter identitycard2 here...">
        {!! $errors->first('identitycard2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('identitycard2ft') ? 'has-error' : '' }}">
    <label for="identitycard2ft" class="col-md-2 control-label">Identitycard2Ft</label>
    <div class="col-md-10">
        <input class="form-control" name="identitycard2ft" type="text" id="identitycard2ft" value="{{ old('identitycard2ft', optional($passCondition)->identitycard2ft) }}" maxlength="250" placeholder="Enter identitycard2ft here...">
        {!! $errors->first('identitycard2ft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('identitycard2fts') ? 'has-error' : '' }}">
    <label for="identitycard2fts" class="col-md-2 control-label">Identitycard2Fts</label>
    <div class="col-md-10">
        <input class="form-control" name="identitycard2fts" type="number" id="identitycard2fts" value="{{ old('identitycard2fts', optional($passCondition)->identitycard2fts) }}" min="-2147483648" max="2147483647" placeholder="Enter identitycard2fts here...">
        {!! $errors->first('identitycard2fts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('creamypassport') ? 'has-error' : '' }}">
    <label for="creamypassport" class="col-md-2 control-label">Creamypassport</label>
    <div class="col-md-10">
        <input class="form-control" name="creamypassport" type="number" id="creamypassport" value="{{ old('creamypassport', optional($passCondition)->creamypassport) }}" min="-2147483648" max="2147483647" placeholder="Enter creamypassport here...">
        {!! $errors->first('creamypassport', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('creamypassportft') ? 'has-error' : '' }}">
    <label for="creamypassportft" class="col-md-2 control-label">Creamypassportft</label>
    <div class="col-md-10">
        <input class="form-control" name="creamypassportft" type="text" id="creamypassportft" value="{{ old('creamypassportft', optional($passCondition)->creamypassportft) }}" maxlength="250" placeholder="Enter creamypassportft here...">
        {!! $errors->first('creamypassportft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('creamypassportfts') ? 'has-error' : '' }}">
    <label for="creamypassportfts" class="col-md-2 control-label">Creamypassportfts</label>
    <div class="col-md-10">
        <input class="form-control" name="creamypassportfts" type="number" id="creamypassportfts" value="{{ old('creamypassportfts', optional($passCondition)->creamypassportfts) }}" min="-2147483648" max="2147483647" placeholder="Enter creamypassportfts here...">
        {!! $errors->first('creamypassportfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('cpdeparture') ? 'has-error' : '' }}">
    <label for="cpdeparture" class="col-md-2 control-label">Cpdeparture</label>
    <div class="col-md-10">
        <input class="form-control" name="cpdeparture" type="number" id="cpdeparture" value="{{ old('cpdeparture', optional($passCondition)->cpdeparture) }}" min="-2147483648" max="2147483647" placeholder="Enter cpdeparture here...">
        {!! $errors->first('cpdeparture', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('cptransit') ? 'has-error' : '' }}">
    <label for="cptransit" class="col-md-2 control-label">Cptransit</label>
    <div class="col-md-10">
        <input class="form-control" name="cptransit" type="number" id="cptransit" value="{{ old('cptransit', optional($passCondition)->cptransit) }}" min="-2147483648" max="2147483647" placeholder="Enter cptransit here...">
        {!! $errors->first('cptransit', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validity') ? 'has-error' : '' }}">
    <label for="validity" class="col-md-2 control-label">Validity</label>
    <div class="col-md-10">
        <input class="form-control" name="validity" type="text" id="validity" value="{{ old('validity', optional($passCondition)->validity) }}" maxlength="4294967295" placeholder="Enter validity here...">
        {!! $errors->first('validity', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validityfts') ? 'has-error' : '' }}">
    <label for="validityfts" class="col-md-2 control-label">Validityfts</label>
    <div class="col-md-10">
        <input class="form-control" name="validityfts" type="number" id="validityfts" value="{{ old('validityfts', optional($passCondition)->validityfts) }}" min="-2147483648" max="2147483647" placeholder="Enter validityfts here...">
        {!! $errors->first('validityfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validitystopover') ? 'has-error' : '' }}">
    <label for="validitystopover" class="col-md-2 control-label">Validitystopover</label>
    <div class="col-md-10">
        <input class="form-control" name="validitystopover" type="number" id="validitystopover" value="{{ old('validitystopover', optional($passCondition)->validitystopover) }}" min="-2147483648" max="2147483647" placeholder="Enter validitystopover here...">
        {!! $errors->first('validitystopover', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validityentry') ? 'has-error' : '' }}">
    <label for="validityentry" class="col-md-2 control-label">Validityentry</label>
    <div class="col-md-10">
        <input class="form-control" name="validityentry" type="number" id="validityentry" value="{{ old('validityentry', optional($passCondition)->validityentry) }}" min="-2147483648" max="2147483647" placeholder="Enter validityentry here...">
        {!! $errors->first('validityentry', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validityexpired') ? 'has-error' : '' }}">
    <label for="validityexpired" class="col-md-2 control-label">Validityexpired</label>
    <div class="col-md-10">
        <input class="form-control" name="validityexpired" type="number" id="validityexpired" value="{{ old('validityexpired', optional($passCondition)->validityexpired) }}" min="-2147483648" max="2147483647" placeholder="Enter validityexpired here...">
        {!! $errors->first('validityexpired', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validitybehindreturn') ? 'has-error' : '' }}">
    <label for="validitybehindreturn" class="col-md-2 control-label">Validitybehindreturn</label>
    <div class="col-md-10">
        <input class="form-control" name="validitybehindreturn" type="number" id="validitybehindreturn" value="{{ old('validitybehindreturn', optional($passCondition)->validitybehindreturn) }}" min="-2147483648" max="2147483647" placeholder="Enter validitybehindreturn here...">
        {!! $errors->first('validitybehindreturn', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validitystay') ? 'has-error' : '' }}">
    <label for="validitystay" class="col-md-2 control-label">Validitystay</label>
    <div class="col-md-10">
        <input class="form-control" name="validitystay" type="number" id="validitystay" value="{{ old('validitystay', optional($passCondition)->validitystay) }}" min="-2147483648" max="2147483647" placeholder="Enter validitystay here...">
        {!! $errors->first('validitystay', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('latestrequest') ? 'has-error' : '' }}">
    <label for="latestrequest" class="col-md-2 control-label">Latestrequest</label>
    <div class="col-md-10">
        <input class="form-control" name="latestrequest" type="number" id="latestrequest" value="{{ old('latestrequest', optional($passCondition)->latestrequest) }}" min="-2147483648" max="2147483647" required="true" placeholder="Enter latestrequest here...">
        {!! $errors->first('latestrequest', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('travelinfo') ? 'has-error' : '' }}">
    <label for="travelinfo" class="col-md-2 control-label">Travelinfo</label>
    <div class="col-md-10">
        <input class="form-control" name="travelinfo" type="number" id="travelinfo" value="{{ old('travelinfo', optional($passCondition)->travelinfo) }}" min="-2147483648" max="2147483647" placeholder="Enter travelinfo here...">
        {!! $errors->first('travelinfo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('travelinfofts') ? 'has-error' : '' }}">
    <label for="travelinfofts" class="col-md-2 control-label">Travelinfofts</label>
    <div class="col-md-10">
        <input class="form-control" name="travelinfofts" type="number" id="travelinfofts" value="{{ old('travelinfofts', optional($passCondition)->travelinfofts) }}" min="-2147483648" max="2147483647" placeholder="Enter travelinfofts here...">
        {!! $errors->first('travelinfofts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('travelwarning') ? 'has-error' : '' }}">
    <label for="travelwarning" class="col-md-2 control-label">Travelwarning</label>
    <div class="col-md-10">
        <input class="form-control" name="travelwarning" type="number" id="travelwarning" value="{{ old('travelwarning', optional($passCondition)->travelwarning) }}" min="-2147483648" max="2147483647" placeholder="Enter travelwarning here...">
        {!! $errors->first('travelwarning', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('travelwarningfts') ? 'has-error' : '' }}">
    <label for="travelwarningfts" class="col-md-2 control-label">Travelwarningfts</label>
    <div class="col-md-10">
        <input class="form-control" name="travelwarningfts" type="number" id="travelwarningfts" value="{{ old('travelwarningfts', optional($passCondition)->travelwarningfts) }}" min="-2147483648" max="2147483647" placeholder="Enter travelwarningfts here...">
        {!! $errors->first('travelwarningfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('travelwarning2') ? 'has-error' : '' }}">
    <label for="travelwarning2" class="col-md-2 control-label">Travelwarning2</label>
    <div class="col-md-10">
        <input class="form-control" name="travelwarning2" type="number" id="travelwarning2" value="{{ old('travelwarning2', optional($passCondition)->travelwarning2) }}" min="-2147483648" max="2147483647" required="true" placeholder="Enter travelwarning2 here...">
        {!! $errors->first('travelwarning2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('travelwarning2fts') ? 'has-error' : '' }}">
    <label for="travelwarning2fts" class="col-md-2 control-label">Travelwarning2Fts</label>
    <div class="col-md-10">
        <input class="form-control" name="travelwarning2fts" type="number" id="travelwarning2fts" value="{{ old('travelwarning2fts', optional($passCondition)->travelwarning2fts) }}" min="-2147483648" max="2147483647" placeholder="Enter travelwarning2fts here...">
        {!! $errors->first('travelwarning2fts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pregnant') ? 'has-error' : '' }}">
    <label for="pregnant" class="col-md-2 control-label">Pregnant</label>
    <div class="col-md-10">
        <input class="form-control" name="pregnant" type="number" id="pregnant" value="{{ old('pregnant', optional($passCondition)->pregnant) }}" min="-2147483648" max="2147483647" placeholder="Enter pregnant here...">
        {!! $errors->first('pregnant', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('child') ? 'has-error' : '' }}">
    <label for="child" class="col-md-2 control-label">Child</label>
    <div class="col-md-10">
        <input class="form-control" name="child" type="number" id="child" value="{{ old('child', optional($passCondition)->child) }}" min="-2147483648" max="2147483647" placeholder="Enter child here...">
        {!! $errors->first('child', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('doublenat') ? 'has-error' : '' }}">
    <label for="doublenat" class="col-md-2 control-label">Doublenat</label>
    <div class="col-md-10">
        <input class="form-control" name="doublenat" type="number" id="doublenat" value="{{ old('doublenat', optional($passCondition)->doublenat) }}" min="-2147483648" max="2147483647" placeholder="Enter doublenat here...">
        {!! $errors->first('doublenat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('doublenatfts') ? 'has-error' : '' }}">
    <label for="doublenatfts" class="col-md-2 control-label">Doublenatfts</label>
    <div class="col-md-10">
        <input class="form-control" name="doublenatfts" type="number" id="doublenatfts" value="{{ old('doublenatfts', optional($passCondition)->doublenatfts) }}" min="-2147483648" max="2147483647" placeholder="Enter doublenatfts here...">
        {!! $errors->first('doublenatfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('airline') ? 'has-error' : '' }}">
    <label for="airline" class="col-md-2 control-label">Airline</label>
    <div class="col-md-10">
        <input class="form-control" name="airline" type="number" id="airline" value="{{ old('airline', optional($passCondition)->airline) }}" min="-2147483648" max="2147483647" placeholder="Enter airline here...">
        {!! $errors->first('airline', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('airlinefts') ? 'has-error' : '' }}">
    <label for="airlinefts" class="col-md-2 control-label">Airlinefts</label>
    <div class="col-md-10">
        <input class="form-control" name="airlinefts" type="number" id="airlinefts" value="{{ old('airlinefts', optional($passCondition)->airlinefts) }}" min="-2147483648" max="2147483647" placeholder="Enter airlinefts here...">
        {!! $errors->first('airlinefts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('underage') ? 'has-error' : '' }}">
    <label for="underage" class="col-md-2 control-label">Underage</label>
    <div class="col-md-10">
        <input class="form-control" name="underage" type="number" id="underage" value="{{ old('underage', optional($passCondition)->underage) }}" min="-2147483648" max="2147483647" placeholder="Enter underage here...">
        {!! $errors->first('underage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('underageowndoc') ? 'has-error' : '' }}">
    <label for="underageowndoc" class="col-md-2 control-label">Underageowndoc</label>
    <div class="col-md-10">
        <input class="form-control" name="underageowndoc" type="number" id="underageowndoc" value="{{ old('underageowndoc', optional($passCondition)->underageowndoc) }}" min="-2147483648" max="2147483647" placeholder="Enter underageowndoc here...">
        {!! $errors->first('underageowndoc', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('underageinfo') ? 'has-error' : '' }}">
    <label for="underageinfo" class="col-md-2 control-label">Underageinfo</label>
    <div class="col-md-10">
        <input class="form-control" name="underageinfo" type="number" id="underageinfo" value="{{ old('underageinfo', optional($passCondition)->underageinfo) }}" min="-2147483648" max="2147483647" placeholder="Enter underageinfo here...">
        {!! $errors->first('underageinfo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('underagefts') ? 'has-error' : '' }}">
    <label for="underagefts" class="col-md-2 control-label">Underagefts</label>
    <div class="col-md-10">
        <input class="form-control" name="underagefts" type="number" id="underagefts" value="{{ old('underagefts', optional($passCondition)->underagefts) }}" min="-2147483648" max="2147483647" placeholder="Enter underagefts here...">
        {!! $errors->first('underagefts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('embassyft') ? 'has-error' : '' }}">
    <label for="embassyft" class="col-md-2 control-label">Embassyft</label>
    <div class="col-md-10">
        <input class="form-control" name="embassyft" type="text" id="embassyft" value="{{ old('embassyft', optional($passCondition)->embassyft) }}" maxlength="250" placeholder="Enter embassyft here...">
        {!! $errors->first('embassyft', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('embassyfts') ? 'has-error' : '' }}">
    <label for="embassyfts" class="col-md-2 control-label">Embassyfts</label>
    <div class="col-md-10">
        <input class="form-control" name="embassyfts" type="number" id="embassyfts" value="{{ old('embassyfts', optional($passCondition)->embassyfts) }}" min="-2147483648" max="2147483647" placeholder="Enter embassyfts here...">
        {!! $errors->first('embassyfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('lostdocumentsfts') ? 'has-error' : '' }}">
    <label for="lostdocumentsfts" class="col-md-2 control-label">Lostdocumentsfts</label>
    <div class="col-md-10">
        <input class="form-control" name="lostdocumentsfts" type="number" id="lostdocumentsfts" value="{{ old('lostdocumentsfts', optional($passCondition)->lostdocumentsfts) }}" min="-2147483648" max="2147483647" placeholder="Enter lostdocumentsfts here...">
        {!! $errors->first('lostdocumentsfts', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('immunisation') ? 'has-error' : '' }}">
    <label for="immunisation" class="col-md-2 control-label">Immunisation</label>
    <div class="col-md-10">
        <input class="form-control" name="immunisation" type="text" id="immunisation" value="{{ old('immunisation', optional($passCondition)->immunisation) }}" maxlength="4294967295" placeholder="Enter immunisation here...">
        {!! $errors->first('immunisation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('visa') ? 'has-error' : '' }}">
    <label for="visa" class="col-md-2 control-label">Visa</label>
    <div class="col-md-10">
        <input class="form-control" name="visa" type="text" id="visa" value="{{ old('visa', optional($passCondition)->visa) }}" maxlength="4294967295" placeholder="Enter visa here...">
        {!! $errors->first('visa', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
    <label for="note" class="col-md-2 control-label">Note</label>
    <div class="col-md-10">
        <input class="form-control" name="note" type="text" id="note" value="{{ old('note', optional($passCondition)->note) }}" maxlength="255">
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext') ? 'has-error' : '' }}">
    <label for="longtext" class="col-md-2 control-label">Longtext</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext" type="text" id="longtext" value="{{ old('longtext', optional($passCondition)->longtext) }}" maxlength="4294967295" placeholder="Enter longtext here...">
        {!! $errors->first('longtext', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_en') ? 'has-error' : '' }}">
    <label for="longtext_en" class="col-md-2 control-label">Longtext En</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_en" type="text" id="longtext_en" value="{{ old('longtext_en', optional($passCondition)->longtext_en) }}" maxlength="4294967295" placeholder="Enter longtext en here...">
        {!! $errors->first('longtext_en', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_fr') ? 'has-error' : '' }}">
    <label for="longtext_fr" class="col-md-2 control-label">Longtext Fr</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_fr" type="text" id="longtext_fr" value="{{ old('longtext_fr', optional($passCondition)->longtext_fr) }}" maxlength="4294967295" placeholder="Enter longtext fr here...">
        {!! $errors->first('longtext_fr', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_it') ? 'has-error' : '' }}">
    <label for="longtext_it" class="col-md-2 control-label">Longtext It</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_it" type="text" id="longtext_it" value="{{ old('longtext_it', optional($passCondition)->longtext_it) }}" maxlength="4294967295" placeholder="Enter longtext it here...">
        {!! $errors->first('longtext_it', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_nl') ? 'has-error' : '' }}">
    <label for="longtext_nl" class="col-md-2 control-label">Longtext Nl</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_nl" type="text" id="longtext_nl" value="{{ old('longtext_nl', optional($passCondition)->longtext_nl) }}" maxlength="4294967295" placeholder="Enter longtext nl here...">
        {!! $errors->first('longtext_nl', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_pl') ? 'has-error' : '' }}">
    <label for="longtext_pl" class="col-md-2 control-label">Longtext Pl</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_pl" type="text" id="longtext_pl" value="{{ old('longtext_pl', optional($passCondition)->longtext_pl) }}" maxlength="4294967295" placeholder="Enter longtext pl here...">
        {!! $errors->first('longtext_pl', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_es') ? 'has-error' : '' }}">
    <label for="longtext_es" class="col-md-2 control-label">Longtext Es</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_es" type="text" id="longtext_es" value="{{ old('longtext_es', optional($passCondition)->longtext_es) }}" maxlength="4294967295" placeholder="Enter longtext es here...">
        {!! $errors->first('longtext_es', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_pt') ? 'has-error' : '' }}">
    <label for="longtext_pt" class="col-md-2 control-label">Longtext Pt</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_pt" type="text" id="longtext_pt" value="{{ old('longtext_pt', optional($passCondition)->longtext_pt) }}" maxlength="4294967295" placeholder="Enter longtext pt here...">
        {!! $errors->first('longtext_pt', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_be') ? 'has-error' : '' }}">
    <label for="longtext_be" class="col-md-2 control-label">Longtext Be</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_be" type="text" id="longtext_be" value="{{ old('longtext_be', optional($passCondition)->longtext_be) }}" maxlength="4294967295" placeholder="Enter longtext be here...">
        {!! $errors->first('longtext_be', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('longtext_ru') ? 'has-error' : '' }}">
    <label for="longtext_ru" class="col-md-2 control-label">Longtext Ru</label>
    <div class="col-md-10">
        <input class="form-control" name="longtext_ru" type="text" id="longtext_ru" value="{{ old('longtext_ru', optional($passCondition)->longtext_ru) }}" maxlength="4294967295" placeholder="Enter longtext ru here...">
        {!! $errors->first('longtext_ru', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('linkresource') ? 'has-error' : '' }}">
    <label for="linkresource" class="col-md-2 control-label">Linkresource</label>
    <div class="col-md-10">
        <input class="form-control" name="linkresource" type="text" id="linkresource" value="{{ old('linkresource', optional($passCondition)->linkresource) }}" maxlength="255" placeholder="Enter linkresource here...">
        {!! $errors->first('linkresource', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('textresource') ? 'has-error' : '' }}">
    <label for="textresource" class="col-md-2 control-label">Textresource</label>
    <div class="col-md-10">
        <input class="form-control" name="textresource" type="text" id="textresource" value="{{ old('textresource', optional($passCondition)->textresource) }}" maxlength="4294967295" placeholder="Enter textresource here...">
        {!! $errors->first('textresource', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('resourcechanged') ? 'has-error' : '' }}">
    <label for="resourcechanged" class="col-md-2 control-label">Resourcechanged</label>
    <div class="col-md-10">
        <input class="form-control" name="resourcechanged" type="number" id="resourcechanged" value="{{ old('resourcechanged', optional($passCondition)->resourcechanged) }}" min="-2147483648" max="2147483647" placeholder="Enter resourcechanged here...">
        {!! $errors->first('resourcechanged', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Status</label>
    <div class="col-md-10">
        <input class="form-control" name="status" type="number" id="status" value="{{ old('status', optional($passCondition)->status) }}" min="-2147483648" max="2147483647" placeholder="Enter status here...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('importantchange') ? 'has-error' : '' }}">
    <label for="importantchange" class="col-md-2 control-label">Importantchange</label>
    <div class="col-md-10">
        <input class="form-control" name="importantchange" type="number" id="importantchange" value="{{ old('importantchange', optional($passCondition)->importantchange) }}" min="-2147483648" max="2147483647" placeholder="Enter importantchange here...">
        {!! $errors->first('importantchange', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('controlled_at') ? 'has-error' : '' }}">
    <label for="controlled_at" class="col-md-2 control-label">Controlled At</label>
    <div class="col-md-10">
        <input class="form-control" name="controlled_at" type="text" id="controlled_at" value="{{ old('controlled_at', optional($passCondition)->controlled_at) }}" placeholder="Enter controlled at here...">
        {!! $errors->first('controlled_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('controlled_user') ? 'has-error' : '' }}">
    <label for="controlled_user" class="col-md-2 control-label">Controlled User</label>
    <div class="col-md-10">
        <input class="form-control" name="controlled_user" type="number" id="controlled_user" value="{{ old('controlled_user', optional($passCondition)->controlled_user) }}" min="-2147483648" max="2147483647" placeholder="Enter controlled user here...">
        {!! $errors->first('controlled_user', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('controlled_ip') ? 'has-error' : '' }}">
    <label for="controlled_ip" class="col-md-2 control-label">Controlled Ip</label>
    <div class="col-md-10">
        <input class="form-control" name="controlled_ip" type="text" id="controlled_ip" value="{{ old('controlled_ip', optional($passCondition)->controlled_ip) }}" maxlength="11" placeholder="Enter controlled ip here...">
        {!! $errors->first('controlled_ip', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created_user') ? 'has-error' : '' }}">
    <label for="created_user" class="col-md-2 control-label">Created User</label>
    <div class="col-md-10">
        <input class="form-control" name="created_user" type="number" id="created_user" value="{{ old('created_user', optional($passCondition)->created_user) }}" min="-2147483648" max="2147483647" placeholder="Enter created user here...">
        {!! $errors->first('created_user', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created_ip') ? 'has-error' : '' }}">
    <label for="created_ip" class="col-md-2 control-label">Created Ip</label>
    <div class="col-md-10">
        <input class="form-control" name="created_ip" type="text" id="created_ip" value="{{ old('created_ip', optional($passCondition)->created_ip) }}" maxlength="20" placeholder="Enter created ip here...">
        {!! $errors->first('created_ip', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('updated_user') ? 'has-error' : '' }}">
    <label for="updated_user" class="col-md-2 control-label">Updated User</label>
    <div class="col-md-10">
        <input class="form-control" name="updated_user" type="number" id="updated_user" value="{{ old('updated_user', optional($passCondition)->updated_user) }}" min="-2147483648" max="2147483647" placeholder="Enter updated user here...">
        {!! $errors->first('updated_user', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('updated_ip') ? 'has-error' : '' }}">
    <label for="updated_ip" class="col-md-2 control-label">Updated Ip</label>
    <div class="col-md-10">
        <input class="form-control" name="updated_ip" type="text" id="updated_ip" value="{{ old('updated_ip', optional($passCondition)->updated_ip) }}" maxlength="20" placeholder="Enter updated ip here...">
        {!! $errors->first('updated_ip', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('archive') ? 'has-error' : '' }}">
    <label for="archive" class="col-md-2 control-label">Archive</label>
    <div class="col-md-10">
        <input class="form-control" name="archive" type="number" id="archive" value="{{ old('archive', optional($passCondition)->archive) }}" min="-2147483648" max="2147483647" placeholder="Enter archive here...">
        {!! $errors->first('archive', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
    <label for="active" class="col-md-2 control-label">Active</label>
    <div class="col-md-10">
        <input class="form-control" name="active" type="text" id="active" value="{{ old('active', optional($passCondition)->active) }}" maxlength="1" required="true" placeholder="Enter active here...">
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

