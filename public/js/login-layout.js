var fx = {

    'UIHelpder': function () {
        console.log('UIHelper');

        //form error message remove on input
        $('.form-control').on('input', function () {
            $('.alert').fadeOut();
        });
    }
}

$(function () {

fx.UIHelpder();

});