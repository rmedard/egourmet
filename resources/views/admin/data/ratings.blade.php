@extends('admin.layouts.master')

@section('title', trans('gui.ratings'))

@section('content')
    <div class="row">
            <h1 class="display-4">{{trans('gui.ratings_management')}}</h1>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-inverse">
                    <tr>
                        <td></td>
                        <td><b>{{trans('gui.restaurants')}}</b></td>
                        <td class="text-md-center"><b>{{trans('gui.reviews_count')}}</b> <span class="tag red">{{$ratingsTotalCount}}</span></td>
                        <td class="text-md-center"><b>{{trans('gui.reviews_avg')}}</b></td>
                    </tr>
                </thead>
                <tbody>
                @foreach($restos as $resto)
                    <tr class="table-success table-inverse">
                        <td class="grey">{{(($restos->currentPage() - 1) * $restos->perPage()) + $loop->index + 1}}</td>
                        <td class="grey darken-1"><b>{{$resto->name}}</b>
                            <small> - {{$resto->address->display()}}</small>
                        </td>
                        <td class="text-md-center grey darken-2">
                            <span>{{$resto->getOverallVotesCount()}}</span>
                        </td>
                        <td class="text-md-center grey darken-3">
                            {{$resto->getOverallAverageRate()}}
                        </td>
                    </tr>
                    @foreach($resto->dishes as $dish)
                    <tr>
                        <td></td>
                        <td style="text-indent: 5em;">{{$loop->index + 1}}. {{$dish->name}}</td>
                        <td class="text-md-center">{{$dish->pivot->reviews_count}}</td>
                        <td class="text-md-center">{{$dish->pivot->average_rate}}/5</td>
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            {{ $restos->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection