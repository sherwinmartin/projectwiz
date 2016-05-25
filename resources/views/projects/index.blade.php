@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    @if (!$projects->isEmpty())
        <nav class="pagination">
            {{ $projects->render() }}
        </nav>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Project Name</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->client->client_name }}</td>
                        <td>{{ $project->project_name }}</td>
                        <td class="text-right">{{ link_to_action('ProjectController@show', 'details', ['id' => $project->id], ['class' => 'btn btn-default']) }}</td>
                        <td class="text-right">{{ link_to_action('ProjectController@edit', 'edit', ['id' => $project->id], ['class' => 'btn btn-default']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <nav class="pagination">
            {{ $projects->render() }}
        </nav>
    @else
        <div class="alert alert-info">
            <p>No project found.</p>
        </div>
    @endif
@endsection