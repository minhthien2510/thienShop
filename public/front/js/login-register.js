jQuery(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#register').click(function() {
        $.post(
            "register",
            {
                email: $('#email-r').val(),
                password: $('#password-r').val(),
                re_password: $('#re_password').val()
            },
            function( data ) {
                console.log(data);
                if (data == 'success') {
                    location.href('http://minhthien.site88.net/');
                } else {
                    if (data.errorEmail != null) {
                        $('.email').addClass('has-error');
                        $('.errorEmail').html(data.errorEmail);
                    } else {
                        $('.errorEmail').empty();
                    }
                    if (data.errorPassword != null) {
                        $('.password').addClass('has-error');
                        $('.errorPassword').html(data.errorPassword);
                    } else {
                        $('.errorPassword').empty();
                    }
                    if (data.errorPasswordConfirm != null) {
                        $('.passwordConfirm').addClass('has-error');
                        $('.errorPasswordConfirm').html(data.errorPasswordConfirm);
                    } else {
                        $('.errorPasswordConfirm').empty();
                    }

                    $('input[type="password"]').val('');
                }
            }
        );
    });

    checkCheckbox();
    $("input[name='remember']").click(function() {
        if ($(this).is(":checked"))
            $(this).val('true');
        else
            $(this).val('false');
    });
    function checkCheckbox() {
        if ($(".remember").val() == 'true')
            $(".remember").prop('checked', true);
        else
            $(".remember").prop('checked', false);
    }
    function setCheckbox() {
        if ($(".remember").is(":checked"))
            $(".remember").val('true');
        else
            $(".remember").val('false');
    }
    // $("#remember").click(function() {
    //     setCheckbox();
    // });
    // function checkCheckbox() {
    //     if ($("#remember").val() == 'true')
    //         $("#remember").prop('checked', true);
    //     else
    //         $("#remember").prop('checked', false);
    // }
    // function setCheckbox() {
    //     if ($("#remember").is(":checked"))
    //         $("#remember").val('true');
    //     else
    //         $("#remember").val('false');
    // }
})