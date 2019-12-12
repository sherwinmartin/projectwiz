@extends('layouts.app')

@section('content')
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            {{ link_to_route('dashboard', 'Home') }}
        </li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    <section id="holidays" class="mt-3">
        <div class="card">
            <div class="card-body">
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
                                    <td>{{ $holiday->name }}</td>
                                    <td>{{ $holiday->holiday_date }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('holidays.edit', ['holiday' => $holiday->id]) }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-wrench"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        <p>Holiday not found.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection