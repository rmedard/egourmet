@if(!is_null($dishes) and !empty($dishes))
        @foreach($dishes as $dish)
            @foreach($dish->restos as $resto)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="ih-item square effect6 from_top_and_bottom">
                            <a href="http://{{$resto->website}}">
                                <div class="img">
                                    {!! Html::image($resto->getMainPhotoURL(), $resto->name, ['class' => 'img-rounded', 'id' => 'resto-' . $resto->id . '-img']) !!}
                                </div>
                                <div class="info">
                                    <h3>{{$resto->name}}</h3>
                                    <p>{{$resto->website}}</p>
                                </div>
                            </a>
                        </div>

                        <div class="caption">
                            <h3 class="text-center dish-title">{{$dish->name}}</h3>
                            <div class="text-center">
                                <small id="cuisine-1">Cuisine {{$dish->cuisine->name}}</small>
                            </div>
                            <div class="dish-overall-rate text-center">
                                <span class="label label-danger" id="rate-{{$resto->pivot->id}}">Moyenne: <i class="value">{{$resto->pivot->average_rate}}</i> / 5</span>
                                <span class="label label-success" id="reviews-{{$resto->pivot->id}}">Votes: <i class="value">{{$resto->pivot->reviews_count}}</i></span>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <address class="resto-address">
                                        <strong>{{$resto->name}}</strong><br>
                                        {{$resto->address->rue}} {{$resto->address->numero}}<br>
                                        {{$resto->address->codepostal}} {{$resto->address->commune}} <br>
                                        <abbr title="Phone"><i class="fa fa-phone" aria-hidden="true"></i>{{$resto->tel}}</abbr>
                                    </address>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <a href="http://www.igihe.com" target="_blank"><i class="fa fa-location-arrow fa-5x" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="rate-panel col-md-12 col-sm-12 col-xs-12" id="rate-email-{{$resto->pivot->id}}">
                                    {!! Form::open(['route' => 'home.persist', 'method' => 'POST', 'class' => 'rating-form']) !!}
                                    <input type="hidden" value="rating" name="persist_type">
                                    <input type="hidden" value="{{$resto->pivot->id}}" name="dish_resto_id">
                                    <input type="hidden" value="{{$resto->id}}" name="resto_id">
                                    <input type="hidden" value="{{$dish->id}}" name="dish_id">
                                    <hr>
                                    <div class="rate-input" id="rate-input-{{$resto->pivot->id}}">
                                        <label style="vertical-align: middle">Votez</label>
                                        <input type="hidden" class="rating" value="{{$resto->pivot->average_rate}}" data-fractions="2" name="rating-value"/>
                                        <div class="rate-email" id="rate-email-{{$resto->pivot->id}}">
                                            <textarea type="text" class="md-textarea rating-comment-input" name="rating-comment" placeholder="Votre avis"></textarea>
                                            <input type="email" placeholder="Votre email" class="form-control rating-email-input input-sm" name="rating-email" id="rator-email-{{$resto->pivot->id}}">
                                            <button class="btn btn-primary email-input-btn" type="submit">Votez</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endforeach
@endif