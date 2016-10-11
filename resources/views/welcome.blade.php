@extends('layouts.app')

@include('layouts.partials.searchBar')

@section('content')
    <div class="container">
    <div class="row">
        <!--Sidebar-->
        <div class="pull-left col-md-3" id="right-sidebar">

            <div class="row create-resto">
                <div>
                    {!! Form::open(['route' => 'dishresto.store', 'method' => 'POST', 'class' => 'dishresto-form', 'id' => 'dishresto-form-id']) !!}
                    <input type="hidden" value="dishresto" name="persist_type">
                    {{Form::select('resto', $restos_list, null, ['class' => 'form-control', 'name' => 'resto'])}}
                        {{Form::select('dish', $dishes_list, null, ['class' => 'form-control', 'name' => 'dish'])}}
                    {{Form::submit('Envoyez', ['class' => 'btn btn-success btn-block'])}}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

        <!--Main content-->
        <div class="pull-right col-md-9">
            <div class="list-group dishes-list">
                @foreach($dishes as $dish)
                    @foreach($dish->restos as $resto)
                        @if($resto->pivot->enabled)
                            <div class="list-group-item">
                                <div class="media dish-teaser">
                                    <div class="media-left">
                                        <img src="{{$dish->mainphoto}}" alt="riz" class="img-rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4 class="media-heading"> {{$dish->name}}</h4>
                                                <div>
                                                    <label for="cuisine-1">Cuisine</label>
                                                    <small id="cuisine-1">{{$dish->cuisine->name}}</small>
                                                </div>
                                                <div class="rate-input" id="rate-email-{{$resto->pivot->id}}">
                                                    {!! Form::open(['route' => 'home.persist', 'method' => 'POST', 'class' => 'rating-form']) !!}
                                                        <input type="hidden" value="rating" name="persist_type">
                                                        <input type="hidden" value="{{$resto->pivot->id}}" name="dish_resto_id">
                                                        <input type="hidden" value="{{$resto->id}}" name="resto_id">
                                                        <input type="hidden" value="{{$dish->id}}" name="dish_id">
                                                        <div class="rate-input">
                                                            <input type="hidden" class="rating" value="{{$resto->pivot->average_rate}}" data-fractions="2" name="rating_value"/>
                                                            <div class="rate-email">
                                                                <input type="email" placeholder="Votre email" class="form-control email-input input-sm" name="email" id="rator-email-{{$resto->pivot->id}}">
                                                                <button class="btn btn-default btn-xs email-input-btn" type="submit">Votez</button>
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <address class="resto-address">
                                                    <strong>{{$resto->name}}</strong><br>
                                                    {{$resto->address->rue}} {{$resto->address->numero}}<br>
                                                    {{$resto->address->codepostal}} {{$resto->address->commune}} <br>
                                                    <abbr title="Phone">{{$resto->tel}}</abbr>
                                                </address>
                                                <div class="btn btn-primary btn-xs map-show-btn" id="map-show-{{$resto->id}}-{{$dish->id}}">Map</div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="dish-overall-rate">
                                                    <span class="label label-danger" id="rate-{{$resto->pivot->id}}">Moyenne: <i class="value">{{$resto->pivot->average_rate}}</i> / 5</span>
                                                </div>
                                                <div class="dish-reviews-count">
                                                    <span class="label label-success" id="reviews-{{$resto->pivot->id}}">Votes: <i class="value">{{$resto->pivot->reviews_count}}</i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px;">
                                            <div class="resto-main-details" id="resto-{{$resto->id}}-{{$dish->id}}-map">
                                                <div class="media">
                                                    <div class="media-right">
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2518.288978809923!2d4.3579644159344415!3d50.86284966544401!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c39de55bb347%3A0xca111b646c2c34f0!2sRue+Gaucheret+30%2C+1030+Schaerbeek!5e0!3m2!1sfr!2sbe!4v1469657156047"
                                                                width="100%" height="100" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        @endif
                    @endforeach
                @endforeach

            </div>

        </div>
    </div>

</div>
@endsection
