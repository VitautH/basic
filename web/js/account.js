/**
 * Created by Vitaut on 16.05.2017.
 */
/* Read More */
$(document).ready(function(){
    $('.to_more').click(function() {
        var id = $(this).data( "content" );
        $("#coupon_table_body_"+id).css("margin-bottom", "0");
        $('#more_'+id).show();
        $('.un_more_'+id).show();
        $('.to_more_'+id).hide();

    });
    $('.un_more').click(function() {
        var id = $(this).attr('id');
        $('#more_'+id).hide();
        $('.un_more_'+id).hide();
        $('.to_more_'+id).show();
        $("#coupon_table_body_"+id).css("margin-bottom", "10px");
    });



/* Modal Coupon*/

    var unused_click ='.unused_click';
    var close_modal_coupon = '#close_modal_coupon';
    $(unused_click).click(function() {
        var coupon = $(this).data( "content" );
        $(".content .code" ).text(coupon);
        $('.overlay').show();
        $('.coupon_modal').show();
    });
    $(close_modal_coupon).click(function() {
        $('.overlay').hide();
        $('.coupon_modal').hide();
        $(".content .code" ).empty();
    });
});