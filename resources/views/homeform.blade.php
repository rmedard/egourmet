@extends('layouts.app')
@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<div class="container">
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="card">
                <div class="card-block">
                    <h1 class="card-title text-md-center text-xs-center">{{trans('gui.donnez_evaluation')}}</h1>

                    <p class="text-muted">Merci de prendre quelques minutes pour nous donner une évaluation sur les plats que vous avez mangé dernièrement dans un ou plusieurs restaurants.
                        Cela nous aidera à mieux vous conseiller sur vos choix de plats et restaurants dans le futur.</p>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif(session('flash_message'))
                        <div class="alert alert-success">
                            {{ session('flash_message') }}
                        </div>
                    @endif

                    {!! Form::open(['route' => 'ratings.store', 'method' => 'POST','files' => true, 'id' => 'resto-form-id']) !!}
                    <div class="md-form form-group" id="search-dish-group" style="width: 100%">
                        <input type="text" id="search-dish" class="form-control validate" name="searchdish" placeholder="Chercher un plat..." value="{{old('searchdish')}}">
                        <input type="hidden" id="selected-dish" name="selecteddish" value="{{old('selecteddish')}}">
                    </div>
                    <div style="text-align: right;"><a href="#" onclick="openDishModal();">Vous ne trouvez pas le plat?</a></div>
                    <div class="md-form form-group" id="search-resto-group" style="width: 100%">
                        <input type="text" id="search-resto" class="form-control validate" name="searchresto" placeholder="Chercher un restaurant..." value="{{old('searchresto')}}">
                        <input type="hidden" id="selected-resto" name="selectedresto" value="{{old('selectedresto')}}">
                    </div>
                    <div style="text-align: right;"><a href="#" onclick="openRestoModal();">Vous ne trouvez pas le restaurant?</a></div>
                    <div class="md-form rate-input" style="font-size: 30px">
                        <label style="vertical-align: middle" for="temp-rating">Evaluez</label>
                        <input type="hidden" class="rating" data-fractions="2" name="ratingvalue" id="temp-rating" value="{{old('ratingvalue')}}"/>
                    </div>

                    <div class="md-form">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="temp-email" class="form-control validate" placeholder="{{trans('gui.your_email')}}" name="ratingemail" value="{{old('ratingemail')}}">
                            </div>
                            <div class="col-md-12">
                                <textarea type="text" class="md-textarea rating-comment-input validate" name="ratingcomment" placeholder="{{trans('gui.your_comment')}}">{{old('ratingcomment')}}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="text-md-center text-xs-center">
                        <button class="btn btn-unique" type="submit">{{trans('gui.send')}}</button>
                    </div>
                    {!! Form::close() !!}

                    <div class="card-data grey">
                        <div class="fb-share-button" data-href="http://www.egourmet.be" data-layout="button_count" data-size="large" data-mobile-iframe="true">
                            <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.egourmet.be%2F&amp;src=sdkpreparse">Share</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="resto-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{trans('gui.create_resto')}}</h4>
                </div>
                {!! Form::open(['route' => 'any.restos.store', 'method' => 'POST', 'id' => 'resto-form-modal-id', 'files' => TRUE, 'multipart' => TRUE]) !!}
                    <div class="modal-body">
                        @include('admin.data.restos.form')
                        <fieldset class="form-group" hidden>
                            <input type="checkbox" class="filled-in" id="resto-form-enabled" name="enabled" checked>
                            <label for="resto-form-enabled">{{trans('gui.model.enabled')}}</label>
                        </fieldset>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-unique btn-rounded btn-sm" id="save-resto-btn">{{trans('gui.save')}}</button>
                        <button type="button" class="btn btn-danger btn-rounded btn-sm" data-dismiss="modal">{{trans('gui.cancel')}}</button>
                    </div>
                {!! Form::close() !!}

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="dish-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{trans('gui.create_dish')}}</h4>
                </div>
                    {!! Form::open(['route' => 'any.dishes.store', 'method' => 'POST', 'id' => 'dish-form-modal-id']) !!}
                <div class="modal-body">
                    <div class="md-form">
                        {{Form::text('name', null, ['class' => 'form-control validate', 'id' => 'dish-name-id', 'placeholder' => trans('gui.model.name')])}}
                    </div>
                    <div class="md-form">
                        {{Form::select('cuisine', $cuisines_list, isset($dish) ? $dish->cuisine->id : null, ['class' => 'mdb-select colorful-select dropdown-dark', 'id' => 'modal-dish-cuisine-id', 'placeholder' => trans('gui.select.cuisine')])}}
                    </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-unique btn-rounded btn-sm" id="save-dish-btn" type="submit">{{trans('gui.save')}}</button>
                        <button type="button" class="btn btn-danger btn-rounded btn-sm" data-dismiss="modal">{{trans('gui.cancel')}}</button>
                </div>
                    {!! Form::close() !!}

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="application/javascript">
        function openRestoModal() {
            $('.resto-modal-msg').val('');
            $('#resto-modal').modal('show');
        }
        function openDishModal() {
            $('.dish-modal-msg').val('');
            $('#dish-modal').modal('show');
        }
        if($('#temp-rating').val() == ''){
            $('#temp-rating').val(3);
        }
    </script>
</div>
@endsection