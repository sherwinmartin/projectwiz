@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@show', $milestone->project->project_name, ['id' => $milestone->project->id]) }}</li>
        <li>{{ link_to_action('MilestoneController@show', $milestone->milestone_name, ['id' => $milestone->id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    {{ Form::open(['method' => 'POST', 'action' => 'TaskController@store']) }}
        <div class="form-group">
            {{ Form::label('milestone_id', '*Milestone:') }}
            <p class="form-control-static">{{ $milestone->milestone_name }}</p>
        </div>

        <div class="form-group">
            {{ Form::label('task_name', '*Task:') }}
            {{ Form::text('task_name', NULL, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('task_description', 'Task Description:') }}
            {{ Form::textarea('task_description', NULL, ['class' => 'form-control']) }}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('start_date', 'Start Date:') }}
                    <div class="input-group">
                        {{ Form::text('start_date', NULL, ['class' => 'form-control', 'readonly' => 'readonly']) }}
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
                        {{ Form::text('due_date', NULL, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        <label for="due_date" class="input-group-addon btn">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-3">
                <div class="form-group">
                    {{ Form::label('completion_status', '*Completion Status:') }}
                    {{ Form::select('completion_status', $percentages, 0, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-9">
                <div class="form-group">
                    {{ Form::label('predecessor_task_id', '*Predecessor Task:') }}
                    {{ Form::select('predecessor_task_id', ['No Predecessor Task']+$predecessor_tasks, NULL, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('notes', 'Notes:') }}
            {{ Form::textarea('notes', NULL, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        {{ Form::hidden('milestone_id', $milestone->id) }}
    {{ Form::close() }}
@endsection