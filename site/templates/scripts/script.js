/*jslint browser: true*/
/*global $, jQuery, e*/
$(window).load(function () {
    
    'use strict';
    
    var loading    = $('.load'),
        loadingImg = $('.load img');
    
    loadingImg.css("-webkit-animation", "none");
    loadingImg.css("-moz-animation", "none");
    loadingImg.css("-ms-animation", "none");
    loadingImg.css("-o-animation", "none");
    loadingImg.css("animation", "none");
    
    loading.css("transform", "none");
    $('.header .container').prepend(loading);
    
    if ($('body').width() > "850") {
        
        loading.animate({

            top: "15px",
            left: $(".container").offset().left

        }, 2000);
    } else {
        
        loading.animate({

            top: "15px",
            left: (($('body').width() / 2) - (118 / 2))

        }, 2000);
        
        $('.bars').animate({
            
            marginTop: "+=70"
            
        }, 2000, function () {
            
            $(this).css("margin-top", "0");
     
        });
        
    }
    
    
    loadingImg.animate({
        
        width: 118
        
    });
    
    $('.white').animate({
        
        opacity: 0
        
    }, 2000, function () {
        
        loading.addClass('logo').removeClass('load').css("postion", "initial");
        $(this).remove();
        
    });
    
    $('.search-icon').click(function () {
        
        $('.search-bar').fadeToggle();
        
    });
    
    $('.header .bars').click(function () {
        
        $('.header .main-nav').slideToggle(1000);
        
    });


    /* Processwire Ajax */
    $('a.ajax-link').click(function (e) {
        
        var href = $(this).attr('href'),
            $pageData = '';
        
        $.ajax({
            
            type: "POST",
            url: href,
            data: { ajax: true },
            success: function (data, status) {
                $pageData = data;
            }
            
        }).done(function () {
            
            $('.page-body').remove();
            $('.intro').after($pageData);
            
        });
        
        e.preventDefault();
        
    });
    
});











