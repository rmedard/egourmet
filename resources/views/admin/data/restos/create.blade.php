@extends('admin.layouts.master')

@section('title', trans('gui.add.resto'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('gui.add.resto')}}</h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-md-6 col-lg-6 col-sm-12 col-sx-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['route' => 'restos.store', 'files' => true, 'id' => 'resto-form-id']) !!}
                @include('admin.data.restos.form')
            {!! Form::close() !!}
        </div>
    </div>
    <script src="/assets/jquery/jquery-2.2.4.min.js" type="application/javascript"></script>
    <script src="/assets/gmaps/gmaps.min.js" type="application/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRgjjnfpVbukBemb79MpTNhHn1usipbNI"></script>
@endsection