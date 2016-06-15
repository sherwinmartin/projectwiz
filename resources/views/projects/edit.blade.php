@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@index', 'View All Projects') }}</li>
        <li>{{ link_to_action('ProjectController@show', $project->project_name, ['id' => $project->id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    @if ($project)
        {{ Form::open(['method' => 'PATCH', 'action' => ['ProjectController@update', 'id' => $project->id]]) }}
            <div class="form-group">
                {{ Form::label('client_id', '*Client:') }}
                {{ Form::select('client_id', $clients, $project->client_id, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('project_name', '*Project Name:') }}
                {{ Form::text('project_name', $project->project_name, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('project_lead_name', 'Project Lead Name:') }}
                {{ Form::text('project_lead_name', $project->project_lead_name, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('project_lead_email_address', 'Project Lead Email Address:') }}
                {{ Form::email('project_lead_email_address', $project->project_lead_email_address, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('project_lead_phone_number', 'Project Lead Phone Number:') }}
                {{ Form::text('project_lead_phone_number', $project->project_lead_phone_number, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('project_description', 'Project Description:') }}
                {{ Form::textarea('project_description', $project->project_description, ['class' => 'form-control']) }}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('start_date', 'Start Date:') }}
                        <div class="input-group">
                            {{ Form::text('start_date', $project->start_date, ['class' => 'form-control', 'readonly' => 'readonly']) }}
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
                            {{ Form::text('due_date', $project->due_date, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                            <label for="due_date" class="input-group-addon btn">
                                <i class="fa fa-calendar"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{ Form::hidden('id', $project->id) }}
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

        @if (!$has_milestones)
            <hr>
            {{ Form::open(['method' => 'DELETE', 'action' => ['ProjectController@destroy', 'id' => $project->id]]) }}
                {{ Form::submit('Delete Project', ['class' => 'btn btn-danger']) }}
                {{ Form::hidden('id', $project->id) }}
            {{ Form::close() }}
        @endif
    @else
        <div class="alert alert-info">
            <p>No project found.</p>
        </div>
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
            var cDelete = confirm('Are you sure you want to delete this project?');

            if (cDelete == true)
            {
                return true;
            }else{
                return false;
            }
        });
    </script>
@endsection