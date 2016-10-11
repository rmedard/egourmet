@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2"></div>
        <div class="col-md-8">
            <!--Form with header-->
            <div class="card">
                <div class="card-block">

                    <!--Header-->
                    <div class="form-header blue-gradient">
                        <h3><i class="fa fa-user"></i> Donnez-nous votre évaluation</h3>
                    </div>

                    <!--Body-->
                    <div class="md-form">
                        <input type="text" id="form3" class="form-control">
                        <label for="form3">Your name</label>
                    </div>
                    <div class="md-form">
                        <input type="text" id="form2" class="form-control">
                        <label for="form2">Your email</label>
                    </div>

                    <div class="md-form">
                        <input type="password" id="form4" class="form-control">
                        <label for="form4">Your password</label>
                    </div>

                    <div class="text-xs-center">
                        <button class="btn btn-indigo">Sauvegarder</button>
                    </div>

                </div>
            </div>
            {!! Form::open() !!}
            <!--/Form with header-->
        </div>
    </div>
</div>
@endsection