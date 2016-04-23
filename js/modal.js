$(document).ready(function() {
    //Open Modal.
    $('.open-modal').click(function(e) {
        $('body').append('<div class="dim-background"></div>');
        //Open id from targeted modal.
        $('.modal-' + e.target.id).show();

        //Switch modal
        $('.switch-modal').click(function(e){
            if(e.target.id == 'register'){
                $('.modal-login').hide();
                $('.modal-register').show();
            } else {
                $('.modal-register').hide();
                $('.modal-login').show();
            }
        });

        //Close button on modal.
        $('.close-modal').click(function(e){
            $('.dim-background').remove();
            $('.modal-login').hide();
            $('.modal-register').hide();
        });

        //Click outside of div.
        $('.dim-background').click(function(e){
            $('.dim-background').remove();
            $('.modal-login').hide();
            $('.modal-register').hide();
        });
    });

    //Login AJAX
    $('#login_form').submit(function() {
        $.ajax({
            type: "POST",
            url: "./functions/login/login.php",
            data: $('#login_form').serialize(),
            success: function(msg) {
                $(document).ajaxComplete(function(event, request, settnings) {
                    if (msg == 'TRUE') {
                        //Success
                        location.reload(true);
                    } else {
                        //Failure, wrong password?
                        $('#login_response').show();
                        $('#login_response').css("color", "RED");
                        $('#login_response').html(msg);
                    }
                });
            }
        });
    });

    //Register AJAX
    $('#registration_form').submit(function(){
        $.ajax({
            type: "POST",
            url: "./functions/login/register.php",
            data: $('#registration_form').serialize(),
            success: function(msg) {
                $(document).ajaxComplete(function(event, request, settnings){
                    if (msg == 'TRUE') {
                        //Success
                        location.reload(true);
                    } else {
                        //Failure
                        $('#registration_response').show();
                        $('#registration_response').css("color", "RED");
                        $('#registration_response').html(msg);
                    }
                });
            }
        });
    });
});
