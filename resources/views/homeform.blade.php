@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <!--Header-->
            <h1 class="page-header text-center">{{trans('gui.donnez_evaluation')}}</h1>
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
                <div style="text-align: right"><a href="#" onclick="openDishModal();">Vous ne trouvez pas le plat?</a></div>
                <div class="md-form form-group" id="search-resto-group" style="width: 100%">
                    <input type="text" id="search-resto" class="form-control validate" name="searchresto" placeholder="Chercher un restaurant..." value="{{old('searchresto')}}">
                    <input type="hidden" id="selected-resto" name="selectedresto">
                </div>
                <div style="text-align: right"><a href="#" onclick="openRestoModal();">Vous ne trouvez pas le restaurant?</a></div>
                <div class="md-form rate-input" style="font-size: 30px">
                    <label style="vertical-align: middle" for="temp-rating">Evaluez</label>
                    <input type="hidden" class="rating" value="{{old('rating-value')}}" data-fractions="2" name="ratingvalue" id="temp-rating"/>
                </div>

                <div class="md-form">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="temp-email" class="form-control validate" placeholder="Votre email" name="ratingemail" value="{{old('ratingemail')}}">
                        </div>
                        <div class="col-md-6">
                            <textarea type="text" class="md-textarea rating-comment-input validate" name="ratingcomment" placeholder="Votre avis">{{old('ratingcomment')}}</textarea>
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
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-unique btn-rounded" id="save-resto-btn">{{trans('gui.save')}}</button>
                        <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">{{trans('gui.cancel')}}</button>
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
                        <label for="dish-name-id">{{trans('gui.model.name')}}</label>
                        {{Form::text('name', null, ['class' => 'form-control validate', 'id' => 'dish-name-id'])}}
                    </div>
                    <div class="md-form">
                        {{Form::text('cuisine', null, ['class' => 'form-control validate', 'id' => 'dish-cuisine-id'])}}
                        <label for="dish-cuisine-id">{{trans('gui.cuisine')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-unique btn-rounded" id="save-dish-btn" type="submit">{{trans('gui.save')}}</button>
                        <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">{{trans('gui.cancel')}}</button>
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
    </script>
</div>
@endsection