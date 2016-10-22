
<div class="md-form">
    <input type="text" id="resto-form-name" class="form-control" name="name" required="true">
    <label for="resto-form-name" class="">{{trans('gui.model.name')}}</label>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="md-form">
            <input type="text" id="resto-form-rue" class="form-control" name="rue">
            <label for="resto-form-rue" class="">{{trans('gui.street')}}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            <input type="text" id="resto-form-numero" class="form-control" name="numero">
            <label for="resto-form-numero" class="">{{trans('gui.number')}}</label>
        </div>
    </div>
    <div class="col-md-8">
        <div class="md-form">
            <input type="text" id="resto-form-commune" class="form-control" name="commune">
            <label for="resto-form-commune" class="">{{trans('gui.commune')}}</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="md-form">
            <input type="text" id="resto-form-zip" class="form-control" name="zip">
            <label for="resto-form-zip" class="">{{trans('gui.zip')}}</label>
        </div>
    </div>
    <input type="hidden" name="latitude" id="resto-form-latitude">
    <input type="hidden" name="longitude" id="resto-form-longitude">
</div>
<div class="md-form">
    <input type="text" id="resto-form-tel" class="form-control" name="tel">
    <label for="resto-form-tel" class="">{{trans('gui.tel')}}</label>
</div>
<div class="md-form">
    <input type="text" id="resto-form-website" class="form-control" name="website">
    <label for="resto-form-website" class="">{{trans('gui.website')}}</label>
</div>
<div class="md-form">
    <input type="text" id="resto-form-facebook" class="form-control" name="facebook">
    <label for="resto-form-facebook" class="">{{trans('gui.facebook')}}</label>
</div>
<div class="md-form" style="display: none">
    <div class="file-field">
        <div class="btn btn-unique">
            <span>{{trans('gui.choose_photo')}}</span>
            <input type="file" name="mainphoto">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>
</div>
<div class="md-form">
    <input type="file" name="input-mainphoto" accept="image/*" id="resto-form-photo" >
</div>
<fieldset class="form-group">
    <input type="checkbox" class="filled-in" id="resto-form-enabled">
    <label for="resto-form-enabled">{{trans('gui.model.enabled')}}</label>
</fieldset>
<div>
    <button class="btn btn-unique btn-rounded" type="submit">{{trans('gui.save')}}</button>
    <a class="btn btn-danger btn-rounded" href="{{route('restos.index')}}">{{trans('gui.cancel')}}</a>
</div>