@extends('layouts.default')

@section('custom_css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
    <ul class="breadcrumb">
        <li>{{ link_to_action('DashboardController@index', 'Home') }}</li>
        <li>{{ link_to_action('HolidayController@index', 'View All Holidays') }}</li>
        <li class="active">{{ $page_title }}</li>
    </ul>

    <div class="page-header">
        <h2>{{ $page_title }}</h2>
    </div>

    @if ($holiday)
        {{ Form::open(['method' => 'PATCH', 'action' => ['HolidayController@update', 'id' => $holiday->id]]) }}
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="form-group">
                        {{ Form::label('holiday_name', '*Holiday Name:') }}
                        {{ Form::text('holiday_name', $holiday->holiday_name, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    {{ Form::label('holiday_date', '*Holiday Date:') }}
                    <div class="input-group">
                        {{ Form::text('holiday_date', $holiday->holiday_date, ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        <label for="holiday_date" class="input-group-addon btn">
                            <i class="fa fa-calendar"></i>
                        </label>
                    </div>
                </div>
            </div>

            {{ Form::hidden('id', $holiday->id) }}
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

        <hr>

        {{ Form::open(['method' => 'DELETE', 'action' => ['HolidayController@destroy', 'id' => $holiday->id]]) }}
            {{ Form::submit('Delete Holiday', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
    @else
        <div class="alert alert-info">
            <p>Holiday not found.</p>
        </div>
    @endif
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

        $('.btn-danger').click(function()
        {
            var cDelete = confirm('Are you sure you want to delete this holiday?');

            if (cDelete == true)
            {
                return true;
            }else{

                return false;
            }
        });
    </script>
@endsection