@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('ProjectController@index', 'View All Projects') }}</li>
        <li>{{ link_to_action('ProjectController@show', $milestone->project_name, ['id' => $milestone->project_id]) }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $milestone->milestone_name }}</h2>
    </div>
@endsection