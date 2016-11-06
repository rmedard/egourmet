<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- sbadmin CSS -->
    <link href="/assets/sbadmin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Awesome Fonts -->
    <link href="/assets/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Mdbootstrap CSS -->
    <link href="/assets/mdb/css/mdb.min.css" rel="stylesheet" type="text/css">

    <!-- jquery UI -->
    <link href="/assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!-- Jasny CSS -->
    <link href="/assets/jasny/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom -->
    <link href="/css/app_admin.css" rel="stylesheet" type="text/css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
    <script src="/assets/jquery/jquery-1.12.4.min.js"></script>
    <script src="/assets/jquery-ui/jquery-ui-1.12.1.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">
                <img src="/images/core/egourmet_logo.png">
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <span style="color: #337ab7">{{trans('gui.welcome')}} {{Auth::check() ? Auth::user()->name : 'unknown'}}</span>
            <li class="dropdown" style="display: none">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i>Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li class="active">
                        <a href="{{route('admin')}}"><i class="fa fa-dashboard fa-fw"></i>{{trans('gui.dashboard')}}</a>
                    </li>

                    <li>
                        <a href="{{route('restos.index')}}"><i class="fa fa-home fa-fw"></i>{{trans('gui.restaurants')}}</a>
                    </li>

                    <li>
                        <a href="{{route('dishes.index')}}"><i class="fa fa-cutlery fa-fw"></i>{{trans('gui.dishes')}}</a>
                    </li>

                    <li>
                        <a href="{{route('users.index')}}"><i class="fa fa-users fa-fw"></i>{{trans('gui.users')}}</a>
                    </li>

                    <li>
                        <a href="{{route('messages.index')}}"><i class="fa fa-envelope fa-fw"></i>{{trans('gui.user_messages')}}</a>
                    </li>

                    <li>
                        <a href="{{route('settings')}}"><i class="fa fa-cog fa-fw"></i>{{trans('gui.settings')}}</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        @if(session('flash_message'))
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        @endif
        @yield('content')

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>

<script src="/assets/mdb/js/tether.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/assets/sbadmin/js/sb-admin-2.js"></script>

<!-- MDB -->
<script src="/assets/mdb/js/mdb.min.js"></script>

<!-- Jasny JS -->
<script src="/assets/jasny/js/jasny-bootstrap.min.js" type="application/javascript"></script>

<script src="/assets/metisMenu/metisMenu.min.js"></script>

<!-- Custom JS -->
<script src="/js/admin_custom.js"></script>
</body>

</html>