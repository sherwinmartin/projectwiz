@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    @if (!$clients->isEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->client_name }}</td>
                        <td class="text-right">{{ link_to_action('ClientController@edit', 'edit', ['id' => $client->id], ['class' => 'btn btn-default']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            <p>Client not found.</p>
        </div>
    @endif
@endsection