@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('TaskController@show', $task->milestone->project->project_name, ['id' => $task->milestone->project->id]) }}</li>
        <li>{{ link_to_action('TaskController@show', $task->milestone->milestone_name, ['id' => $task->milestone->id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $task->task_name }}</h2>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ $page_title }}</h4>
        </div>
        <div class="">
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <th>Task:</th>
                        <td>{{ $task->task_name }}</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td>{{ $task->description }}</td>
                    </tr>
                    <tr>
                        <th>Start Date:</th>
                        <td>{{ $task->start_date }}</td>
                    </tr>
                    <tr>
                        <th>Due Date:</th>
                        <td>{{ $task->due_date }}</td>
                    </tr>
                    <tr>
                        <th>Completion Status:</th>
                        <td>{{ $task->completion_status }}%</td>
                    </tr>
                    <tr>
                        <th>Predecessor Task:</th>
                        <td>{!! ($predecessor_task) ? $predecessor_task->task_name : '' !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($allow_elevated_access)
            <div class="panel-footer">
                <a class="btn btn-default" href="/tasks/{{ $task->id }}/edit"><i class="fa fa-wrench"></i> edit</a>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-6">
            @if (!$assigned_users->isEmpty())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Assigned Users</h4>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach ($assigned_users as $task_user)
                                {{ Form::open(['method' => 'DELETE', 'action' => ['TaskUserController@destroy', 'id' => $task_user->id]]) }}
                                    <button class="list-group-item task-user-btn"><i class="fa phpdebugbar-fa-minus-square text-danger"></i> {{ $task_user->user->first_name }}</button>
                                {{ Form::close() }}
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <p>No user assigned.</p>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            @if (count($available_users) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Available Users</h4>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach ($available_users as $user)
                                <a class="list-group-item" href="/task-user/add?user_id={{ $user->id }}&task_id={{ $task->id }}"><i class="fa fa-plus-square text-success"></i> {{ $user->first_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <p>No unassigned user.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom_js_footer')
    <script>
        $('.task-user-btn').click(function()
        {
            var cDelete = confirm('Are you sure you want to unassigned this user from the task?');

            if (cDelete == true)
            {
                return true;
            }else{
                return false;
            }
        });
    </script>
@endsection