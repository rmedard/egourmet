@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <!--Header-->
            <h1 class="page-header text-center">Donnez-nous votre évaluation</h1>
            <div class="well well-lg">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['route' => 'ratings.store', 'method' => 'POST','files' => true, 'id' => 'resto-form-id']) !!}
                <div class="md-form form-group" id="search-dish-group" style="width: 100%">
                    <input type="text" id="search-dish" class="form-control validate" name="searchdish" placeholder="Chercher un plat...">
                    <input type="hidden" id="selected-dish" name="selecteddish">
                </div>

                <div class="md-form form-group" id="search-resto-group" style="width: 100%">
                    <input type="text" id="search-resto" class="form-control validate" name="searchresto" placeholder="Chercher un restaurant...">
                    <input type="hidden" id="selected-resto" name="selectedresto">
                </div>

                <div class="md-form rate-input" style="font-size: 30px">
                    <label style="vertical-align: middle" for="temp-rating">Evaluez</label>
                    <input type="hidden" class="rating" value="0" data-fractions="2" name="rating-value" id="temp-rating"/>
                </div>

                <div class="md-form">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="temp-email" class="form-control" placeholder="Votre email" name="rating-email">
                        </div>
                        <div class="col-md-6">
                            <textarea type="text" class="md-textarea rating-comment-input" name="rating-comment" placeholder="Votre avis"></textarea>
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