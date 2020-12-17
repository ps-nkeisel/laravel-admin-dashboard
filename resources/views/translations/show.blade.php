@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Translation</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Translation</li>
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
                        <a href="{{ route('translations.index') }}" class="btn-block-option">
                            <i class="si si-list"></i>
                        </a>
                        <a href="{{ route('translations.edit',$translation->id)}}" class="btn-block-option">
                            <span class="si si-pencil" aria-hidden="true"></span>
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
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-sm-10 col-md-12">
                        @if($translation->unstable == 1)
                            <button type="button" class="btn btn-sm btn-danger mr-1 mb-3">
                                unstable
                            </button>
                        @endif
                        @if($translation->locked == 1)
                            <button type="button" class="btn btn-sm btn-secondary mr-1 mb-3">
                                locked
                            </button>
                        @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-10 col-md-12">
                            <dt>Language Code</dt>
                            <dd class="mb-3">{{ $translation->code }}</dd>
                            <dt>Namespace</dt>
                            <dd class="mb-3">{{ $translation->namespace }}</dd>
                            <dt>Group</dt>
                            <dd class="mb-3">{{ $translation->group }}</dd>
                            <dt>Item</dt>
                            <dd class="mb-3">{{ $translation->item }}</dd>
                            <dt>Text</dt>
                            <dd class="mb-3">{{ $translation->text }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection
