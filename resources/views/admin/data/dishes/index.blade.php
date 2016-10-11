@extends('admin.layouts.master')

@section('title', trans('gui.dishes'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('gui.dishes_management')}}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <td>#</td>
                    <td><b>{{trans('gui.model.photo')}}</b></td>
                    <td><b>{{trans('gui.model.name')}}</b></td>
                    <td><b>{{trans('gui.cuisine')}}</b></td>
                    <td><b>{{trans('gui.model.created_at')}}</b></td>
                    <td><b>{{trans('gui.model.updated_at')}}</b></td>
                    <td><b>{{trans('gui.model.enabled')}}</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($dishes as $dish)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <?php $photo = empty($dish->mainphoto) ? Config::get('constants.nodish') : $dish->mainphoto ?>
                        <td>
                            {!! Html::image($photo, $dish->name, ['class' => 'media-object', 'width' => 50, 'height' => 'auto']) !!}
                        </td>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->cuisine->name}}</td>
                        <td>{{$dish->created_at}}</td>
                        <td>{{$dish->updated_at}}</td>
                        <td>{{$dish->enabled ? trans('gui.yes') : trans('gui.no')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection