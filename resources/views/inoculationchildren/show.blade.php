@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ isset($title) ? $title : 'Inoculationchild' }}</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Einstellungen</li>
                        <li class="breadcrumb-item active" aria-current="page">Inoculationchildren</li>
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
                        <a href="{{ route('inoculationchildren.index') }}" class="btn-block-option" title="Show All Inoculationchild">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('inoculationchildren.create') }}" class="btn-block-option" title="Create New Inoculationchild">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('inoculationchildren.edit', $inoculationchild->id ) }}" class="btn-block-option" title="Edit Inoculationchild">
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
                                <dt style="margin-top:15px;">Assignto</dt>
            <dd>{{ $inoculationchild->assignto }}</dd>
            <dt style="margin-top:15px;">Lang</dt>
            <dd>{{ $inoculationchild->lang }}</dd>
            <dt style="margin-top:15px;">Position</dt>
            <dd>{{ $inoculationchild->position }}</dd>
            <dt style="margin-top:15px;">Content</dt>
            <dd>{{ $inoculationchild->content }}</dd>
            <dt style="margin-top:15px;">Controlled At</dt>
            <dd>{{ $inoculationchild->controlled_at }}</dd>
            <dt style="margin-top:15px;">Controlled User</dt>
            <dd>{{ $inoculationchild->controlled_user }}</dd>
            <dt style="margin-top:15px;">Controlled Ip</dt>
            <dd>{{ $inoculationchild->controlled_ip }}</dd>
            <dt style="margin-top:15px;">Created User</dt>
            <dd>{{ $inoculationchild->created_user }}</dd>
            <dt style="margin-top:15px;">Created Ip</dt>
            <dd>{{ $inoculationchild->created_ip }}</dd>
            <dt style="margin-top:15px;">Updated User</dt>
            <dd>{{ $inoculationchild->updated_user }}</dd>
            <dt style="margin-top:15px;">Updated Ip</dt>
            <dd>{{ $inoculationchild->updated_ip }}</dd>
            <dt style="margin-top:15px;">Created At</dt>
            <dd>{{ $inoculationchild->created_at }}</dd>
            <dt style="margin-top:15px;">Updated At</dt>
            <dd>{{ $inoculationchild->updated_at }}</dd>

                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection