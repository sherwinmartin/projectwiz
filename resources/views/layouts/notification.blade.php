@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{{ Session::get('success') }}</p>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{{ Session::get('info') }}</p>
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-info alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{{ Session::get('status') }}</p>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{{ Session::get('warning') }}</p>
    </div>
@endif

@if ($errors->has(''))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif