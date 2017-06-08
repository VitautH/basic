/**
 * Created by Vitaut on 19.05.2017.
 */

$(document).ready(function() {
    /*  Timer */
    var start_num=0;    //Номер первого слайда при загрузке страницы
    var auto_few=1;    //Автопрокрутка включена(1) или выключена(0) по умолчанию
    var slidespeed=200;    //Время перехода от слайда к слайду(мсек)
    var intervalspeed=4000;    //интервал автопрокрутки(мсек)
    var count=3;
var prev=0;
var next=1;
    var i = start_num;    //В будущем будем хранить в i показываемый слайд
    var intervalID;    //Интервал для автопрокрутки
    var lock = 0;    //Не дем прокрутить сразу на несколько слайдов, чтобы не сбивалось
    function auto()  {
        if (next<=3) {
            $("#advantage_"+prev).removeClass('active');
            $("#advantage_"+next).addClass('active');
            var head=  $("#advantage_"+next+ "  h3").text();
            var p =   $("#advantage_"+next+ "  p").text();
            $(".right_block h3").empty();
            $(".right_block p").empty();
            $(".right_block h3").text(head);
            $(".right_block p").text(p);
            next ++;
            prev++;







        }
        else {
            prev= 3;
    next=1;
            $("#advantage_"+prev).removeClass('active');
            $("#advantage_"+next).addClass('active');
            var head=  $("#advantage_"+next+ "  h3").text();
            var p =   $("#advantage_"+next+ "  p").text();
            $(".right_block h3").empty();
            $(".right_block p").empty();
            $(".right_block h3").text(head);
            $(".right_block p").text(p);
            next ++;
            prev = 0;
            prev++;




    }
        // if (i===0) {
        //     var toogle_next = $("#advantage_1").attr('data-toggle');
        //     prev = start_num;
        //     next = start_num++;
        //     i++
        // }
        // else {
        //     prev= i--;
        //     next = i++;
        // }
        //
        //
        //
        // $("#advantage_"+prev).removeClass('active');
        // $("#advantage_"+next).addClass('active');
//                    var toogle_left = $("#arrow-left").attr('data-toggle');
//                    if (toogle_left >0) {
//                        $("#arrow-left").attr("data-toggle", toogle_left-1);
//                    }
//                    else {
//                        $("#arrow-left").attr("data-toggle", count);
//                    }
//                    $('header  section.block_1').fadeIn('slow', function() {
//                        $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[toogle_left].img_url+")");
//                    });
//                    $("header  section.block_1 .slider_header  .content  .title").text(sliders[toogle_left].title);
//                    $("header  section.block_1 .slider_header .content p").text(sliders[toogle_left].content);


    }
    intervalID = setInterval(auto, intervalspeed);    //Зададим инетрвал
});
