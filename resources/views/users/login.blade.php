@extends('layouts.default')

@section('content')
    <div class="row projectwiz-login-container">
        <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12">
            <div class="page-header">
                <h1>{{ $page_title }}</h1>
            </div>
            {{ Form::open(['method' => 'POST', 'route' => 'authenticate']) }}
                <div class="form-group">
                    {{ Form::label('username', '*Username:') }}
                    {{ Form::text('username', '', ['class' => 'form-control', 'id' => 'username', 'required', 'autofocus']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password', '*Password:') }}
                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required']) }}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        Log In
                    </button>
                    <a href="{{ route('password.getEmail') }}" class="btn btn-outline-secondary">Password Help</a>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection