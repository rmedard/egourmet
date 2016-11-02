@extends('admin.layouts.master')

@section('title', trans('gui.add.resto'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('gui.add.resto')}}</h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-md-8 col-lg-8 col-sm-12 col-sx-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['route' => 'restos.store', 'method' => 'POST','files' => true, 'id' => 'resto-form-id']) !!}
                @include('admin.data.restos.form')
                <fieldset class="form-group">
                    <input type="checkbox" class="filled-in" id="resto-form-enabled" name="enabled" checked>
                    <label for="resto-form-enabled">{{trans('gui.model.enabled')}}</label>
                </fieldset>
                <div>
                    <button class="btn btn-unique btn-rounded" type="submit">{{trans('gui.save')}}</button>
                    <a class="btn btn-danger btn-rounded" href="{{route('restos.index')}}">{{trans('gui.cancel')}}</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection