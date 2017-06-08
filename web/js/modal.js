/**
 * Created by Vitaut on 16.05.2017.
 */
$(document).ready(function(){
    /* Redirect to payment Modal */
    var continue_to_pay_modal ='.continue_to_pay_modal';
    var close_modal_continue_to_pay = '#close_modal_continue_to_pay';
    var booking = '#booking';
    $(booking).click(function() {

        $('.overlay').show();
        $('.continue_to_pay_modal').show();
    });
    $(close_modal_continue_to_pay).click(function() {
        $('.overlay').hide();
        $('.continue_to_pay_modal').hide();

    });
    /* Login Registration modal  */
    // Modal success_registration_message
    var close_modal_success_registration_message = '#close_modal_success_registration_message';
    $(close_modal_success_registration_message).click(function() {

        $('#success_registration_message').hide();
    });
    //Modal failed_registration_message
    var close_modal_failed_registration_message = '#close_modal_failed_registration_message';
    $(close_modal_failed_registration_message).click(function() {

        $('#failed_registration_message').hide();
    });
    // Modal Login SingUp Form
    $('.login_singup_popup').hide();
    var login = '#login_modal_form';
    var singup = '#singup_modal_form';
    var close_login_modal_form = '#close_modal_login_form';
    var login_click = '.login_form_click';
    var singup_click = '.singup_form_click';
    $(login_click).click(function() {
        $('.overlay').show();
        $('.login_singup_popup').show();
        $('#login_form').show();
        $(login).addClass('active');
        $('#singup_form').hide();
        $(singup).removeClass('active')
    });
    $(singup_click).click(function() {
        $('.overlay').show();
        $('.login_singup_popup').show();
        $('#login_form').hide();
        $('#singup_form').show();
        $(login).removeClass('active')
        $(singup).addClass('active');
    });

    $(login).click(function() {
        $('#login_form').show();
        $(login).addClass('active');
        $('#singup_form').hide();
        $(singup).removeClass('active')
    });
    $(singup).click(function() {
        $('#login_form').hide();
        $('#singup_form').show();
        $(login).removeClass('active')
        $(singup).addClass('active');
    });
    $(close_login_modal_form).click(function() {
        $('.overlay').hide();
        $('.login_singup_popup').hide();
    });
});