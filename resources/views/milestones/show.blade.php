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
@endsection