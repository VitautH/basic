/**
 * Created by Vitaut on 16.05.2017.
 */
$(document).ready(function(){


    $('.slider').slick({
        infinite: true,
        autoplay: true,
        speed:1200,
        slidesToShow: 4,
        slidesToScroll: 4
    });

    $('.dropdown-toggle').dropdown();
});

