@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ClientController@index', 'View All Clients') }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    {{ Form::open(['method' => 'POST', 'action' => 'ClientController@store']) }}
        <div class="form-group">
            {{ Form::label('client_name', '*Client Name:') }}
            {{ Form::text('client_name', NULL, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}

@endsection