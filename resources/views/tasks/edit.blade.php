@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@show', $task->milestone->project->project_name, ['id' => $task->milestone->project->id]) }}</li>
        <li>{{ link_to_action('MilestoneController@show', $task->milestone->milestone_name, ['id' => $task->milestone->id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>Edit {{ $task->task_name }}</h2>
    </div>

    {{ Form::open(['method' => 'PATCH', 'action' => ['TaskController@update', 'id' => $task->id]]) }}
        <div class="form-group">
            {{ Form::label('milestone_id', '*Milestone:') }}
            <p class="form-control-static">{{ $task->milestone->milestone_name }}</p>
        </div>

        <div class="form-group">
            {{ Form::label('task_name', '*Task:') }}
            {{ Form::text('task_name', $task->task_name, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('task_description', 'Task Description:') }}
            {{ Form::textarea('task_description', $task->task_description, ['class' => 'form-control']) }}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('start_date', 'Start Date:') }}
                    <div class="input-group">
                        {{ Form::text('start_date', $task->start_date, ['class' => 'form-control', 'readonly' => 'readonly']) }}
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
                        {{ Form::text('due_date', $task->due_date, ['class' => 'form-control', 'readonly' => 'readonly']) }}
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
                    {{ Form::select('completion_status', $percentages, $task->completion_status, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-10 col-sm-9 col-xs-9">
                <div class="form-group">
                    {{ Form::label('predecessor_task_id', '*Predecessor Task:') }}
                    {{ Form::select('predecessor_task_id', ['No Predecessor Task']+$predecessor_tasks, $task->predecessor_task_id, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('notes', 'Notes:') }}
            {{ Form::textarea('notes', $task->notes, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        {{ Form::hidden('id', $task->id) }}
        {{ Form::hidden('milestone_id', $task->milestone_id) }}
    {{ Form::close() }}

    @if (!$has_task_user && !$has_predecessor_task)
        <hr>
        {{ Form::open(['method' => 'DELETE', 'action' => ['TaskController@destroy', 'id' => $task->id]]) }}
            {{ Form::submit('Delete Task', ['class' => 'btn btn-danger']) }}
            {{ Form::hidden('id', $task->id) }}
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