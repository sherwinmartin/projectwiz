<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ $page_title }}</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        @yield('custom_js_head')
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
        <nav class="navbar navbar-expand-sm justify-content-between" role="navigation">
            <div class="container-fluid">

                <button type="button"
                        class="navbar-toggler"
                        data-toggle="collapse"
                        data-target="#navbar-collapse-1">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{!! URL::asset('assets/images/projectwiz.png') !!}" class="brand img-responsive" style="height: 30px;" alt="ProjectWiz" />
                </a>


                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="navbar-nav">
                        @if (App\User::hasRoles('admin,manager'))
                            <li class="nav-item dropdown{{ (isset($navi_group) && $navi_group == 'holidays') ? ' active' : '' }}">
                                <a href="#"
                                   class="nav-link dropdown-toggle"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false">Holidays <span class="caret"></span></a>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item{{ (isset($navi_group) && ($navi_group == 'holidays') && ($navi_submenu == 'holidays.index')) ? ' active' : '' }}"
                                        href="{{ route('holidays.index') }}">View All
                                    </a>
                                    <a class="dropdown-item{{ (isset($navi_group) && ($navi_group == 'holidays') && ($navi_submenu == 'holidays.create')) ? ' active' : '' }}"
                                        href="{{ route('holidays.create') }}">Create New Holiday
                                    </a>
                                </div>
                            </li>

                            <li{!! (isset($navi_group) && $navi_group == 'clients') ? ' class=active' : '' !!}>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clients <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li{!! (isset($navi_group) && ($navi_group == 'clients') && ($navi_submenu == 'index')) ? ' class=active' : '' !!}>
                                        {{ link_to_action('ClientController@index', 'View All Clients') }}
                                    </li>
                                    <li{!! (isset($navi_group) && ($navi_group == 'clients') && ($navi_submenu == 'create')) !!}>
                                        {{ link_to_action('ClientController@create', 'Create New Client') }}
                                    </li>
                                </ul>
                            </li>

                            <li{!! (isset($navi_group) && $navi_group == 'projects') ? ' class=active' : '' !!}>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projects <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li{!! (isset($navi_group) && ($navi_group == 'projects') && ($navi_submenu == 'index')) ? ' class=active' : '' !!}>
                                        {{ link_to_action('ProjectController@index', 'View All Projects') }}
                                    </li>
                                    <li{!! (isset($navi_group) && ($navi_group == 'projects') && ($navi_submenu == 'create')) ? ' class=active' : '' !!}>
                                        {{ link_to_action('ProjectController@create', 'Create New Project') }}
                                    </li>
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
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">
                                    Log In
                                </a>
                            </li>
                        @else
                            <li>{{--!! link_to_action('UserController@myProfile', 'My Profile') !!--}}</li>
                            <li class="nav-item">
                                <a href="/logout" class="nav-link">
                                    Log Out
                                </a>
                            </li>
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

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        @yield('custom_js_footer')
    </body>
</html>