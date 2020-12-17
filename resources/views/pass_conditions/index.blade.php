@extends('layouts.backend')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Pass Conditions</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('pass_conditions.pass_condition.create') }}" class="btn btn-success" title="Create New Pass Condition">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($passConditions) == 0)
            <div class="panel-body text-center">
                <h4>No Pass Conditions Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Assignto</th>
                            <th>Idversionbefore</th>
                            <th>Idversionnext</th>
                            <th>Version</th>
                            <th>Idcountry</th>
                            <th>Countryfromcode</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($passConditions as $passCondition)
                        <tr>
                            <td>{{ $passCondition->assignto }}</td>
                            <td>{{ $passCondition->idversionbefore }}</td>
                            <td>{{ $passCondition->idversionnext }}</td>
                            <td>{{ $passCondition->version }}</td>
                            <td>{{ $passCondition->idcountry }}</td>
                            <td>{{ $passCondition->countryfromcode }}</td>

                            <td>

                                <form method="POST" action="{!! route('pass_conditions.pass_condition.destroy', $passCondition->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('pass_conditions.pass_condition.show', $passCondition->id ) }}" class="btn btn-info" title="Show Pass Condition">
                                            <span class="far fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('pass_conditions.pass_condition.edit', $passCondition->id ) }}" class="btn btn-primary" title="Edit Pass Condition">
                                            <span class="fa fa-pen" aria-hidden="true"></span>
                                        </a>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $passConditions->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
