@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@show', $project->project_name, ['id' => $project->id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    {{ Form::open() }}
        <div class="form-group">
            {{ Form::label('project_id', '*Project:') }}
            <p class="form-control-static">
                {{ $project->project_name }}
            </p>
        </div>

        <div class="form-group">
            {{ Form::label('milestone_name', '*Milestone:') }}
            {{ Form::text('milestone_name', NULL, ['class' => 'form-control']) }}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('start_date', 'Start Date:') }}
                    <div class="input-group">
                        {{ Form::text('start_date', date('Y-m-d'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
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
                        {{ Form::text('due_date', date('Y-m-d'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        <label for="due_date" class="input-group-addon btn">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        {{ Form::hidden('project_id', $project->id) }}
    {{ Form::close() }}
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
    </script>
@endsection