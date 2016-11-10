@extends('admin.layouts.master')

@section('title', trans('gui.dishes'))

@section('content')
    <div class="row">
            <h1 class="display-4">{{trans('gui.dishes_management')}}</h1>
        <!-- /.col-lg-12 -->
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
                        <?php $photo = empty($dish->mainphoto) ? Config::get('constants.nodish') : $dish->mainphoto ?>
                        <td>
                            {!! Html::image($photo, $dish->name, ['class' => 'media-object', 'width' => 50, 'height' => 'auto']) !!}
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