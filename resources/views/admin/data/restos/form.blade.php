
<div class="md-form">
    {{Form::text('name', null, ['class' => 'form-control validate', 'id' => 'resto-form-name', 'placeholder' =>trans('gui.model.name')])}}
</div>
<div class="row">
    <div class="col-md-8">
        <div class="md-form">
            {{Form::text('rue', isset($resto) ? $resto->address->rue : null, ['class' => 'form-control validate', 'id' => 'resto-form-rue', 'placeholder' =>trans('gui.street')])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            {{Form::text('numero', isset($resto) ? $resto->address->numero : null, ['class' => 'form-control validate', 'id' => 'resto-form-numero', 'placeholder' =>trans('gui.number')])}}
        </div>
    </div>
    <div class="col-md-8">
        <div class="md-form">
            {{Form::text('commune', isset($resto) ? $resto->address->commune : null, ['class' => 'form-control validate', 'id' => 'resto-form-commune', 'placeholder' =>trans('gui.commune')])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            {{Form::text('zip', isset($resto) ? $resto->address->codepostal : null, ['class' => 'form-control validate', 'id' => 'resto-form-zip', 'placeholder' =>trans('gui.zip')])}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="md-form">
            {{Form::text('tel', null, ['class' => 'form-control validate', 'id' => 'resto-form-tel', 'placeholder' =>trans('gui.tel')])}}
        </div>
        <div class="md-form">
            {{Form::text('website', null, ['class' => 'form-control validate', 'id' => 'resto-form-website', 'placeholder' =>trans('gui.website')])}}
        </div>
        <div class="md-form">
            {{Form::text('facebook', null, ['class' => 'form-control validate', 'id' => 'resto-form-facebook', 'placeholder' =>trans('gui.facebook')])}}
        </div>
    </div>
    <div class="col-md-4" style="text-align: center;">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                {!! Html::image(isset($resto) ? $resto->mainphoto : config('constants.noresto'), 'Choose photo', ['width' => 150, 'height' => 150]) !!}
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="width: auto; max-height: 170px;"></div>
            <div class="text-center">
                <span class="btn btn-sm btn-default btn-file">
                    <span class="fileinput-new">{{trans('gui.choose_photo')}}</span>
                    <span class="fileinput-exists">{{trans('gui.changer')}}</span>
                    {!! Form::file('mainphoto') !!}
                </span>
                <a href="_" class="btn btn-sm btn-default fileinput-exists" data-dismiss="fileinput">{{trans('gui.remove')}}</a>
            </div>
        </div>
    </div>
</div>