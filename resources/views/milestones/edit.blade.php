@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@show', $milestone->project->project_name, ['id' => $milestone->project->id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>Edit {{ $milestone->milestone_name }}</h2>
    </div>

    {{ Form::open(['method' => 'PATCH', 'action' => ['MilestoneController@update', 'id' => $milestone->id]]) }}
        <div class="form-group">
            {{ Form::label('project_id', '*Project:') }}
            <p class="form-control-static">
                {{ $milestone->project->project_name }}
            </p>
        </div>

        <div class="form-group">
            {{ Form::label('milestone_name', '*Milestone:') }}
            {{ Form::text('milestone_name', $milestone->milestone_name, ['class' => 'form-control']) }}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('start_date', 'Start Date:') }}
                    <div class="input-group">
                        {{ Form::text('start_date', $milestone->start_date, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        <label for="start_date" class="input-group-addon btn">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('due_date', 'Due Date:') }}
                    <div class="input-group">
                        {{ Form::text('due_date', $milestone->due_date, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        <label for="due_date" class="input-group-addon btn">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        {{ Form::hidden('id', $milestone->id) }}
        {{ Form::hidden('project_id', $milestone->project_id) }}
    {{ Form::close() }}

    @if (!$has_tasks)
        <hr>
        {{ Form::open(['method' => 'DELETE', 'action' => ['MilestoneController@destroy', 'id' => $milestone->id]]) }}
            {{ Form::submit('Delete Milestone', ['class' => 'btn btn-danger']) }}
            {{ Form::hidden('id', $milestone->id) }}
        {{ Form::close() }}
    @endif
@endsection

@section('custom_js_footer')
    <script>
        $('#start_date').datepicker(
        {
            'dateFormat': 'yy-mm-dd',
            'changeMonth': true,
            'changeYear': true
        });

        $('#due_date').datepicker(
        {
            'dateFormat': 'yy-mm-dd',
            'changeMonth': true,
            'changeYear': true
        });

        $('.btn-danger').click(function()
        {
            var cDelete = confirm('Are you sure you want to delete this milestone?');

            if (cDelete == true)
            {
                return true;
            }else{
                return false;
            }
        });
    </script>
@endsection