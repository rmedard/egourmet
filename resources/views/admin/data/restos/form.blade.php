<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJsK8awOXgQKkscyMLIYHoO9Do7txoK8w&libraries=geometry,places"></script>

<div class="md-form">
    {{Form::text('name', null, ['class' => 'form-control validate', 'id' => 'resto-form-name', 'placeholder' =>trans('gui.name.resto')])}}
</div>
<div class="md-form">
    {{Form::text('formatted-address', isset($resto) ? $resto->address->display() : null, ['class' => 'form-control validate', 'id' => 'searchAddressId', 'placeholder' =>trans('gui.address.resto')])}}
</div>
<div id="hiddenAddressData">
    <input type="hidden" id="resto-form-rue" name="rue" value="{{isset($resto) ? $resto->address->rue : null}}">
    <input type="hidden" id="resto-form-numero" name="numero" value="{{isset($resto) ? $resto->address->numero : null}}">
    <input type="hidden" id="resto-form-commune" name="commune" value="{{isset($resto) ? $resto->address->commune : null}}">
    <input type="hidden" id="resto-form-zip" name="zip" value="{{isset($resto) ? $resto->address->codepostal : null}}">
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
                {!! Html::image(isset($resto) ? $resto->getMainPhoto() : config('constants.norestoimage'), 'Choose photo', ['width' => 150, 'height' => 'auto']) !!}
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 170px;"></div>
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

<script type="application/javascript">
    var input = document.getElementById('searchAddressId');
    //var input = $('#searchAddressId');
    var options = {
        componentRestrictions: {country: 'BE'}
    };

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    google.maps.event.addDomListener(window, 'load', function () {
        console.log("Search triggered...");
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            $('#hiddenAddressData > input').val('');
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    if(addressType == 'route'){
                        $('#resto-form-rue').val(val);
                    }else if(addressType == 'street_number'){
                        $('#resto-form-numero').val(val);
                    }else if(addressType == 'locality'){
                        $('#resto-form-commune').val(val);
                    }else if(addressType == 'postal_code'){
                        $('#resto-form-zip').val(val);
                    }
                }
            }
        });
    });
</script>