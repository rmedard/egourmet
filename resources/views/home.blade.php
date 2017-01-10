@extends('layouts.app')

@section('content')
    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row" id="upper-header">
                <div class="col-lg-12">
                    <div class="intro-message" id="intro-message-main">
                        <div class="description">
                            <h1 class="h1-responsive wow fadeInDown" style="font-size: 80px;">e<i>G</i>ourmet </h1>
                            <hr class="hr-light wow fadeInUp">
                            <p class="wow fadeInUp" data-wow-delay="0.4s">The reference for the best of your meals!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card wow fadeInUp" id="main-search-form">
                <div class="card-block">
                    <!--Body-->
                        {!! Form::open(['route' => 'home.search', 'method' => 'GET', 'id' => 'search-form-main']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form" id="search-dish-group">
                                    <input type="text" id="search-dish" class="form-control validate" name="searchdish" placeholder="Chercher un plat...">
                                    <input type="hidden" id="selected-dish" name="selecteddish">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form" id="search-resto-group">
                                    <input type="text" id="search-resto" class="form-control validate" name="searchresto" placeholder="Chercher un restaurant...">
                                    <input type="hidden" id="selected-resto" name="selectedresto">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-xs-center">
                                <button id="search-btn-main" type="submit" class="btn btn-elegant btn-lg">Chercher</button>
                            </div>
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
                    <section class="section mb-4">
                        <h1 class="section-heading wow fadeIn" data-wow-delay="0.2s">About eGourmet: Special Thanks</h1>
                        <!--Section description-->
                        <p class="section-description mb-5 wow fadeIn" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam. Quia, minima?</p>
                    </section>
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
                    <section class="section mb-4">
                        <h1 class="section-heading wow fadeIn" data-wow-delay="0.2s">eGourmet Meals</h1>
                        <!--Section description-->
                        <p class="section-description mb-5 wow fadeIn" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam. Quia, minima?</p>
                    </section>
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


                            <div class="card">

                                <div class="card-block">
                                    <!--Header-->
                                    <div class="form-header elegant-color-dark">
                                        <h3><i class="fa fa-envelope"></i> Contactez-nous</h3>
                                    </div>

                                    <!--Body-->
                                    @include('layouts.forms.contactform')

                                </div>
                            </div>
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
                    <section class="section mb-4">
                        <h1 class="section-heading wow fadeIn" data-wow-delay="0.2s">Services by eGourmet Blablablabla</h1>
                        <!--Section description-->
                        <p class="section-description mb-5 wow fadeIn" data-wow-delay="0.4s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam. Quia, minima?</p>
                    </section>
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
                    <h2>Connect with <span id="social-block">e<i>G</i>ourmet</span>:</h2>
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
