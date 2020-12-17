@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Tag details</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Tag</li>
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
                        <a href="{{ route('adrheadtags.index') }}" class="btn-block-option" title="Show All Tags">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('adrheadtags.create') }}" class="btn-block-option" title="Create New Tag">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('adrheadtags.edit', $adrheadtag->id) }}" class="btn-block-option" title="Edit Tag">
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
                    @if($adrheadtag->active == 1)
                        <button type="button" class="btn btn-sm btn-success mr-1 mb-3">
                            active
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-warning mr-1 mb-3">
                            inactive
                        </button>
                    @endif
                    <div class="row">
                        <div class="col-sm-10 col-md-12">
                            <dt>Code</dt>
                            <dd class="mb-3">{{ $adrheadtag->code }}</dd>
                            <dt>Content En</dt>
                            <dd class="mb-3">{{ $adrheadtag->content_en }}</dd>
                            <dt>Content De</dt>
                            <dd class="mb-3">{{ $adrheadtag->content_de }}</dd>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-sm-10 col-md-6">
                            <dt>Created At</dt>
                            <dd class="mb-3">{{ $adrheadtag->created_at }}</dd>
                            <dt>Created User</dt>
                            <dd class="mb-3">{{ $adrheadtag->createdUser->name ?? '' }}</dd>
                            <dt>Created Ip</dt>
                            <dd class="mb-3">{{ $adrheadtag->created_ip }}</dd>
                        </div>
                        <div class="col-sm-10 col-md-6">
                            <dt>Updated At</dt>
                            <dd class="mb-3">{{ $adrheadtag->updated_at }}</dd>
                            <dt>Updated User</dt>
                            <dd class="mb-3">{{ $adrheadtag->updatedUser->name ?? '' }}</dd>
                            <dt>Updated Ip</dt>
                            <dd class="mb-3">{{ $adrheadtag->updated_ip }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection
