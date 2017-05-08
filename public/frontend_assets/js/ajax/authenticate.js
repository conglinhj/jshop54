/**
 * Created by nclin on 5/6/2017.
 */
$(document).ready(function(){

    var registerForm = $("#registerForm");
    var loginForm = $("#loginForm");
    var registerModal = $('#registerModal');
    var loginModal = $('#loginModal');

    $('.btn-to-register').on('click', function () {
        loginModal.modal('hide');
    });

    $('.btn-to-login').on('click', function () {
        registerModal.modal( 'hide' );
    });

    registerForm.submit(function(e){
        e.preventDefault();
        var formData = registerForm.serialize();
        $( '#register-errors-name' ).html( "" );
        $( '#register-errors-email' ).html( "" );
        $( '#register-errors-password' ).html( "" );
        $("#register-name").removeClass("has-error");
        $("#register-email").removeClass("has-error");
        $("#register-password").removeClass("has-error");

        $.ajax({
            type:'POST',
            url: registerForm.attr('action'),
            data:formData,
            success:function(){
                registerModal.modal( 'hide' );
                location.reload(true);
            },
            error: function (data) {
                console.log(data.responseText);
                var obj = jQuery.parseJSON( data.responseText );
                if(obj.name){
                    $("#register-name").addClass("has-error");
                    $( '#register-errors-name' ).html( obj.name );
                }
                if(obj.email){
                    $("#register-email").addClass("has-error");
                    $( '#register-errors-email' ).html( obj.email );
                }
                if(obj.password){
                    $("#register-password").addClass("has-error");
                    $( '#register-errors-password' ).html( obj.password );
                }
            }
        });
    });


    loginForm.submit(function(e) {
        e.preventDefault();
        var formData = loginForm.serialize();
        $('#form-errors-email').html("");
        $('#form-errors-password').html("");
        $('#form-login-errors').html("");
        $("#email-div").removeClass("has-error");
        $("#password-div").removeClass("has-error");
        $("#login-errors").removeClass("has-error");
        $.ajax({
            url: loginForm.attr('action'),
            type: 'POST',
            data: formData,
            success: function() {
                loginModal.modal('hide');
                location.reload(true);
            },
            error: function(data) {
                console.log(data.responseText);
                var obj = $.parseJSON( data.responseText );
                if (obj.email) {
                    $("#email-div").addClass("has-error");
                    $('#form-errors-email').html(obj.email);
                }
                if (obj.password) {
                    $("#password-div").addClass("has-error");
                    $('#form-errors-password').html(obj.password);
                }
                if (obj.login_error) {
                    $("#login-errors").addClass("has-error");
                    $('#form-login-errors').html(obj.login_error);
                }
            }
        });
    });

});
