<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ $page_title }}</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
        {!! HTML::style('css/app.css') !!}
        @yield('custom_css')
        <!-- For IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="apple-touch-icon" sizes="114x114" href="{!! URL::asset('assets/images/apple-touch-icon-114x114.png') !!}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{!! URL::asset('assets/images/apple-touch-icon-72x72.png') !!}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{!! URL::asset('assets/images/touch-icon-iphone.png') !!}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{!! URL::asset('assets/images/apple-touch-icon-114x114-precomposed.png') !!}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{!! URL::asset('assets/images/apple-touch-icon-72x72-precomposed.png') !!}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{!! URL::asset('assets/images/touch-icon-iphone-precomposed.png') !!}" />
    </head>

    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{!! URL::to('') !!}">
                        <img src="{!! URL::asset('assets/images/projectwiz.png') !!}" class="brand img-responsive" style="height: 30px;" alt="ProjectWiz" />
                    </a>
                </div><!--/.navbar-header-->

                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @if (App\Helpers\ProjectwizHelper::isRole('admin'))
                            <li{!! (isset($navi_group) && $navi_group == 'clients') ? ' class=active' : '' !!}>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clients <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li{!! (isset($navi_group) && ($navi_group) == 'clients' && ($navi_submenu == 'index')) ? ' class=active' : '' !!}>
                                        {{ link_to_action('ClientController@index', 'View All Clients') }}
                                    </li>

                                        {{--!! link_to_route('clients.index', 'View All Clients') !!}</li>

                                    @if (isset($navi_submenu) && $navi_group == 'clients' && $navi_submenu == 'create')
                                        <li class="active">
                                    @else
                                        <li>
                                    @endif
                                        {!! link_to_route('clients.create', 'Create New Client') !!--}}</li>
                                </ul>
                            </li>

                            @if (isset($navi_group) && $navi_group == 'projects')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projects <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @if (isset($navi_submenu) && $navi_group == 'projects' && $navi_submenu == 'index')
                                        <li class="active">
                                    @else
                                        <li>
                                    @endif
                                        {{--!! link_to_route('projects.index', 'View All Projects') !!}</li>

                                    @if (isset($navi_submenu) && $navi_group == 'projects' && $navi_submenu == 'create')
                                        <li class="active">
                                    @else
                                        <li>
                                    @endif
                                            {!! link_to_route('projects.create', 'Create New Project') !!--}}</li>
                                </ul>
                            </li>

                            @if (isset($navi_group) && $navi_group == 'holidays')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Holidays <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @if (isset($navi_submenu) && $navi_group == 'holidays' && $navi_submenu == 'index')
                                        <li class="active">
                                    @else
                                        <li>
                                    @endif
                                    {!! link_to_route('holidays.index', 'View All Holidays') !!}</li>
                                </ul>
                            </li>
                        @endif {{-- endif admin --}}

                                {{--
                        @if (Auth::check())
                            @if (isset($navi_group) && $navi_group == 'project-logs')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Project Logs <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        @if ($navi_group == 'project-logs' && isset($navi_submenu) && $navi_submenu == 'create')
                                            <li class="active">
                                        @else
                                            <li>
                                        @endif
                                            {!! link_to_route('project-logs.create', 'Create New Project Log') !!}</li>

                                        @if ($navi_group == 'project-logs' && isset($navi_submenu) && $navi_submenu == 'my-project-logs')
                                            <li class="active">
                                        @else
                                            <li>
                                        @endif
                                                {!! link_to_action('ProjectLogController@myProjectLogs', 'View All My Project Logs') !!}
                                            </li>

                                        @if ($navi_group == 'project-logs' && isset($navi_submenu) && $navi_submenu == 'search')
                                            <li class="active">
                                        @else
                                            <li>
                                        @endif
                                                {!! link_to_action('ProjectLogController@searchMyProjectLogs', 'Search My Project Logs') !!}</li>
                                    </ul>
                                </li>
                        @endif {{-- endif logged in --}}


                        @if (App\Helpers\ProjectwizHelper::isRole('admin'))
                            <li class="dropdown{!! Request::segment(1) == 'reports' ? ' active' : '' !!}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>{{--!! link_to_action('ReportController@searchTaskUser', 'Search Staff Assignment') !!}</li>
                                    <li>{!! link_to_action('ReportController@exportAllTasks', 'Export All Tasks') !!}</li>
                                    <li>{!! link_to_action('ReportController@projectCompletionStatus', 'Project Completion Status') !!--}}</li>
                                </ul>
                            </li>
                        @endif {{-- endif admin --}}

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li>{!! link_to_action('UserController@login', 'Log In') !!}</li>
                            <li><a href="/login">Log In</a></li>
                        @else
                            <li>{{--!! link_to_action('UserController@myProfile', 'My Profile') !!--}}</li>
                            <li>{!! link_to('/logout', 'Log Out') !!}</li>
                        @endif
                    </ul><!--/.navbar-right-->

                </div>
            </div>
        </nav>

        @if ($navi_group != 'maintenance')
            @include('layouts.notification')
        @endif
        
        <div class="container" id="wrapper">
            @if (getenv('APP_ENV') != 'production')
                <div class="alert alert-warning">
                    <p>{!! getenv('APP_ENV') !!}
                </div>
            @endif

            @yield('content')
        </div><!--/#wrapper-->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <p class="text-center"><small class="muted"></small></p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script src="//cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
        <script src="//cdn.ckeditor.com/4.5.1/standard/adapters/jquery.js"></script>
        {!! HTML::script('assets/js/site.js') !!}
        @yield('custom_js')
    </body>
</html>