/* Read More */
$(document).ready(function () {
    $('.to_more').click(function () {
        var id = $(this).data("content");
        $("#coupon_table_body_" + id).css("margin-bottom", "0");
        $('#more_' + id).show();
        $('.un_more_' + id).show();
        $('.to_more_' + id).hide();

    });
    $('.un_more').click(function () {
        var id = $(this).attr('id');
        $('#more_' + id).hide();
        $('.un_more_' + id).hide();
        $('.to_more_' + id).show();
        $("#coupon_table_body_" + id).css("margin-bottom", "10px");
    });

    /* Modal Coupon*/
    var unused_click = '.unused_click';
    var close_modal_coupon = '#close_modal_coupon';
    $(unused_click).click(function () {
        var coupon = $(this).data("content");
        $(".content .code").text(coupon);
        $('.overlay').show();
        $('.coupon_modal').show();
    });
    $(close_modal_coupon).click(function () {
        $('.overlay').hide();
        $('.coupon_modal').hide();
        $(".content .code").empty();
    });


    /*Payment success */
    $('#payment_success_coupon').click(function () {
        $('.overlay').hide();
        $('.payment_success').hide();
    });

    /*Filter */
    $('#city').change(function () {
        var data = $(this).val();
        $.ajax({
            url: '/order/filter',
            type: 'POST',
            data:  {city:data},
            success: function(data) {
                $('.coupon').html(data);

            }
        })
    })

    $('#data').change(function () {
        var data = $(this).val();
        $.ajax({
            url: '/order/filter',
            type: 'POST',
            data:  {data:data},
            success: function(data) {
                $('.coupon').html(data);

            }
        })
    })

    $('.price').change(function () {
        var min_price = $("input[name='min_price']").val();
        var max_price = $("input[name='max_price']").val();
        $.ajax({
            url: '/order/filter',
            type: 'POST',
            data:  {min_price:min_price, max_price:max_price},
            success: function(data) {
                $('.coupon').html(data);

            }
        })
    })

    $('.unused_checkbox').click(function () {
        if (this.checked){
        var checked= 1;
        }

        else {
            var checked= 0;
        }
        $.ajax({
            url: '/order/filter',
            type: 'POST',
            data:  {checked:checked},
            success: function(data) {
                $('.coupon').html(data);

            }
        })
    })
});