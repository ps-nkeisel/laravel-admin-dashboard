@extends('layouts.backend')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Pass Condition' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('pass_conditions.pass_condition.index') }}" class="btn btn-primary" title="Show All Pass Condition">
                    <span class="fa fa-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('pass_conditions.pass_condition.create') }}" class="btn btn-success" title="Create New Pass Condition">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('pass_conditions.pass_condition.update', $passCondition->id) }}" id="edit_pass_condition_form" name="edit_pass_condition_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('pass_conditions.form', [
                                        'passCondition' => $passCondition,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Update" onclick="this.style.display = 'none'">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
