$(document).ready(function(){
    // Quick and easy login check
    $('#form-login').on('submit', function(e) {
        e.preventDefault();
        var url = $(this).attr('action'),
        data = $(this).serialize();

        $.post(url, data, function(e){
        // put loading icon
        }).success(function(url){
        window.location = url;

        }).fail(function(fail) {
        // failure will notify the user
        console.log(fail);
        });
    });

    $('#login-form').on('keyup', function() {
        if($('#username').val().length > 0 && $('#password').val().length > 0){
            enableButton('#btn-submit');
        } else {
        disableButton('#btn-submit');
        }
        if($('#username').val().length > 0) {
            $('#username').addClass('active');
        }
        if ($('#password').val().length > 0) {
            $('#password').addClass('active');
        }
    });
});
