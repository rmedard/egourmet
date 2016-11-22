/**
 * Created by medard on 26/09/16.
 */

//To allow mdb drop down select
$(document).ready(function() {
    $('.mdb-select').material_select();
});

// SideNav Initialization
$(".button-collapse").sideNav();

$('[data-toggle="tooltip"]').tooltip();

$('ul.pagination').addClass('pg-dark')
$('ul.pagination > li').addClass('page-item');
$('ul.pagination > li > a').addClass('page-link');

$('.alert-success').delay(3000).slideUp(300);

$('#search-resto-admin').autocomplete({
    source: '/search_resto',
    minlength: 1,
    autoFocus: true,
    select: function(event, ui){
        $('#selected-resto-admin').val(ui.item.id);
    }
});

$('#search-dish-admin').autocomplete({
    source: '/search_dish',
    minlength: 1,
    autoFocus: true,
    select: function(event, ui){
        $('#selected-dish-admin').val(ui.item.id);
    }
});
