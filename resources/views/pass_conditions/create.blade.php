@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')

    <!-- head -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Einreisebestimmung anlegen</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Bestimmungen</li>
                        <li class="breadcrumb-item active" aria-current="page">Einreise</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- end head -->

    <!-- error message -->
    @if ($errors->any())
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="alert alert-danger alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h3 class="alert-heading font-size-h4 my-2">Error</h3>
                @foreach ($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- end error message -->

    <!-- card -->
    <div class="content content-full">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details</h3>
            </div>
            <div class="block-content">
                <div class="card-body">
                    <!-- card content -->
                    <form method="POST" action="{{ route('pass_conditions.pass_condition.store') }}" accept-charset="UTF-8" id="create_pass_condition_form" name="create_pass_condition_form" class="form-horizontal">
                        {{ csrf_field() }}
                        @include ('pass_conditions.form', [
                                                    'passCondition' => null,
                                                  ])

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <input class="btn btn-primary" type="submit" value="Add">
                            </div>
                        </div>

                    </form>
                    <!-- end card content -->
                </div>
            </div>
        </div>
    </div>
    <!-- end card

@endsection


