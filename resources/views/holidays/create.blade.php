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

    {{ Form::open(['method' => 'POST', 'action' => 'HolidayController@store']) }}
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="form-group">
                    {{ Form::label('holiday_name', '*Holiday Name:') }}
                    {{ Form::text('holiday_name', NULL, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                {{ Form::label('holiday_date', '*Holiday Date:') }}
                <div class="input-group">
                    {{ Form::text('holiday_date', date('Y-m-d'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
                    <label for="holiday_date" class="input-group-addon btn">
                        <i class="fa fa-calendar"></i>
                    </label>
                </div>
            </div>
        </div>
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
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