<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 18.04.2017
 * Time: 18:09
 */
?>

<script type="text/javascript">
    var sliders = <?php echo json_encode($images) ?>;

    $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[0].img_url+")");
    $("header  section.block_1 .slider_header  .content  .title").text(sliders[0].title);
    $("header  section.block_1 .slider_header .content p").text(sliders[0].content);
    var count =  sliders.length-1;


    $( document ).ready(function() {
        for (var i =count; i>=0; i-- ){
            if (i == count){
                $(".item_slideshow").append('<div class="item active" id="item_'+i+'"></div>');
            }
            else {
                $(".item_slideshow").append('<div class="item" id="item_'+i+'"></div>');
            }


        }

        $("#arrow-right").attr("data-toggle", "0");
        $("#arrow-left").attr("data-toggle", count);
        /*  Timer */
        var start_num=1;    //Номер первого слайда при загрузке страницы
        var auto_few=1;    //Автопрокрутка включена(1) или выключена(0) по умолчанию
        var slidespeed=200;    //Время перехода от слайда к слайду(мсек)
        var intervalspeed=3000;    //интервал автопрокрутки(мсек)


        var i = start_num;    //В будущем будем хранить в i показываемый слайд
        var intervalID;    //Интервал для автопрокрутки
        var lock = 0;    //Не даем прокрутить сразу на несколько слайдов, чтобы не сбивалось
        function autofew() {    //Прокрутка вперед

            var toogle_left = $("#arrow-left").attr('data-toggle');

            $('.item').removeClass('active');
            $('#item_'+toogle_left).addClass('active');
            if (toogle_left >0) {
                $("#arrow-left").attr("data-toggle", toogle_left-1);
            }
            else {
                $("#arrow-left").attr("data-toggle", count);
            }
            $('header  section.block_1').fadeIn('slow', function() {
                $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[toogle_left].img_url+")");
            });
            $("header  section.block_1 .slider_header  .content  .title").text(sliders[toogle_left].title);
            $("header  section.block_1 .slider_header .content p").text(sliders[toogle_left].content);


        }
        intervalID = setInterval(autofew, intervalspeed);    //Зададим инетрвал



        $("#arrow-right").click(function() {
            var toogle_right = $("#arrow-right").attr('data-toggle');

            if (toogle_right < count) {
                $("#arrow-right").attr("data-toggle", ++toogle_right);
                $('header  section.block_1').fadeIn('slow', function() {
                    $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[toogle_right].img_url+")");
                });


                $("header  section.block_1 .slider_header  .content  .title").text(sliders[toogle_right].title);
                $("header  section.block_1 .slider_header .content p").text(sliders[toogle_right].content);

                $('.item').removeClass('active');
                $('#item_'+toogle_right).addClass('active');
            }
            else {
                $("#arrow-right").attr("data-toggle", 0);
                $('header  section.block_1').fadeIn('slow', function() {
                    $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[0].img_url+")");
                });


                $("header  section.block_1 .slider_header  .content  .title").text(sliders[0].title);
                $("header  section.block_1 .slider_header .content p").text(sliders[0].content);
                $('.item').removeClass('active');
                $('#item_'+count).addClass('active');
            }

        })
        $("#arrow-left").click(function() {
            var toogle_left = $("#arrow-left").attr('data-toggle');
            if (toogle_left >0) {
                $("#arrow-left").attr("data-toggle", toogle_left-1);
                $('.item').removeClass('active');
                $('#item_'+toogle_left).addClass('active');
            }
            else {
                $("#arrow-left").attr("data-toggle", count);
            }
            $('header  section.block_1').fadeIn('slow', function() {
                $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[toogle_left].img_url+")");
            });
            $("header  section.block_1 .slider_header  .content  .title").text(sliders[toogle_left].title);
            $("header  section.block_1 .slider_header .content p").text(sliders[toogle_left].content);
            $('.item').removeClass('active');
            $('#item_'+toogle_left).addClass('active');
        })
    });
</script>
