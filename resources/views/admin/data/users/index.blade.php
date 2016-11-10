@extends('admin.layouts.master')

@section('title', trans('gui.users'))

@section('content')
    <div class="row">
            <h1 class="display-4">{{trans('gui.users_management')}}</h1>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-inverse">
                    <tr>
                        <td>#</td>
                        <td><b>Noms</b></td>
                        <td><b>Email</b></td>
                        <td><b>Date de création</b></td>
                        <td><b>Date de mise à jour</b></td>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection