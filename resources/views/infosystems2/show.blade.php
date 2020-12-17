@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Infosystem2</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Infosystem2</li>
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
                        <a href="{{ route('infosystems2.index') }}" class="btn-block-option">
                            <i class="si si-list"></i>
                        </a>
                        <a href="{{ route('infosystems2.edit',$infosystem2->id)}}" class="btn-block-option">
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
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-sm-10 col-md-12">
                        @if($infosystem2->tagtype == 1 )
                            <button type="button" class="btn btn-sm btn-primary">{{ $infosystem2->tagtext }}</button>
                        @elseif($infosystem2->tagtype == 2 )
                            <button type="button" class="btn btn-sm btn-info">{{ $infosystem2->tagtext }}</button>
                        @elseif($infosystem2->tagtype == 3 )
                            <button type="button" class="btn btn-sm btn-success">{{ $infosystem2->tagtext }}</button>
                        @elseif($infosystem2->tagtype == 4 )
                            <button type="button" class="btn btn-sm btn-warning">{{ $infosystem2->tagtext }}</button>
                        @elseif($infosystem2->tagtype == 5 )
                            <button type="button" class="btn btn-sm btn-danger">{{ $infosystem2->tagtext }}</button>
                        @else
                            <button type="button" class="btn btn-sm btn-primary">{{ $infosystem2->tagtext }}</button>
                        @endif
                            <button type="button" class="btn btn-sm btn-secondary">{{ $infosystem2->tagdate }}</button>
                        </div>
                    </div>

                    <div class="row" style="margin-top:40px;">
                        <div class="col-sm-10 col-md-12">
                        <dt>Headline</dt>
                        <dd>{{ $infosystem2->header }}</dd>
                        <dt style="margin-top:15px;">Content</dt>
                        <dd>{!! $infosystem2->content  !!}</dd>
                        </div>
                    </div>

                    <div class="row" style="margin-top:25px;">
                        <div class="col-sm-5 col-md-6">
                            <dt>Position</dt>
                            <dd>{{ $infosystem2->position }}</dd>
                            <dt style="margin-top:15px;">Appearance</dt>
                            <dd>{{ $appearance[$infosystem2->appearance] }}</dd>
                            <dt style="margin-top:15px;">Language</dt>
                            <dd>{{ $infosystem2->language_content }}</dd>
                        </div>
                        <div class="col-sm-5 col-md-6">
                            <dt>Created at</dt>
                            <dd>{{ $infosystem2->created_at }}</dd>
                            <dt style="margin-top:15px;">Created User</dt>
                            <dd>{{ $infosystem2->createdUser->name ?? '' }}</dd>
                            <dt>Controlled at</dt>
                            <dd>{{ $infosystem2->controlled_at }}</dd>
                            <dt style="margin-top:15px;">Controlled User</dt>
                            <dd>{{ $infosystem2->controlledUser->name ?? '' }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection
