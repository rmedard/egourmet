@extends('admin.layouts.master')

@section('title', trans('gui.restaurants'))

@section('content')
    <div class="row">
        <h1 class="display-4">{{trans('gui.restos_management')}}</h1>
        <div class="col-md-6">
            {!! Form::open(['route' => 'search.resto', 'method' => 'POST']) !!}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="{{trans('gui.search.resto')}}" id="search-resto-admin">
                <input type="hidden" id="selected-resto-admin" name="selectedresto">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Go!</button>
                </span>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <a class="btn-floating btn-small blue" href="{{route('restos.create')}}" data-toggle="tooltip" data-placement="top" title="{{trans('gui.add.resto')}}"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-inverse">
                    <tr>
                        <th>#</th>
                        <th>{{trans('gui.model.photo')}}</th>
                        <th>{{trans('gui.name.resto')}}</th>
                        <th>{{trans('gui.address')}}</th>
                        <th>{{trans('gui.website')}}</th>
                        <th>{{trans('gui.model.enabled')}}</th>
                        <th>{{trans('gui.options')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($restos as $resto)
                    <tr>
                        <td>{{(($restos->currentPage() - 1) * $restos->perPage()) + $loop->index + 1}}</td>
                        <td>
                            {!! Html::image($resto->getMainPhotoURL(), $resto->name, ['class' => 'media-object', 'width' => 50, 'height' => 'auto']) !!}
                        </td>
                        <td>{{$resto->name}}</td>
                        <td>
                            <address class="resto-address">
                                {{$resto->address->rue}} {{$resto->address->numero}}<br>
                                {{$resto->address->codepostal}} {{$resto->address->commune}} <br>
                            </address>
                        </td>
                        <td>{{$resto->website}}</td>
                        <td>{{$resto->enabled ? trans('gui.yes') : trans('gui.no')}}</td>
                        <td>
                            <?php session(['pagenumber' => $restos->currentPage()]) ?>
                            <a href="{{route('restos.edit', ['id' => $resto->id])}}" class="teal-text" data-toggle="tooltip" data-placement="top" title="{{trans('gui.edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="{{empty($resto->slug) ? 'orange-text' : 'red-text'}}" data-toggle="tooltip" data-placement="top" title="{{trans('gui.delete')}}">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                {{ $restos->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection