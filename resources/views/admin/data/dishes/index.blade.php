@extends('admin.layouts.master')

@section('title', trans('gui.dishes'))

@section('content')
    <div class="row">
        <h1 class="display-4">{{trans('gui.dishes_management')}}</h1>
        <div class="col-md-6">
            {!! Form::open(['route' => 'search.dish', 'method' => 'POST']) !!}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="{{trans('gui.search.dish')}}" id="search-dish-admin">
                <input type="hidden" id="selected-dish-admin" name="selecteddish">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Go!</button>
                </span>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <a class="btn-floating btn-small blue" href="{{route('dishes.create')}}" data-toggle="tooltip" data-placement="top" title="{{trans('gui.add.dish')}}"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-inverse">
                <tr>
                    <td>#</td>
                    <td><b>{{trans('gui.model.photo')}}</b></td>
                    <td><b>{{trans('gui.model.name')}}</b></td>
                    <td><b>{{trans('gui.cuisine')}}</b></td>
                    <td><b>{{trans('gui.model.enabled')}}</b></td>
                    <td><b>{{trans('gui.options')}}</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($dishes as $dish)
                    <tr>
                        <td>{{(($dishes->currentPage() - 1) * $dishes->perPage()) + $loop->index + 1}}</td>
                        <td>
                            {!! Html::image($dish->getMainPhoto(), $dish->name, ['class' => 'media-object', 'width' => 50, 'height' => 'auto']) !!}
                        </td>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->cuisine->name}}</td>
                        <td>{{$dish->enabled ? trans('gui.yes') : trans('gui.no')}}</td>
                        <td>
                            <a href="{{route('dishes.edit', ['id' => $dish->id])}}" class="teal-text" data-toggle="tooltip" data-placement="top" title="{{trans('gui.edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="red-text" data-toggle="tooltip" data-placement="top" title="{{trans('gui.delete')}}">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $dishes->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection