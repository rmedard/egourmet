@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-danger">
            <div class="panel-heading"><h1><b>403</b> Oops! </h1></div>
            <div class="panel-body">
                <h3>Vous n'êtes pas autorisés à accéder à cette page.</h3>
                <div>
                    <a href="/" class="btn btn-lg btn-elegant">
                        <i class="fa fa-home" aria-hidden="true"></i> Accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection