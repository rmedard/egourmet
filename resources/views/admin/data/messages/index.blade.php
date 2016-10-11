@extends('admin.layouts.master')

@section('title', trans('gui.messages'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('gui.users_msg_management')}}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <td>#</td>
                    <td><b>Sender name</b></td>
                    <td><b>Sender email</b></td>
                    <td><b>Message</b></td>
                    <td><b>Date d'envoi</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->message}}</td>
                        <td>{{$message->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection