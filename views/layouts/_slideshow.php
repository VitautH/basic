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
        $("#arrow-right").attr("data-toggle", "0");
        $("#arrow-left").attr("data-toggle", count);
        $("#arrow-right").click(function() {
            var toogle_right = $("#arrow-right").attr('data-toggle');
            if (toogle_right < count) {
                $("#arrow-right").attr("data-toggle", ++toogle_right);
                $('header  section.block_1').fadeIn('slow', function() {
                    $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[toogle_right].img_url+")");
                });


                $("header  section.block_1 .slider_header  .content  .title").text(sliders[toogle_right].title);
                $("header  section.block_1 .slider_header .content p").text(sliders[toogle_right].content);
            }
            else {
                $("#arrow-right").attr("data-toggle", 0);
                $('header  section.block_1').fadeIn('slow', function() {
                    $('header  section.block_1').css( "background-image", "url(/uploads/images/"+sliders[0].img_url+")");
                });


                $("header  section.block_1 .slider_header  .content  .title").text(sliders[0].title);
                $("header  section.block_1 .slider_header .content p").text(sliders[0].content);
            }

        })
        $("#arrow-left").click(function() {
            var toogle_left = $("#arrow-left").attr('data-toggle');
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
        })
    });
</script>
