@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <h4 class="display-4">Panneau de gestion</h4>
        <div class="card-deck-wrapper">
            <div class="card-deck">
                <div class="card card-inverse card-success text-center">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-home fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-xs-right">
                                <div class="huge">{{$restosCount}}</div>
                                <div>{{trans('gui.restaurants')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('restos.index')}}" class="text-white">
                            <span class="pull-left">Voir les Détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
                <div class="card card-inverse card-info text-center">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cutlery fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-xs-right">
                                <div class="huge">{{$dishesCount}}</div>
                                <div>{{trans('gui.dishes')}}</div>
                            </div>
                        </div>
                    </div><div class="card-footer">
                        <a href="{{route('dishes.index')}}" class="text-white">
                            <span class="pull-left">Voir les Détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
                <div class="card card-inverse card-warning text-center">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-xs-right">
                                <div class="huge">{{$usersCount}}</div>
                                <div>{{trans('gui.users')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('users.index')}}" class="text-white">
                            <span class="pull-left">Voir les Détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
                <div class="card card-inverse card-danger text-center">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-xs-right">
                                <div class="huge">{{$messagesCount}}</div>
                                <div>{{trans('gui.messages')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('messages.index')}}" class="text-white">
                            <span class="pull-left">Voir les Détails</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card card-inverse">
            <h3 class="card-header card-dark">Ratings</h3>
            <div class="card-block">
                <p>{{trans('gui.ratings.year')}}: <b id="year-nbr"></b></p>
                <p>{{trans('gui.ratings.total')}}: <b id="total-ratings"></b></p>
                <canvas id="ratingsChart"></canvas>
            </div>
        </div>
    </div>
@endsection