<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>eGourmet</title>

        <!-- Bootstrap -->
        <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Materialize -->
        <link href="/assets/mdb/css/mdb.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="/assets/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">

        <!-- iHover -->
        <link href="/assets/ihover/ihover.min.css" rel="stylesheet">

        <!-- jquery UI -->
        <link href="/assets/jquery-ui/jquery-ui.min.css" rel="stylesheet">

        <!-- Jasny -->
        <link href="/assets/jasny/css/jasny-bootstrap.min.css" rel="stylesheet">

        <!-- Custom -->
        <link href="css/app.css" rel="stylesheet" type="text/css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
        <script src="/assets/jquery/jquery-1.12.4.min.js"></script>
        <script src="/assets/jquery-ui/jquery-ui-1.12.1.min.js"></script>

    </head>

    <body>

        @include('layouts.partials.navbar')

        @yield('content')
        @include('layouts.partials.footer')
    </body>
</html>