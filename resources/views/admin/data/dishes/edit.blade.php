@extends('admin.layouts.master')

@section('title', trans('gui.dishes'))

@section('content')
    <div class="row">
        <!-- /.col-lg-12 -->
        <div class="col-md-10 col-lg-10 col-sm-12 col-sx-12">
            <h1 class="display-4">{{trans('gui.edit.dish')}}</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($dish, ['route' => ['dishes.update', $dish->id], 'method' => 'PATCH', 'id' => 'dish-update-form-id']) !!}
            @include('admin.data.dishes.form')
            <button class="btn btn-unique btn-rounded btn-sm" id="save-dish-btn" type="submit">{{trans('gui.save')}}</button>
            <a type="button" href="{{route('dishes.index')}}" class="btn btn-danger btn-rounded btn-sm">{{trans('gui.cancel')}}</a>
            {!! Form::close() !!}
        </div>
    </div>
@endsection