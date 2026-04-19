/**
*	SLMP ADMIN JS
*/

jQuery(document).ready(function ($) {

    $('div#acf-slmp_gallery .slmp-gallery-select ul li').each(function() {
        var parent      = $(this),
            al_label    = $(this).find('label');

        if ( $(al_label).hasClass('selected') ) {
            $('div#acf-slmp_gallery .slmp-gallery-select ul li').hide();
            $(al_label).parent().show();
        }

        $(this).click(function() {
            var label = $(this).find('label');

            if ( $(label).hasClass('selected') ) {
                $('div#acf-slmp_gallery .slmp-gallery-select ul li').show('slow');
            } else {
                $('div#acf-slmp_gallery .slmp-gallery-select ul li').hide();
                $(label).parent().show('slow');
            }
        });
    });

    $('div#acf-slmp_gallery .acf-field-album-category-list-items ul.acf-checkbox-list li a.button.acf-add-checkbox').html('Add new Category');
    $('div#acf-slmp_gallery .acf-gallery .acf-gallery-toolbar .button-primary').html('Add new Image');


});