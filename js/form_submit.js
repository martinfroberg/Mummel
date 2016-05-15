$(document).ready(function(){
    //Login AJAX
    $(document).on('submit', '#login_form', function(e) {
        //´´$('#login_form').submit(function(e)) {
        e.preventDefault();
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
                        //TODO Error handling?
                        $('#login_response').show();
                        $('#login_response').css("color", "RED");
                        $('#login_response').html(msg);
                    }
                });
            }
        });
        return false;
    });

    //Register AJAX
    $(document).on('submit', '#registration_form', function(e){
        //$('#registration_form').unbind('submit').bind('submit', function(e)) {
        e.preventDefault();
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
                        //TODO Error handling?
                        $('#registration_response').show();
                        $('#registration_response').css("color", "RED");
                        $('#registration_response').html(msg);
                    }
                });
            }
        });
        return false;
    });

    //Create thread AJAX
    $(document).on('submit', '#new_thread_form', function(e){
        //$('#new_thread_form').unbind('submit').bind('submit', function(e)) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./functions/forum/threads.php",
            data: $('#new_thread_form').serialize(),
            success: function(msg) {
                $(document).ajaxComplete(function(event, request, settnings){
                    if (msg == 'TRUE') {
                        //Success

                        //TODO Update thread-container insead of reload
                        location.reload(true);
                    } else {
                        //Failure
                        //TODO Error handling?
                        alert(msg);
                    }
                });
            }
        });
        return false;
    });

    //Reply AJAX
    $(document).on('submit', '#reply_form', function(e){
        //$('#reply_form').unbind('submit').bind('submit', function(e)) {
        e.preventDefault();

        var thread_id = $('#reply_form').closest('.thread').attr('id');
        var parent_id = 0;

        var parent_id_check = $('#reply_form').parents('.comment');

        if (parent_id_check.length){
            parent_id = parent_id_check.attr('id');
        }

        $('#reply_form').append('<input type="hidden" value=' + thread_id + ' name="thread_id" />');
        $('#reply_form').append('<input type="hidden" value=' + parent_id + ' name="parent_id" />');

        $.ajax({
            type: "POST",
            url: "./functions/forum/comments.php",
            data: $('#reply_form').serialize(),
            success: function(msg) {
                $(document).ajaxComplete(function(event, request, settnings){
                    if (msg == 'TRUE') {
                        //Success

                        //TODO Update comment-container instead of reload
                        location.reload(true);
                        //refreshComments(thread_id);
                    } else {
                        //Failure
                        //TODO vettigt fel medelande
                        alert(msg);
                    }
                });
            }
        });
        return false;
    });
});
