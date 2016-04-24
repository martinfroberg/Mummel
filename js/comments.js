$(document).ready(function(){
  //Open comments
    $('.threads-container').on('click','.thread .comments-btn',function(){
        displayComments($(this).parent().attr('id'));
    });
});

function displayComments(thread_id){

    $.ajax({ url: 'includes/threads/comments.php',
    data:  {get_thread_comments: thread_id},
    type: 'POST',
    success: function(comments){
        if( $('#' + thread_id + '.comments-container').length ){
            $('#' + thread_id + '.comments-container').remove();
        } else {
            $('#' + thread_id).append("<div id='" + thread_id + "' class='comments-container'></div>");
            $('#' + thread_id + '.comments-container').html(comments);
        }
    }});
}

function refreshComments(thread_id){
    $('#' + thread_id + '.comments-container').remove();

    displayComments(thread_id);
}
