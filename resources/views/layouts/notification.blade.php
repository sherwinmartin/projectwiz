@if (Session::has('success'))
    <div class="container">
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>{!! Session::get('success') !!}</p>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="container">
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>{!! Session::get('error') !!}</p>
        </div>
    </div>
@endif

@if (Session::has('info'))
    <div class="container">
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>{!! Session::get('info') !!}</p>
        </div>
    </div>
@endif

@if (Session::has('warning'))
    <div class="container">
        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <p>{!! Session::get('warning') !!}</p>
        </div>
    </div>
@endif

@if ($errors->has())
    <div class="container">
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert">x</button>
            @foreach ($errors->all() as $error)
                <p>{!! $error !!}</p>
            @endforeach
        </div>
    </div>
@endif