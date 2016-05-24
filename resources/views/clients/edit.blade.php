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

    @if ($client)
        {{ Form::open(['method' => 'PATCH', 'action' => ['ClientController@update', 'id' => $client->id]]) }}
            <div class="form-group">
                {{ Form::label('client_name', '*Client Name:') }}
                {{ Form::text('client_name', $client->client_name, ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
            {{ Form::hidden('id', $client->id) }}
        {{ Form::close() }}

        @if (!$has_project)
            <hr>
            {{ Form::open(['method' => 'DELETE', 'action' => ['ClientController@destroy', 'id' => $client->id]]) }}
                {{ Form::hidden('id', $client->id) }}
                {{ Form::submit('Delete Client', ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
        @endif
    @else
        <div class="alert alert-info">
            <p>Client not found.</p>
        </div>
    @endif

@endsection

@section('custom_js_footer')
    <script>
        $('.btn-danger').click(function()
        {
            var cDelete = confirm('Are you sure you want to delete this client?');

            if (cDelete == true)
            {
                return true;
            }else{
                return false;
            }
        });
    </script>
@endsection