@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{ link_to_route('dashboard', 'Home') }}
        </li>
        <li class="breadcrumb-item">
            {{ link_to_route('holidays.index', 'Holidays') }}
        </li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    <section id="create-form" class="mt-3">
        <div class="card">
            <div class="card-body">
                {{ Form::open(['method' => 'POST', 'action' => 'HolidayController@store']) }}
                    @include('holidays.partials.form')

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>

@endsection

@section('custom_js_footer')
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
        $('#holiday_date').datepicker(
        {
            'dateFormat': 'yy-mm-dd',
            'changeMonth': true,
            'changeYear': true
        });
    </script>
@endsection