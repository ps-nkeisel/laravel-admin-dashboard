@extends('layouts.backend')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Pass Condition' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('pass_conditions.pass_condition.destroy', $passCondition->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('pass_conditions.pass_condition.index') }}" class="btn btn-primary" title="Show All Pass Condition">
                        <span class="fa fa-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('pass_conditions.pass_condition.create') }}" class="btn btn-success" title="Create New Pass Condition">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('pass_conditions.pass_condition.edit', $passCondition->id ) }}" class="btn btn-primary" title="Edit Pass Condition">
                        <span class="fa fa-pen" aria-hidden="true"></span>
                    </a>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Assignto</dt>
            <dd>{{ $passCondition->assignto }}</dd>
            <dt>Idversionbefore</dt>
            <dd>{{ $passCondition->idversionbefore }}</dd>
            <dt>Idversionnext</dt>
            <dd>{{ $passCondition->idversionnext }}</dd>
            <dt>Version</dt>
            <dd>{{ $passCondition->version }}</dd>
            <dt>Idcountry</dt>
            <dd>{{ $passCondition->idcountry }}</dd>
            <dt>Countryfromcode</dt>
            <dd>{{ $passCondition->countryfromcode }}</dd>
            <dt>Countrytocode</dt>
            <dd>{{ $passCondition->countrytocode }}</dd>
            <dt>Countrypassport</dt>
            <dd>{{ $passCondition->countrypassport }}</dd>
            <dt>Lettercodefrom</dt>
            <dd>{{ $passCondition->lettercodefrom }}</dd>
            <dt>Lettercodeto</dt>
            <dd>{{ $passCondition->lettercodeto }}</dd>
            <dt>Conditionft</dt>
            <dd>{{ $passCondition->conditionft }}</dd>
            <dt>Conditionfts</dt>
            <dd>{{ $passCondition->conditionfts }}</dd>
            <dt>Passport</dt>
            <dd>{{ $passCondition->passport }}</dd>
            <dt>Passportft</dt>
            <dd>{{ $passCondition->passportft }}</dd>
            <dt>Passportfts</dt>
            <dd>{{ $passCondition->passportfts }}</dd>
            <dt>Temppassport</dt>
            <dd>{{ $passCondition->temppassport }}</dd>
            <dt>Temppassportft</dt>
            <dd>{{ $passCondition->temppassportft }}</dd>
            <dt>Temppassportfts</dt>
            <dd>{{ $passCondition->temppassportfts }}</dd>
            <dt>Identitycard</dt>
            <dd>{{ $passCondition->identitycard }}</dd>
            <dt>Identitycardft</dt>
            <dd>{{ $passCondition->identitycardft }}</dd>
            <dt>Identitycardfts</dt>
            <dd>{{ $passCondition->identitycardfts }}</dd>
            <dt>Tempidentitycard</dt>
            <dd>{{ $passCondition->tempidentitycard }}</dd>
            <dt>Tempidentitycardft</dt>
            <dd>{{ $passCondition->tempidentitycardft }}</dd>
            <dt>Tempidentitycardfts</dt>
            <dd>{{ $passCondition->tempidentitycardfts }}</dd>
            <dt>Passportchild</dt>
            <dd>{{ $passCondition->passportchild }}</dd>
            <dt>Passportchildft</dt>
            <dd>{{ $passCondition->passportchildft }}</dd>
            <dt>Passportchildfts</dt>
            <dd>{{ $passCondition->passportchildfts }}</dd>
            <dt>Identitycard2</dt>
            <dd>{{ $passCondition->identitycard2 }}</dd>
            <dt>Identitycard2Ft</dt>
            <dd>{{ $passCondition->identitycard2ft }}</dd>
            <dt>Identitycard2Fts</dt>
            <dd>{{ $passCondition->identitycard2fts }}</dd>
            <dt>Creamypassport</dt>
            <dd>{{ $passCondition->creamypassport }}</dd>
            <dt>Creamypassportft</dt>
            <dd>{{ $passCondition->creamypassportft }}</dd>
            <dt>Creamypassportfts</dt>
            <dd>{{ $passCondition->creamypassportfts }}</dd>
            <dt>Cpdeparture</dt>
            <dd>{{ $passCondition->cpdeparture }}</dd>
            <dt>Cptransit</dt>
            <dd>{{ $passCondition->cptransit }}</dd>
            <dt>Validity</dt>
            <dd>{{ $passCondition->validity }}</dd>
            <dt>Validityfts</dt>
            <dd>{{ $passCondition->validityfts }}</dd>
            <dt>Validitystopover</dt>
            <dd>{{ $passCondition->validitystopover }}</dd>
            <dt>Validityentry</dt>
            <dd>{{ $passCondition->validityentry }}</dd>
            <dt>Validityexpired</dt>
            <dd>{{ $passCondition->validityexpired }}</dd>
            <dt>Validitybehindreturn</dt>
            <dd>{{ $passCondition->validitybehindreturn }}</dd>
            <dt>Validitystay</dt>
            <dd>{{ $passCondition->validitystay }}</dd>
            <dt>Latestrequest</dt>
            <dd>{{ $passCondition->latestrequest }}</dd>
            <dt>Travelinfo</dt>
            <dd>{{ $passCondition->travelinfo }}</dd>
            <dt>Travelinfofts</dt>
            <dd>{{ $passCondition->travelinfofts }}</dd>
            <dt>Travelwarning</dt>
            <dd>{{ $passCondition->travelwarning }}</dd>
            <dt>Travelwarningfts</dt>
            <dd>{{ $passCondition->travelwarningfts }}</dd>
            <dt>Travelwarning2</dt>
            <dd>{{ $passCondition->travelwarning2 }}</dd>
            <dt>Travelwarning2Fts</dt>
            <dd>{{ $passCondition->travelwarning2fts }}</dd>
            <dt>Pregnant</dt>
            <dd>{{ $passCondition->pregnant }}</dd>
            <dt>Child</dt>
            <dd>{{ $passCondition->child }}</dd>
            <dt>Doublenat</dt>
            <dd>{{ $passCondition->doublenat }}</dd>
            <dt>Doublenatfts</dt>
            <dd>{{ $passCondition->doublenatfts }}</dd>
            <dt>Airline</dt>
            <dd>{{ $passCondition->airline }}</dd>
            <dt>Airlinefts</dt>
            <dd>{{ $passCondition->airlinefts }}</dd>
            <dt>Underage</dt>
            <dd>{{ $passCondition->underage }}</dd>
            <dt>Underageowndoc</dt>
            <dd>{{ $passCondition->underageowndoc }}</dd>
            <dt>Underageinfo</dt>
            <dd>{{ $passCondition->underageinfo }}</dd>
            <dt>Underagefts</dt>
            <dd>{{ $passCondition->underagefts }}</dd>
            <dt>Embassyft</dt>
            <dd>{{ $passCondition->embassyft }}</dd>
            <dt>Embassyfts</dt>
            <dd>{{ $passCondition->embassyfts }}</dd>
            <dt>Lostdocumentsfts</dt>
            <dd>{{ $passCondition->lostdocumentsfts }}</dd>
            <dt>Immunisation</dt>
            <dd>{{ $passCondition->immunisation }}</dd>
            <dt>Visa</dt>
            <dd>{{ $passCondition->visa }}</dd>
            <dt>Note</dt>
            <dd>{{ $passCondition->note }}</dd>
            <dt>Longtext</dt>
            <dd>{{ $passCondition->longtext }}</dd>
            <dt>Longtext En</dt>
            <dd>{{ $passCondition->longtext_en }}</dd>
            <dt>Longtext Fr</dt>
            <dd>{{ $passCondition->longtext_fr }}</dd>
            <dt>Longtext It</dt>
            <dd>{{ $passCondition->longtext_it }}</dd>
            <dt>Longtext Nl</dt>
            <dd>{{ $passCondition->longtext_nl }}</dd>
            <dt>Longtext Pl</dt>
            <dd>{{ $passCondition->longtext_pl }}</dd>
            <dt>Longtext Es</dt>
            <dd>{{ $passCondition->longtext_es }}</dd>
            <dt>Longtext Pt</dt>
            <dd>{{ $passCondition->longtext_pt }}</dd>
            <dt>Longtext Be</dt>
            <dd>{{ $passCondition->longtext_be }}</dd>
            <dt>Longtext Ru</dt>
            <dd>{{ $passCondition->longtext_ru }}</dd>
            <dt>Linkresource</dt>
            <dd>{{ $passCondition->linkresource }}</dd>
            <dt>Textresource</dt>
            <dd>{{ $passCondition->textresource }}</dd>
            <dt>Resourcechanged</dt>
            <dd>{{ $passCondition->resourcechanged }}</dd>
            <dt>Status</dt>
            <dd>{{ $passCondition->status }}</dd>
            <dt>Importantchange</dt>
            <dd>{{ $passCondition->importantchange }}</dd>
            <dt>Controlled At</dt>
            <dd>{{ $passCondition->controlled_at }}</dd>
            <dt>Controlled User</dt>
            <dd>{{ $passCondition->controlled_user }}</dd>
            <dt>Controlled Ip</dt>
            <dd>{{ $passCondition->controlled_ip }}</dd>
            <dt>Created At</dt>
            <dd>{{ $passCondition->created_at }}</dd>
            <dt>Created User</dt>
            <dd>{{ $passCondition->created_user }}</dd>
            <dt>Created Ip</dt>
            <dd>{{ $passCondition->created_ip }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $passCondition->updated_at }}</dd>
            <dt>Updated User</dt>
            <dd>{{ $passCondition->updated_user }}</dd>
            <dt>Updated Ip</dt>
            <dd>{{ $passCondition->updated_ip }}</dd>
            <dt>Archive</dt>
            <dd>{{ $passCondition->archive }}</dd>
            <dt>Active</dt>
            <dd>{{ $passCondition->active }}</dd>

        </dl>

    </div>
</div>

@endsection

@section('js_after')
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
    <script src="/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/js/plugins/jquery-validation/additional-methods.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/pages/be_forms_wizard.min.js"></script>
    <script src="/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/js/plugins/simplemde/simplemde.min.js"></script>
    <script src="/js/plugins/ckeditor/ckeditor.js"></script>


    <!-- Page JS Helpers (BS Datepicker + CKEditor + Select2 plugins) -->
    <script>jQuery(function(){ Dashmix.helpers(['datepicker', 'ckeditor', 'select2']); });</script>
@endsection
