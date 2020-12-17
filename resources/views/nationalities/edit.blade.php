@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/js/plugins/simplemde/simplemde.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Nationality edit</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Nationality</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    @include('shared.error')

    <!-- card -->
    <div class="content content-full">
        <form method="POST" action="{{ route('nationalities.update', $nationality->id) }}" id="edit_nationality_form" name="edit_nationality_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Details</h3>
                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <div class="block-options pl-3 pr-2">
                            <a href="{{ route('nationalities.index') }}" title="Show All Nationality" class="btn-block-option">
                                <i class="si si-list"></i>
                            </a>

                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="fullscreen_toggle">
                                <i class="si si-size-fullscreen"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row justify-content-left py-sm-3 py-md-5" style="padding-top: 1rem !important;">
                        @include ('nationalities.form', [
                                        'nationality' => $nationality,
                                      ])
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light">
                    <button type="submit" class="btn btn-sm btn-success" onclick="this.style.display = 'none'">
                        <i class="fa fa-check"></i> Update
                    </button>
                    <button type="reset" class="btn btn-sm btn-light">
                        <i class="fa fa-repeat"></i> Reset
                    </button>
                </div>
            </div>
        </form>

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
