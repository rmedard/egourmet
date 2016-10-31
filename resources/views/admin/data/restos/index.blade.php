@extends('admin.layouts.master')

@section('title', trans('gui.restaurants'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('gui.restos_management')}}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn-floating btn-small blue" href="{{route('restos.create')}}"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="row">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <td>#</td>
                    <td><b>{{trans('gui.model.photo')}}</b></td>
                    <td><b>{{trans('gui.model.name')}}</b></td>
                    <td><b>{{trans('gui.address')}}</b></td>
                    <td><b>{{trans('gui.website')}}</b></td>
                    <td><b>{{trans('gui.model.enabled')}}</b></td>
                    <td><b>{{trans('gui.options')}}</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($restos as $resto)
                    <tr>
                        <td>{{(($restos->currentPage() - 1) * $restos->perPage()) + $loop->index + 1}}</td>
                        <?php $photo = empty($resto->mainphoto) ? Config::get('constants.noresto') : $resto->getMainPhoto() ?>
                        <td>
                            {!! Html::image($photo, $resto->name, ['class' => 'media-object', 'width' => 50, 'height' => 'auto']) !!}
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
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="{{trans('gui.edit')}}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="{{trans('gui.delete')}}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $restos->links() }}
        </div>
    </div>
@endsection