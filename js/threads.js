$(document).ready(function(){
  //Open comments
    $('.threads-container').on('click','.thread a',function(){
        var id = $(this).parent().attr('id');

        $.ajax({ url: 'includes/threads/comments.php',
        data:  {get_thread_comments: id},
        type: 'POST',
        success: function(comments){
            if( $('#' + id + '.comments-container').length ){
                $('#' + id + '.comments-container').remove();
            } else {
                $('#' + id).append("<div id='" + id + "' class='comments-container'></div>");
                $('#' + id + '.comments-container').html(comments);
            }
        }});
    });
});
