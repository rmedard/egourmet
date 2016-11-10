@extends('admin.layouts.master')

@section('title', trans('gui.messages'))

@section('content')
    <div class="row">
            <h1 class="display-4">{{trans('gui.users_msg_management')}}</h1>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-inverse">
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