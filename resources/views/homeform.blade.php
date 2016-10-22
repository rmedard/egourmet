@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <!--Header-->
            <h1 class="page-header text-center">Donnez-nous votre évaluation</h1>
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
            <div class="well well-lg">
                {!! Form::open(['route' => 'ratings.store', 'method' => 'POST','files' => true, 'id' => 'resto-form-id']) !!}
                <div class="md-form form-group" id="search-dish-group" style="width: 100%">
                    <input type="text" id="search-dish" class="form-control validate" name="searchdish" placeholder="Chercher un plat..." value="{{old('searchdish')}}">
                    <input type="hidden" id="selected-dish" name="selecteddish">
                </div>
                <div style="text-align: right"><a href="#">Vous ne trouvez pas le restaurant?</a></div>
                <div class="md-form form-group" id="search-resto-group" style="width: 100%">
                    <input type="text" id="search-resto" class="form-control validate" name="searchresto" placeholder="Chercher un restaurant..." value="{{old('searchresto')}}">
                    <input type="hidden" id="selected-resto" name="selectedresto">
                </div>
                <div style="text-align: right"><a href="#">Vous ne trouvez pas le plat?</a></div>
                <div class="md-form rate-input" style="font-size: 30px">
                    <label style="vertical-align: middle" for="temp-rating">Evaluez</label>
                    <input type="hidden" class="rating" value="{{old('rating-value')}}" data-fractions="2" name="ratingvalue" id="temp-rating"/>
                </div>

                <div class="md-form">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="temp-email" class="form-control validate" placeholder="Votre email" name="ratingemail" value="{{old('rating-email')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea type="text" class="md-textarea rating-comment-input validate" name="ratingcomment" placeholder="Votre avis">{{old('rating-comment')}}</textarea>
                        </div>
                    </div>

                </div>

                <div class="text-xs-center">
                    <button class="btn btn-indigo" type="submit">Sauvegarder</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection