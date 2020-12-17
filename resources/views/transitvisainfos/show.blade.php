@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Transitvisa Info details</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item">Basicdatas</li>
                        <li class="breadcrumb-item active" aria-current="page">Transitvisa Info</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    <!-- card -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('transitvisainfos.index') }}" class="btn-block-option" title="Show All Transitvisa Info">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('transitvisainfos.edit', $transitvisainfo->id ) }}" class="btn-block-option" title="Edit Transitvisa Info">
                            <span class="si si-pencil" aria-hidden="true"></span>
                        </a>

                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle">
                            <i class="si si-size-fullscreen"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-5 col-md-6">
                            <dt>Position</dt>
                            <dd>{{ $transitvisainfo->position }}</dd>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10 col-md-12">
                            <dt style="margin-top:15px;">Content</dt>
                            <dd>{{ $transitvisainfo->content }}</dd>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10 col-md-12">
                            <dt style="margin-top:15px;">Content Code</dt>
                            <dd>{!! $transitvisainfo->contentcode !!}</dd>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-md-12">
                            <h2 class="content-heading">Translation</h2>
                            <div class="js-wizard-simple block block block-rounded block-bordered">
                                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                                    @foreach($languages as $language)
                                        <li class="nav-item">
                                            <a class="nav-link language-tab-link" href="#language-{{ $language->id }}" data-toggle="tab">{{ $language->content }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="block-content block-content-full tab-content" style="min-height: 290px;">
                                    @foreach($languages as $language)
                                        <div class="tab-pane" id="language-{{ $language->id }}" role="tabpanel">
                                            {{ $language->languageContent }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
    <script src="/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/js/plugins/jquery-validation/additional-methods.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/pages/be_forms_wizard.min.js"></script>
    <script src="/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/js/plugins/simplemde/simplemde.min.js"></script>
    <script src="/js/plugins/ckeditor/ckeditor.js"></script>


    <!-- Page JS Helpers (Summernote + SimpleMDE + CKEditor plugins) -->
    <script>jQuery(function(){ Dashmix.helpers(['datepicker', 'summernote', 'simplemde', 'ckeditor', 'select2']); });</script>
@endsection
