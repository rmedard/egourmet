/**
 * Created by medard on 26/09/16.
 */
$('[data-toggle="tooltip"]').tooltip();
$('#resto-form-send').click(function () {
    var addr = $('input[name=rue]').val();
    addr += ' ';
    addr += $('input[name=numero]').val();
    addr += ' ';
    addr += $('input[name=zip]').val();
    addr += ' ';
    addr += $('input[name=commune]').val();
    GMaps.geocode({
        address: addr,
        callback: function(results, status) {
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                $('#resto-form-latitude').val(latlng.lat());
                $('#resto-form-longitude').val(latlng.lng());
            }
            $('#resto-form-id').submit();
        }
    });
});
