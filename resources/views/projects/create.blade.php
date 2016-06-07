@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@index', 'View All Projects') }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    {{ Form::open(['method' => 'POST', 'action' => 'ProjectController@store']) }}
        <div class="form-group">
            {{ Form::label('client_id', '*Client:') }}
            {{ Form::select('client_id', $clients, NULL, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('project_name', '*Project Name:') }}
            {{ Form::text('project_name', NULL, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('project_lead_name', 'Project Lead Name:') }}
            {{ Form::text('project_lead_name', NULL, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('project_lead_email_address', 'Project Lead Email Address:') }}
            {{ Form::email('project_lead_email_address', NULL, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('project_lead_phone_number', 'Project Lead Phone Number:') }}
            {{ Form::text('project_lead_phone_number', NULL, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('project_description', 'Project Description:') }}
            {{ Form::textarea('project_description', NULL, ['class' => 'form-control']) }}
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