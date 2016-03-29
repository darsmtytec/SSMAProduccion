var Login = function () {

    var handleLogin = function () {
        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
                username: {
                    required: "Usuario es requerido."
                },
                password: {
                    required: "Contraseña es requerida."
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                $('.alert-danger', $('.login-form')).show();
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                // form.submit();
            }
        });

        /*  $('.login-form input').keypress(function (e) {
         if (e.which == 13) {
         if ($('.login-form').validate().form()) {
         $('.login-form').submit();
         }
         return false;
         }
         });*/
        $("#login").click(function () {
            console.log("Click");
            var email = $("#user").val();
            var password = $("#pass").val();
            // Checking for blank fields.
            if (email != '' || password != '') {
                $.post("/ssma/web_service/login.php", {username: email, password: password}, function (data) {
                    // alert( "success" );
                }).done(function (data) {
                    data = JSON.parse(data);
                        console.log(data.success);

                        if (data.success == '1') {
                            window.location.replace("dashboard.php");
                        }
                        else if (data.success == '0'){
                            //alert( "usuario no registrado" );
                            if (data.msg == "wrong password") {

                                sweetAlert('Contraseña equivocada.', '', 'error');
                            }
                            else if (data.msg == "wrong user") {
                                sweetAlert('Usuario no registrado.', '', 'error');

                            }

                        }
                    }).fail(function (data) {
                        console.log(data);

                        //alert( "Intente más tarde." );
                        sweetAlert('Intente más tarde.', '', 'error');
                    })
            }
        });
    }

    var handleForgetPassword = function () {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email: {
                    required: "Email is required."
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function () {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }
    var handleSecret = function () {


        $("#logoImg").click(function () {
            a = $(this).attr('count');
            a++;
            $("#logoImg").attr('count', a);
            if ($(this).attr('count') == 5) {
                //$("#logoImg").attr('src', 'img.png').fade();
                var image = $("#logoImg");
                image.fadeOut('slow', function () {
                    image.attr('src', 'assets/layouts/layout3/img/SMA_logo.png');
                    image.fadeIn('slow');
                });
            }
        });
    }


    return {
        //main function to initiate the module
        init: function () {
            $("#logoImg").attr('count', '0');
            handleLogin();
            handleForgetPassword();
            handleSecret();

            // init background slide images
            $.backstretch([
                    "login/img/bg/1.jpg",
                    "login/img/bg/2.jpg",
                    "login/img/bg/3.jpg",
                    "login/img/bg/4.jpg"
                ], {
                    fade: 1000,
                    duration: 5000
                }
            );
        }
    };

}();

jQuery(document).ready(function () {
    Login.init();
});