@extends('admin.layouts.master')

@section('title', trans('gui.edit.resto'))

@section('content')
    <div class="row">
        <!-- /.col-lg-12 -->
        <div class="col-md-10 col-lg-10 col-sm-12 col-sx-12">
            <h1 class="display-4">{{trans('gui.edit.resto')}}</h1>
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
            {!! Form::model($resto, ['route' => ['restos.update', $resto['id']],'files' => true, 'method' => 'PATCH']) !!}
                @include('admin.data.restos.form')
                <fieldset class="form-group">
                    <input type="checkbox" class="filled-in" id="resto-form-enabled" name="enabled" checked>
                    <label for="resto-form-enabled">{{trans('gui.model.enabled')}}</label>
                </fieldset>
                <div>
                    <button class="btn btn-unique btn-rounded btn-sm" type="submit">{{trans('gui.save')}}</button>
                    <a class="btn btn-danger btn-rounded btn-sm" href="{{url('admin/restos?page=' . session('pagenumber'))}}">{{trans('gui.cancel')}}</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection