@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@index', 'View All Projects') }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        @if ($project)
            <h2>{{ $project->project_name }}</h2>
        @else
            <h2>{{ $page_title }}</h2>
        @endif
    </div>

    @if ($project)
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Project Details</h4>
                    </div>
                    <div class="">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <th>Client:</th>
                                    <td>{{ $project->client->client_name }}</td>
                                </tr>
                                <tr>
                                    <th>Project Name:</th>
                                    <td>{{ $project->project_name }}</td>
                                </tr>
                                <tr>
                                    <th>Project Lead Email:</th>
                                    <td>{{ $project->project_lead_email_address }}</td>
                                </tr>
                                <tr>
                                    <th>Project Lead Phone:</th>
                                    <td>{{ $project->project_lead_phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Project Description:</th>
                                    <td>{{ $project->project_description }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date:</th>
                                    <td>{{ $project->start_date }}</td>
                                </tr>
                                <tr>
                                    <th>Due Date:</th>
                                    <td>{{ $project->due_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if ($allow_elevated_access)
                        <div class="panel-footer">
                            <ul class="list-inline list-unstyled">
                                <li><a href="/projects/{{ $project->id }}/edit" class="btn btn-default"><i class="fa fa-wrench"></i> edit</a> </li>
                                @if ($milestones->count() < 1)
                                    <li><a href="" class="btn btn-success"><i class="fa fa-plus"></i> Add Milestone</a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div><!--/panel-->
            </div><!--/col-md-8-->
        </div><!--/row-->

        @if (!$milestones->isEmpty())
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Milestones</h4>
                </div>
                <div class="">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>Milestone</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($milestones as $milestone)
                                <tr>
                                    <td>{{ $milestone->milestone_name }}</td>
                                    <td>{{ $milestone->start_date }}</td>
                                    <td>{{ $milestone->due_date }}</td>
                                    <th>{{ link_to_action('MilestoneController@show', 'details', ['id' => $milestone->id], ['class' => 'btn btn-default']) }}</th>
                                    <td>
                                        @if($allow_elevated_access)
                                            {{ link_to_action('MilestoneController@edit', 'edit', ['id' => $milestone->id], ['class' => 'btn btn-default']) }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($allow_elevated_access)
                    <div class="panel-footer">
                        <ul class="list-inline list-unstyled">
                            <li><a href="/milestones/create/?project_id={{ $project->id }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Milestone</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        @endif
    @else
        <div class="alert alert-info">
            <p>No project found.</p>
        </div>
    @endif

@endsection