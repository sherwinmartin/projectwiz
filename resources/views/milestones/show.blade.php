@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@show', $milestone->project->project_name, ['id' => $milestone->project->id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $milestone->milestone_name }}</h2>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Milestone Details</h4>
        </div>
        <div class="">
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <th>Project:</th>
                        <td>{{ $milestone->project->project_name }}</td>
                    </tr>
                    <tr>
                        <th>Milestone:</th>
                        <td>{{ $milestone->milestone_name }}</td>
                    </tr>
                    <tr>
                        <th>Start Date:</th>
                        <td>{{ $milestone->start_date }}</td>
                    </tr>
                    <tr>
                        <th>Due Date:</th>
                        <td>{{ $milestone->due_date }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($allow_elevated_access)
            <div class="panel-footer">
                <a class="btn btn-default" href="/milestones/{{ $milestone->id }}/edit"><i class="fa fa-wrench"></i> edit</a>
            </div>
        @endif
    </div>

    @if (!$tasks->isEmpty())
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Tasks</h4>
            </div>
            <div class="">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->task_name }}</td>
                                <td>{{ $task->start_date }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ link_to_action('TaskController@show', 'details', ['id' => $task->id], ['class' => 'btn btn-default']) }}</td>
                                <td>
                                    @if($allow_elevated_access)
                                        {{ link_to_action('TaskController@edit', 'edit', ['id' => $task->id], ['class' => 'btn btn-default']) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($allow_elevated_access)
                <div class="panel-footer">
                    <a class="btn btn-success" href="/tasks/create/?milestone_id={{ $milestone->id }}">Add Task</a>
                </div>
            @endif
        </div>
    @else
        <div class="alert alert-info">
            <p>No task found.</p>
        </div>
    @endif
@endsection