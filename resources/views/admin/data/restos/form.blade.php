
<div class="md-form">
    {{Form::text('name', null, ['class' => 'form-control validate', 'id' => 'resto-form-name'])}}
    <label for="resto-form-name" class="">{{trans('gui.model.name')}}</label>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="md-form">
            {{Form::text('rue', null, ['class' => 'form-control validate', 'id' => 'resto-form-rue'])}}
            <label for="resto-form-rue" class="">{{trans('gui.street')}}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            {{Form::text('numero', null, ['class' => 'form-control validate', 'id' => 'resto-form-numero'])}}
            <label for="resto-form-numero" class="">{{trans('gui.number')}}</label>
        </div>
    </div>
    <div class="col-md-8">
        <div class="md-form">
            {{Form::text('commune', null, ['class' => 'form-control validate', 'id' => 'resto-form-commune'])}}
            <label for="resto-form-commune" class="">{{trans('gui.commune')}}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            {{Form::text('zip', null, ['class' => 'form-control validate', 'id' => 'resto-form-zip'])}}
            <label for="resto-form-zip" class="">{{trans('gui.zip')}}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="md-form">
            {{Form::text('tel', null, ['class' => 'form-control validate', 'id' => 'resto-form-tel'])}}
            <label for="resto-form-tel" class="">{{trans('gui.tel')}}</label>
        </div>
        <div class="md-form">
            {{Form::text('website', null, ['class' => 'form-control validate', 'id' => 'resto-form-website'])}}
            <label for="resto-form-website" class="">{{trans('gui.website')}}</label>
        </div>
        <div class="md-form">
            {{Form::text('facebook', null, ['class' => 'form-control validate', 'id' => 'resto-form-facebook'])}}
            <label for="resto-form-facebook" class="">{{trans('gui.facebook')}}</label>
        </div>
    </div>
    <div class="col-md-4" style="text-align: center;">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                <?php $photo = empty($resto->mainphoto) ? 'noresto.png' : $resto->mainphoto ?>
                {!! Html::image('uploads/images/restos/' . $photo, 'Choose photo', ['width' => 150, 'height' => 150]) !!}
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