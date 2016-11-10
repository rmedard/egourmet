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
    <link href="/assets/mdb/css/bootstrap.min.css" rel="stylesheet">

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
    <script src="/assets/mdb/js/jquery-3.1.1.min.js"></script>
    <script src="/assets/jquery-ui/jquery-ui-1.12.1.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="fixed-sn dark-skin">
    <header>
    <!-- Navigation -->
        <div>
            <!-- SideNav slide-out button -->
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            <!--/. SideNav slide-out button -->

            <!-- Sidebar navigation -->
            <ul id="slide-out" class="side-nav fixed default-side-nav light-side-nav">

                <!-- Logo -->
                <div class="logo-wrapper">
                    <a href="/admin"><img src="/images/core/egourmet_logo.png" class="img-fluid flex-center"></a>
                </div>
                <!--/. Logo -->

                <!-- Side navigation links -->
                <ul class="collapsible">

                    <li class="active">
                        <a href="{{route('admin')}}" class="waves-effect text-white"><i class="fa fa-dashboard fa-fw"></i>{{trans('gui.dashboard')}}</a>
                    </li>

                    <li>
                        <a href="{{route('restos.index')}}" class="waves-effect text-white"><i class="fa fa-home fa-fw"></i>{{trans('gui.restaurants')}}</a>
                    </li>

                    <li>
                        <a href="{{route('dishes.index')}}" class="waves-effect text-white"><i class="fa fa-cutlery fa-fw"></i>{{trans('gui.dishes')}}</a>
                    </li>

                    <li>
                        <a href="{{route('ratings.overview')}}" class="waves-effect text-white"><i class="fa fa-star-half-o fa-fw"></i>{{trans('gui.ratings')}}</a>
                    </li>

                    <li>
                        <a href="{{route('users.index')}}" class="waves-effect text-white"><i class="fa fa-users fa-fw"></i>{{trans('gui.users')}}</a>
                    </li>

                    <li>
                        <a href="{{route('messages.index')}}" class="waves-effect text-white"><i class="fa fa-envelope fa-fw"></i>{{trans('gui.user_messages')}}</a>
                    </li>

                    <li>
                        <a href="{{route('settings')}}" class="waves-effect text-white"><i class="fa fa-cog fa-fw"></i>{{trans('gui.settings')}}</a>
                    </li>
                </ul>
                <!--/. Side navigation links -->
            </ul>
            <!--/. Sidebar navigation -->

        </div>
        <!-- /.navbar-static-side -->

        <nav class="navbar navbar-fixed-top scrolling-navbar double-nav">

            <!-- SideNav slide-out button -->
            <div class="float-xs-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>

            <!-- Breadcrumb-->
            <div class="breadcrumb-dn">
                <p>eGourmet Dashboard</p>
            </div>

            <ul class="nav navbar-nav float-xs-right">
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-envelope"></i> <span class="hidden-sm-down">Contact</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link"><i class="fa fa-comments-o"></i> <span class="hidden-sm-down">Support</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdown-user-menu" class="nav-link dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"> Profile</i>
                    </a>
                    <div class="dropdown-menu dropdown-primary dd-right" aria-labelledby="dropdown-user-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <a class="dropdown-item" href="#">User profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
    </header>
    <main>
        @if(session('flash_message'))
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
        @endif
        @yield('content')
    </main>
    <!-- /#page-wrapper -->
<!-- /#wrapper -->

<script src="/assets/mdb/js/tether.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/assets/mdb/js/bootstrap.min.js"></script>

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