"use strict";

$(document).ready(function() {

    //=================Preloader===========//
    $(window).on('load', function () {
        $('.preloader img').fadeOut();
        $('.preloader').fadeOut();
    });
    //=================end of Preloader===========//
    
    /*Background slideshow */

    $('.bg-slider').backstretch([
        "assets/img/pages/lbg-2.jpg", "assets/img/pages/lbg-3.jpg"
    ], {
        duration: 2500,
        fade: 1050
    });

    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue',
        increaseArea: '20%' // optional
    });
    $("#authentication").bootstrapValidator({
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The user name is required'
                    },
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    }

                }
            }

        }
    });
    
});
