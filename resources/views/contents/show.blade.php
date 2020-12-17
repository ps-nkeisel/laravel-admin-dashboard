@extends('layouts.backend')

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Standard Content</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Standard Content</li>
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
                <h3 class="block-title">Details Version {{ $content->version }}</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">
                    <div class="block-options pl-3 pr-2">
                        <a href="{{ route('contents.index') }}" class="btn-block-option" title="Show All Content">
                            <i class="si si-list"></i>
                        </a>

                        @if($content->archive == 0)
                            @if(count($contentversions) >= 1)
                            <a href="{{ route('contents.edit', $content->id ) }}" class="btn-block-option" title="Edit Content">
                                <span class="si si-pencil" aria-hidden="true"></span>
                            </a>
                            @endif
                        @else
                        <a href="{{ route('contents.show', $contentversions[0]->id ) }}" class="btn-block-option" title="Show last version">
                            <span class="si si-control-end" aria-hidden="true"></span>
                        </a>
                        @endif

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
                    </div>
                </div>

            </div>
            <div class="block-content">
                <div class="card-body" style="padding-bottom:30px;">
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-sm-10 col-md-12">
                        @if($content->active == 1)
                            <button type="button" class="btn btn-sm btn-success mr-1 mb-3">
                                active
                            </button>
                        @else
                            <button type="button" class="btn btn-sm btn-warning mr-1 mb-3">
                                inactive
                            </button>
                        @endif

                        @if($content->archive)
                            <button type="button" class="btn btn-sm btn-secondary mr-1 mb-3">
                                <i class="fa fa-fw fa-archive mr-1"></i> archived
                            </button>
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-6">
                            <dt>Code 1</dt>
                            <dd>{{ $content->code1 }}</dd>
                        </div>

                        <div class="col-sm-5 col-md-6">
                            <dt>Code 2</dt>
                            <dd>{{ $content->code2 }}</dd>
                        </div>
                    </div>

                    <div class="row" style="margin-top:25px;">
                        <div class="col-sm-10 col-md-12">
                        <dt>Headline</dt>
                        <dd>{{ $content->text1 }}</dd>
                        <dt style="margin-top:15px;">Content</dt>
                        <dd>{!! $content->content1 !!}</dd>
                        </div>
                    </div>

                    <div class="row" style="margin-top:40px;">
                        <div class="col-sm-5 col-md-6">
                            <dt>Category</dt>
                            <dd>{{ $content->category_content }}</dd>
                            <dt style="margin-top:15px;">Language</dt>
                            <dd>{{ $content->language_content }}</dd>
                            <dt style="margin-top:15px;">Position</dt>
                            <dd>{{ $content->position }}</dd>
                            <dt style="margin-top:15px;">Active from - to</dt>
                            <dd>{{ $content->validityfrom }} - {{ $content->validityto }}</dd>
                        </div>
                        <div class="col-sm-5 col-md-6">
                            <dt style="margin-top:15px;">Created at</dt>
                            <dd>{{ $content->created_at }}</dd>
                            <dt style="margin-top:15px;">Created User</dt>
                            <dd>{{ $content->createdUser->name }}</dd>
                            <dt>Controlled at</dt>
                            <dd>{{ $content->controlled_at }}</dd>
                            <dt style="margin-top:15px;">Controlled User</dt>
                            <dd>{{ $infosystem->controlledUser->name ?? '' }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->

    <!-- compare versions -->
    @if(count($contentversions) > 1)
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Compare versions</h3>
                <div class="btn-group btn-group-sm pull-right" role="group">

                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="compare-version-first">First version number</label>
                            <input class="form-control form-control-alt" name="compare-version-first"
                                   type="text" id="compare-version-first" maxlength="40"
                                   placeholder="Enter first version number here...">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="compare-version-second">Second version number</label>
                            <input class="form-control form-control-alt" name="compare-version-second"
                                   type="text" id="compare-version-second" maxlength="40"
                                   placeholder="Enter second version number here...">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group" style="margin-top:35px;">
                            <button class="btn btn-sm btn-success"
                                id="compare_versions"
                                data-toggle="modal"
                                data-target="#modalContentCompare"
                            >
                                <i class="fa fa-check"></i> compare
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- end compare versions -->

    <!-- list of all contents with the same assignto ID -->
    @if(count($contentversions) > 1)
        <!-- Start List Pagination -->
        <div class="content content-full">
            <!-- Dynamic Table Full Pagination -->
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default">
                    <h3 class="block-title">List of all versions</h3>
                    <div class="btn-group btn-group-sm pull-right" role="group">

                    </div>
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>version</th>
                            <th>created user</th>
                            <th>created at</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contentversions as $key => $value)
                            @if($content->id == $value->id)
                                <tr style="background-color: #ffecc8;" id="version-{{ $value->version }}" data-id="{{ $value->id }}">
                            @else
                                <tr id="version-{{ $value->version }}" data-id="{{ $value->id }}">
                            @endif

                            <td>{{ $value->id }}</td>
                            <td>{{ $value->version }}</td>
                            <td>{{ $value->createdUser->name }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td class="text-right"><a href="{{ route('contents.show', $value->id ) }}" class="btn btn-sm btn-primary" title="Open Content">
                                    <span class="si si-doc" aria-hidden="true"></span>
                                </a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full Pagination -->
        </div>
        <!-- End List Pagination -->
    @endif
    <!-- end list of all contents with the same assignto ID -->

@endsection

@section('js_after')

    @include('contents.modals.compare')

    <script>
        $(document).ready(function () {
            $('#compare_versions').click(function (event) {
                var v1 = $('#compare-version-first').val();
                var v2 = $('#compare-version-second').val();
                if (v1 > 0 && v2 > 0 && v1 != v2) {
                    var id1 = $('tr#version-'+v1).data('id');
                    var id2 = $('tr#version-'+v2).data('id');
                    if (id1 > 0 && id2 > 0 && id1 != id2) {
                        $('#compare_versions').data('assigntoold', id1);
                        $('#compare_versions').data('assigntonew', id2);
                        return;
                    }
                }
                alert('version invalid');
                event.stopPropagation();
            })
        });
    </script>
@endsection
