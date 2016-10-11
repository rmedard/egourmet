/**
 * Created by Mrebero on 21/07/2016.
 */
$('a[href^="#"]').click(function(){
    var the_id = $(this).attr("href");

    $('html, body').animate({
        scrollTop:$(the_id).offset().top
    }, 'slow');
    return false;
});

if($('#dishes-list-main').children().length != 0){
    var hauteur = $('#upper-header').height();
    $('html,body').animate({scrollTop: hauteur}, 'slow');
}

$('#login-page').parent().css('background', 'url("/images/core/restaurant_small.jpg")');

$('.rating').rating({
    filled: 'glyphicon glyphicon-heart',
    empty: 'glyphicon glyphicon-heart-empty'
});

$('.rate-email').hide();
$('.resto-main-details').hide();

$('.rate-input > span').click(function(){
    var parentId = $(this).parent().attr('id');
    var emailInput = $('#' + parentId + ' > div.rate-email');
    emailInput.show('slow');
    emailInput.find('.rating-comment-input').focus();
});


$('.rating-form').submit(function (e) {
    e.preventDefault();
    var form = $(this),
        url = form.attr('action'),
        method = form.attr('method');
    var data = form.serialize();

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function (response) {
            var result = ($(response)[0]);
            $('#rate-' + result.dish_resto_id).find('.value').text(result.rate_average);
            $('#reviews-' + result.dish_resto_id).find('.value').text(result.reviews_count);
            $('#rator-email-' + result.dish_resto_id).val('');
            $('.rate-email').hide();
        },
        error: function (xhr) {
            var errors = xhr.responseJSON;
        }
    });
});

$('#dishresto-form-id').submit(function(e){
    e.preventDefault();
    var form = $(this),
        url = form.attr('action'),
        method = form.attr('method'),
        data = form.serialize();
    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function (response) {
            console.log('Good');
        },
        error: function(xhr){
            var errors = xhr.responseJSON;
            console.log('Error...')
        }
    });
});

$('#search-dish').autocomplete({
    source: '/search_dish',
    minlength: 1,
    autoFocus: true,
    select: function(event, ui){
        $('#selected-dish').val(ui.item.id);
    }
});

$('#search-resto').autocomplete({
    source: '/search_resto',
    minlength: 1,
    autoFocus: true,
    select: function(event, ui){
        $('#selected-resto').val(ui.item.id);
    }
});

$('#search-btn-main').on('click', function (e) {
    //e.preventDefault();
    var offset = $('#intro-message-main').height();
    return $('html, body').animate({
        scrollTop: $(this.hash).offset().top - offset
    }, 300);
});

$('#message-form-id').submit(function(e){
    e.preventDefault();
    var form = $(this),
        url = form.attr('action'),
        method = form.attr('method'),
        data = form.serialize();
    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function (response) {
            var alertMessage = '<div class="alert alert-success contact-form-msg">Votre message est bien envoyé<div>';
            var existingMsg = $('.contact-form-msg');
            if(existingMsg.length){
                existingMsg.replaceWith(alertMessage);
            }else{
                $('#contact-form-block').prepend(alertMessage);
            }
            $('#message-form-id').trigger('reset');
        },
        error: function(xhr){
            var errors = xhr.responseJSON;
            if ($.isEmptyObject(errors) == false) {
                var alertMessage = '<div class="alert alert-danger contact-form-msg"><ul>';
                $.each(errors, function(key, value){
                    alertMessage += '<li>' + value + '</li>';
                });
                alertMessage += '</ul></div>';

                var existingError = $('.contact-form-msg');
                if(existingError.length){
                    existingError.replaceWith(alertMessage);
                }else{
                    $('#contact-form-block').prepend(alertMessage);
                }
            }
        }
    });
});