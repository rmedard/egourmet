
<div class="md-form">
    <input type="text" id="resto-form-name" class="form-control validate" name="name">
    <label for="resto-form-name" class="">{{trans('gui.model.name')}}</label>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="md-form">
            <input type="text" id="resto-form-rue" class="form-control validate" name="rue">
            <label for="resto-form-rue" class="">{{trans('gui.street')}}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            <input type="text" id="resto-form-numero" class="form-control validate" name="numero">
            <label for="resto-form-numero" class="">{{trans('gui.number')}}</label>
        </div>
    </div>
    <div class="col-md-8">
        <div class="md-form">
            <input type="text" id="resto-form-commune" class="form-control validate" name="commune">
            <label for="resto-form-commune" class="">{{trans('gui.commune')}}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            <input type="text" id="resto-form-zip" class="form-control validate" name="zip">
            <label for="resto-form-zip" class="">{{trans('gui.zip')}}</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="md-form">
            <input type="text" id="resto-form-tel" class="form-control validate" name="tel">
            <label for="resto-form-tel" class="">{{trans('gui.tel')}}</label>
        </div>
        <div class="md-form">
            <input type="text" id="resto-form-website" class="form-control validate" name="website">
            <label for="resto-form-website" class="">{{trans('gui.website')}}</label>
        </div>
        <div class="md-form">
            <input type="text" id="resto-form-facebook" class="form-control validate" name="facebook">
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