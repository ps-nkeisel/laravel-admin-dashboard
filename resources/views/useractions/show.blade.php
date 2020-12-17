@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ isset($title) ? $title : 'Useraction' }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">More</li>
                        <li class="breadcrumb-item active" aria-current="page">Activities</li>
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
                        <a href="{{ route('useractions.index') }}" class="btn-block-option" title="Show All Useraction">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('useractions.create') }}" class="btn-block-option" title="Create New Useraction">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('useractions.edit', $useraction->id ) }}" class="btn-block-option" title="Edit Useraction">
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
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>

            </div>
            <div class="block-content">
                <div class="card-body">
                                <dt>Active</dt>
            <dd>{{ ($useraction->active) ? 'Yes' : 'No' }}</dd>
            <dt>Assigntonew</dt>
            <dd>{{ $useraction->assigntonew }}</dd>
                    <dt>Assigntoold</dt>
                    <dd>{{ $useraction->assigntoold }}</dd>
            <dt>Assigntype</dt>
            <dd>{{ $useraction->assigntype }}</dd>
            <dt>Comment</dt>
            <dd>{{ $useraction->comment }}</dd>
            <dt>Created At</dt>
            <dd>{{ $useraction->created_at }}</dd>
            <dt>Created Ip</dt>
            <dd>{{ $useraction->created_ip }}</dd>
            <dt>Created User</dt>
            <dd>{{ $useraction->created_user }}</dd>
            <dt>Type</dt>
            <dd>{{ $useraction->type }}</dd>

                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection
