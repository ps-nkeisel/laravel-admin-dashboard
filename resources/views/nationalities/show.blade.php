@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Nationality details</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Nationality</li>
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
                        <a href="{{ route('nationalities.index') }}" class="btn-block-option" title="Show All Nationality">
                            <i class="si si-list"></i>
                        </a>

                        <a href="{{ route('nationalities.create') }}" class="btn-block-option" title="Create New Nationality">
                            <span class="si si-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('nationalities.edit', $nationality->id ) }}" class="btn-block-option" title="Edit Nationality">
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
                    @if($nationality->active == 1)
                        <button type="button" class="btn btn-sm btn-success mr-1 mb-3">
                            active
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-warning mr-1 mb-3">
                            inactive
                        </button>
                    @endif

                        <div class="row" style="margin-bottom:40px;">
                            <div class="col-sm-10 col-md-6">
                                <dt style="margin-top:15px;">Code</dt>
                                <dd>{{ $nationality->code }}</dd>
                                <dt style="margin-top:15px;">Name De</dt>
                                <dd>{{ $nationality->name_de }}</dd>
                                <dt style="margin-top:15px;">Name En</dt>
                                <dd>{{ $nationality->name_en }}</dd>
                                <dt style="margin-top:15px;">Name Fr</dt>
                                <dd>{{ $nationality->name_fr }}</dd>
                                <dt style="margin-top:15px;">Name It</dt>
                                <dd>{{ $nationality->name_it }}</dd>
                                <dt style="margin-top:15px;">Name Nl</dt>
                                <dd>{{ $nationality->name_nl }}</dd>
                                <dt style="margin-top:15px;">Name Pl</dt>
                                <dd>{{ $nationality->name_pl }}</dd>
                                <dt style="margin-top:15px;">Name Es</dt>
                                <dd>{{ $nationality->name_es }}</dd>
                                <dt style="margin-top:15px;">Name Pt</dt>
                                <dd>{{ $nationality->name_pt }}</dd>
                                <dt style="margin-top:15px;">Name Ru</dt>
                                <dd>{{ $nationality->name_ru }}</dd>
                            </div>
                            <div class="col-sm-10 col-md-6">
                                <dt style="margin-top:15px;">Prio</dt>
                                <dd>{{ $nationality->prio }}</dd>
                                <dt style="margin-top:15px;">Created At</dt>
                                <dd>{{ $nationality->created_at }}</dd>
                                <dt style="margin-top:15px;">Created User</dt>
                                <dd>{{ $nationality->createdUser->name ?? '' }}</dd>
                                <dt style="margin-top:15px;">Created Ip</dt>
                                <dd>{{ $nationality->created_ip }}</dd>
                                <dt style="margin-top:15px;">Updated At</dt>
                                <dd>{{ $nationality->updated_at }}</dd>
                                <dt style="margin-top:15px;">Updated User</dt>
                                <dd>{{ $nationality->updatedUser->name ?? '' }}</dd>
                                <dt style="margin-top:15px;">Updated Ip</dt>
                                <dd>{{ $nationality->updated_ip }}</dd>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

@endsection
