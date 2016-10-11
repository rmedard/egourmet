@extends('layouts.app')

@section('content')
    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row" id="upper-header">
                <div class="col-lg-12">
                    <div class="intro-message" id="intro-message-main">
                        <h1>e<i>G</i>ourmet</h1>
                        <h3>Your reference for the best of your meals</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Facebook</span></a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Twitter</span></a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Instagram</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="well well-lg">
                <div class="row">
                    {!! Form::open(['route' => 'home.search', 'method' => 'GET', 'id' => 'search-form-main', 'class' => 'form-inline']) !!}

                        <div class="md-form form-group" id="search-dish-group">
                            <input type="text" id="search-dish" class="form-control validate" name="searchdish">
                            <input type="hidden" id="selected-dish" name="selecteddish">
                            <label for="search-dish">Chercher un plat...</label>
                        </div>

                        <div class="md-form form-group" id="search-resto-group">
                            <input type="text" id="search-resto" class="form-control validate" name="searchresto">
                            <input type="hidden" id="selected-resto" name="selectedresto">
                            <label for="search-resto">Chercher un restaurant...</label>
                        </div>

                        <div>
                            <button id="search-btn-main" type="submit" class="btn btn-elegant btn-lg">Chercher</button>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

    <!--Dishes List-->
    <div id="dishes-list-main" class="container">
        @include('layouts.dishesList')
    </div>

    <a id="about"></a>
    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">About eGourmet:<br>Special Thanks</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad autem dolorem doloremque eius nam non praesentium sint totam. Alias autem ducimus et facere hic illo ipsum quibusdam quidem quo quos.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="" alt="">
                </div>
            </div>


        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <a id="contact"></a>
    <div class="content-section-b">

        <div class="container">
                <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">eGourmet Meals<br>in Brussels</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consectetur corporis culpa cupiditate dolorum, enim fuga ipsam libero, odit omnis repellat reprehenderit rerum unde. Dignissimos distinctio in nulla vel voluptatum?</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">

                    <div class="card-block" id="contact-form-block">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="text-xs-center">
                            <h3><i class="fa fa-envelope"></i> Contactez-nous</h3>
                            <hr class="m-t-2 m-b-2">
                        </div>

                        {!! Form::model($message, ['route' => 'messages.store', 'method' => 'POST', 'id' => 'message-form-id']) !!}

                            <div class="md-form">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="contact-name" class="form-control" name="name">
                                <label for="contact-name">Votre nom</label>
                            </div>

                            <div class="md-form">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="text" id="contact-email" class="form-control" name="email">
                                <label for="contact-email">Votre email</label>
                            </div>

                            <div class="md-form has-error">
                                <i class="fa fa-tag prefix"></i>
                                <textarea type="text" id="contact-message" class="md-textarea" name="message"></textarea>
                                <label for="contact-message">Votre message</label>
                            </div>

                            <div class="text-xs-center">
                                <button class="btn btn-default" type="submit">Envoyer</button>

                                <div class="call">
                                    <br>
                                    <p>Ou préférez-vous nous appeller?
                                        <br>
                                        <span><i class="fa fa-phone"> </i></span> <b> + 04 234 565 280 </b> </p>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Services by eGourmet<br>Blablablabla</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam architecto aut consectetur deserunt.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Connect to <span id="social-block">e<i>G</i>ourmet</span>:</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

@endsection
