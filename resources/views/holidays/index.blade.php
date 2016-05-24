@extends('layouts.default')

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    @if (!$holidays->isEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Holiday Name</th>
                    <th>Date</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($holidays as $holiday)
                    <tr>
                        <td>{{ $holiday->holiday_name }}</td>
                        <td>{{ $holiday->holiday_date }}</td>
                        <td class="text-right">{{ link_to_action('HolidayController@edit', 'edit', ['id' => $holiday->id], ['class' => 'btn btn-default']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            <p>Holiday not found.</p>
        </div>
    @endif

@endsection